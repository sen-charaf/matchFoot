<?php
require_once __DIR__ . '/../model/Referee.php';
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/CountryController.php';

class RefereeController extends Controller
{

    public static function index(): array
    {
        try {
            $referees = Referee::getAll();
            $modifiedReferees = [];
            if($referees){
                foreach ($referees as $referee) {
                    $country = CountryController::getCountryById($referee[Referee::$country_id]);
                    $referee['country'] = $country;
                    $modifiedReferees[] = $referee;
                }
                $referees = $modifiedReferees;
            }else{
                $referees = [];
            }

        } catch (Exception $e) {
            $error = "An error occurred while retrieving referees";
            include __DIR__ . '/../view/Error.php';
            return [];
        }
        return $referees;
    }

    public static function getRefereeById($id): array
    {
        $referee = Referee::getById($id);
        if (!$referee) {
            $error = "Referee not found";
            include __DIR__ . '/../view/Error.php';
            return [];
        }
        $referee['country'] = CountryController::getCountryById($referee[Referee::$country_id]);
        return $referee;
    }

    public static function store():void
    {
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            $error = "Invalid request method";
            include __DIR__ . '/../view/Error.php';
            return;
        }

        $firstName = isset($_POST['first_name']) ? trim($_POST['first_name']) : null;
        $lastName = isset($_POST['last_name']) ? trim($_POST['last_name']) : null;
        $birthDate = isset($_POST['birth_date']) ? trim($_POST['birth_date']) : null;
        $countryId = isset($_POST['country_id']) ? trim(intval($_POST['country_id'])) : null;

        $data = [
            Referee::$firstName => $firstName,
            Referee::$lastName => $lastName,
            Referee::$birthDate => $birthDate,
            Referee::$country_id => $countryId,
        ];

        $rules = [
            Referee::$firstName => 'required|min:2|max:30',
            Referee::$lastName => 'required|min:2|max:30',
            Referee::$birthDate => 'required|date_format:Y-m-d',
            Referee::$country_id => 'required|numeric',
        ];

        $validator_result = self::validate($data, $rules);

        if ($validator_result !== true) {
            $error = $validator_result;
            include __DIR__ . '/../view/Error.php';
            return;
        }

        try{
            if(!Country::exists([Country::$id => $countryId])){
                $error = "Country not found";
                include __DIR__ . '/../view/Error.php';
                return;
            }
        }catch (Exception $e){
            $error = "Error  fetching country: " . $e->getMessage();
            include __DIR__ . '/../view/Error.php';
        }


        try{
            Referee::create($data);
            header('Location: RefereeList.php');
        }catch (Exception $e){
            $error = "Error creating referee: " . $e->getMessage();
            include __DIR__ . '/../view/Error.php';
        }
    }

    public static function update():void
    {
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            $error = "Invalid request method";
            include __DIR__ . '/../view/Error.php';
            return;
        }

        $id = isset($_POST['id']) ? trim(intval($_POST['id'])) : null;
        $firstName = isset($_POST['first_name']) ? trim($_POST['first_name']) : null;
        $lastName = isset($_POST['last_name']) ? trim($_POST['last_name']) : null;
        $birthDate = isset($_POST['birth_date']) ? trim($_POST['birth_date']) : null;
        $countryId = isset($_POST['country_id']) ? trim(intval($_POST['country_id'])) : null;

        if(!$id){
            $error = "Id is required";
            include __DIR__ . '/../view/Error.php';
            return;
        }

        $referee = Referee::getById($id);

        if (!$referee) {
            $error = "Referee not found";
            include __DIR__ . '/../view/Error.php';
            return;
        }

        $data = [
            Referee::$firstName => $firstName,
            Referee::$lastName => $lastName,
            Referee::$birthDate => $birthDate,
            Referee::$country_id => $countryId,
        ];

        $rules = [
            Referee::$firstName => 'required|min:2|max:30',
            Referee::$lastName => 'required|min:2|max:30',
            Referee::$birthDate => 'required|date_format:Y-m-d',
            Referee::$country_id => 'required|numeric',
        ];

        $validator_result = self::validate($data, $rules);

        if ($validator_result !== true) {
            $error = $validator_result;
            include __DIR__ . '/../view/Error.php';
            return;
        }

        try{
            if(!Country::exists([Country::$id => $countryId])){
                $error = "Country not found";
                include __DIR__ . '/../view/Error.php';
                return;
            }
        }catch (Exception $e){
            $error = "Error  fetching country: " . $e->getMessage();
            include __DIR__ . '/../view/Error.php';
        }

        try{
            Referee::update($id, $data);
            header('Location: RefereeList.php');
        }catch (Exception $e){
            $error = "Error updating referee: " . $e->getMessage();
            include __DIR__ . '/../view/Error.php';
        }
    }
    

    public static function deleteReferee($id):void
    {
        if (!$id) {
            $error = "Invalid referee id";
            include __DIR__ . '/../view/Error.php';
            return;
        }

        try {
            Referee::delete($id);
            header('Location: RefereeList.php');
        } catch (Exception $e) {
            $error = "Error deleting referee: " . $e->getMessage();
            include __DIR__ . '/../view/Error.php';
        }
    }

}