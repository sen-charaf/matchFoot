<?php
require_once __DIR__ . '/../model/City.php';
require_once __DIR__ . '/Controller.php';
class CityController extends Controller{

    public static function index():array {
        $cities = City::getAll();
        return $cities;
    }

    public static function getCityById($id):array {
        $city = City::getById($id);
        if(!$city){
            $error = "City not found";
            include __DIR__ . '/../view/Error.php';
            return [];
        }
        return $city;
    }

}