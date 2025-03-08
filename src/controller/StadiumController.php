<?php
require_once __DIR__ . '/../model/Stadium.php';
require_once __DIR__ . '/../model/City.php';
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/CityController.php';

class StadiumController extends Controller
{

    public static function index(): array
    {
        $stadiums = Stadium::getAll();
        $modifiedStadiums = [];
        if ($stadiums) {
            foreach ($stadiums as $stadium) {
                $city = City::getById($stadium[Stadium::$city_id]);
                $stadium['city'] = $city;
                $modifiedStadiums[] = $stadium;
            }
            return $modifiedStadiums;
        } else {
            return [];
        }
    }

    public static function getStadById($id): array
    {
        $stadium = Stadium::getById($id);
        if (!$stadium) {
            $error = "Stadium not found";
            include __DIR__ . '/../view/Error.php';
            return [];
        }
        $city = CityController::getCityById($stadium[Stadium::$city_id]);
        $stadium['city'] = $city;
        return $stadium;
    }

    public static function getStadByName($name): array
    {
        try {
            $stadium = Stadium::getStadByName($name);
            if (!$stadium) {
                $error = "Stadium not found";
                include __DIR__ . '/../view/Error.php';
                return [];
            }
        } catch (Exception $e) {
            $error = "Error fetching stad: " . $e->getMessage();
            include __DIR__ . '/../view/Error.php';
            return [];
        }
        return $stadium;
    }



    public static function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = isset($_POST['name']) ? trim($_POST['name']) : null;
            $capacity = isset($_POST['capacity']) ? trim($_POST['capacity']) : null;
            $city_id = isset($_POST['city_id']) ? trim($_POST['city_id']) : null;

            $data = [
                Stadium::$name => $name,
                Stadium::$capacity => $capacity,
                Stadium::$city_id => $city_id
            ];

            $rules = [
                Stadium::$name => 'required',
                Stadium::$capacity => 'required|numeric',
                Stadium::$city_id => 'required'
            ];

            $validatpr_result = self::validate($data, $rules);
            if ($validatpr_result !== true) {
                $error = $validatpr_result;
                include __DIR__ . '/../view/Error.php';
                return;
            }

            $result = Stadium::create($data);
            if ($result) {
                header('Location: StadeList.php');
            } else {
                $error = "Error creating stadium";
                include __DIR__ . '/../view/Error.php';
            }
        }
    }

    public static function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = isset($_POST['id']) ? trim($_POST['id']) : null;
            $name = isset($_POST['name']) ? trim($_POST['name']) : null;
            $capacity = isset($_POST['capacity']) ? trim($_POST['capacity']) : null;
            $city_id = isset($_POST['city_id']) ? trim($_POST['city_id']) : null;

            $data = [
                Stadium::$id => $id,
                Stadium::$name => $name,
                Stadium::$capacity => $capacity,
                Stadium::$city_id => $city_id
            ];

            $rules = [
                Stadium::$id => 'required',
                Stadium::$name => 'required',
                Stadium::$capacity => 'required|numeric',
                Stadium::$city_id => 'required'
            ];

            $validatpr_result = self::validate($data, $rules);
            if ($validatpr_result !== true) {
                $error = $validatpr_result;
                include __DIR__ . '/../view/Error.php';
                return;
            }

            $result = Stadium::update($id, $data);
            if ($result) {
                header('Location: StadeList.php');
            } else {
                $error = "Error updating stadium";
                include __DIR__ . '/../view/Error.php';
            }
        }
    }

    public static function deleteStad($id)
    {
        if (!$id) {
            $error = "Invalid stadium id";
            include __DIR__ . '/../view/Error.php';
            return;
        }

        $result = Stadium::delete($id);
        if ($result) {
            header('Location: StadeList.php');
        } else {
            $error = "Error deleting stadium";
            include __DIR__ . '/../view/Error.php';
        }
    }
}
