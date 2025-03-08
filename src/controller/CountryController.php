<?php
require_once __DIR__ . '/../model/Country.php';
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../helper/UploadFileHelper.php';

class CountryController extends Controller
{
    private static $uploadDirectory = __DIR__ . '/../../public/uploads/country_logo/';
    private static $uploadSubdirectory = 'country_logo';

    public static function index(): array
    {
        $countries = Country::getAll();
        $modifiedCountries = [];
        if ($countries) {
            foreach ($countries as $country) {
                $country['flag'] = 'http://efoot/logo?file=' . $country[Country::$logo_path].'&dir='.self::$uploadSubdirectory;
                $modifiedCountries[] = $country;
            }
            $countries = $modifiedCountries;
        }
        return $countries;
    }

    public static function getCountryById($id): array
    {
        $country = Country::getById($id);
        if (!$country) {
            $error = "Country not found";
            include __DIR__ . '/../view/Error.php';
            return [];
        }
        $country['flag'] = 'http://efoot/logo?file=' . $country[Country::$logo_path].'&dir='.self::$uploadSubdirectory;
        return $country;
    }

    public static function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $error = "Invalid request method";
            include __DIR__ . '/../view/Error.php';
            return;
        }

        $name = isset($_POST['name']) ? trim($_POST['name']) : null;
        $logo_path = null;

        $data = [
            Country::$name => $name
        ];

        $rules = [
            Country::$name => 'required'
        ];


        $validatore_result = self::validate($data, $rules);
        if ($validatore_result !== true) {
            $error = $validatore_result;
            include __DIR__ . '/../view/Error.php';
            return;
        }

        if (isset($_FILES["logo"])) {

            $logo = $_FILES["logo"];
            $logo_path = uploadImage($logo, self::$uploadDirectory);
     }

        $data[Country::$logo_path] = $logo_path;

        try {
            Country::create($data);
            header("Location: CountryList.php");
        } catch (Exception $e) {
            if ($logo_path) {
                deleteImage(self::$uploadDirectory . $lgo_path);
            }
            $error = "Error creating country: " . $e->getMessage();
            include __DIR__ . '/../view/Error.php';
            return;
        }
    }

    public static function update()
    {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $error = "Invalid request method";
            include __DIR__ . '/../view/Error.php';
            return;
        }

        $id = isset($_POST['id']) ? trim((intval($_POST['id']))) : null;
        $name = isset($_POST['name']) ? trim($_POST['name']) : null;
        $logo_path = null;
        $old_logo_path = null;

        $data = [
            Country::$name => $name
        ];

        $rules = [
            Country::$name => 'required'
        ];


        $validatore_result = self::validate($data, $rules);
        if ($validatore_result !== true) {
            $error = $validatore_result;
            include __DIR__ . '/../view/Error.php';
            return;
        }

        $country = Country::getById($id);
        if (!$country) {
            $error = "Country not found";
            include __DIR__ . '/../view/Error.php';
            return;
        }
        
        $logo_path = $country[Country::$logo_path];
        if (isset($_FILES["logo"]) && $_FILES["logo"]["size"] > 0) {
            $logo = $_FILES["logo"];
            $old_logo_path = $logo_path;
            $logo_path = uploadImage($logo, self::$uploadDirectory);
     }

        $data[Country::$logo_path] = $logo_path;

        try {
            $result = Country::update($id, $data);
            if ($result) {
                if ($old_logo_path) {
                    deleteImage(self::$uploadDirectory . $od_logo_path);
                }
                header("Location: CountryList.php");
            } else {
                if ($old_logo_path) {
                    deleteImage(self::$uploadDirectory . $lgo_path);
                }
                $error = "Error updating country";
                include __DIR__ . '/../view/Error.php';
                return;
            }
        } catch (Exception $e) {
            if ($logo_path) {
                deleteImage(self::$uploadDirectory . $lgo_path);
            }
            $error = "Error updating country: " . $e->getMessage();
            include __DIR__ . '/../view/Error.php';
            return;
        }
    }

    public static function deleteCountry($id): void
    {
        if (!$id) {
            $error = "Invalid country id";
            include __DIR__ . '/../view/Error.php';
            return;
        }

        try {
            $country = Country::getById($id);
            if (!$country) {
                $error = "Country not found";
                include __DIR__ . '/../view/Error.php';
                return;
            }
            $logo_path = $country[Country::$logo_path];
            Country::delete($id);

            if ($logo_path) {
                deleteImage(self::$uploadDirectory . $logo_path);
            }
            header("Location: CountryList.php?deleted=1");
        } catch (Exception $e) {
            $error = "Error deleting country: " . $e->getMessage();
            include __DIR__ . '/../view/Error.php';
        }
    }
          
}
