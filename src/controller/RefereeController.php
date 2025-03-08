<?php
require_once __DIR__ . '/../model/Referee.php';
require_once __DIR__ . '/Controller.php';

class RefereeController extends Controller
{

    public static function index(): array
    {
        try {
            $referees = Referee::getAll();
            $modifiedReferees = [];
            if($referees){
                foreach ($referees as $referee) {
                    $country = CountryController::getCountryById($referee[Country::$id]);
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
        return $referee;
    }

}