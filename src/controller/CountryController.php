<?php
require_once __DIR__ . '/../model/Country.php';
require_once __DIR__ . '/Controller.php';

class CountryController extends Controller
{

    public static function index(): array
    {
        $countries = Country::getAll();
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
        return $country;
    }

}