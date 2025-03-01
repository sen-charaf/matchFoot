<?php
require_once __DIR__ . '/../model/Stadium.php';
require_once __DIR__ . '/../model/City.php';

class StadiumController {
    public static function getAllStads():array {
        $stadiums = Stadium::getAll();
        return $stadiums;
    }

    public static function getStadById($id):array {
        $stadium = Stadium::getById($id);
        $city = City::getById($stadium['ville_id']);
        $stadium['city'] = $city;
        return $stadium;
    }

    public static function getStadByName($name):array {
        $stadium = Stadium::getStadByName($name);

        return $stadium;
    }

//     public static function createStad($name, $capacity, $city) {
//         $result = Stadium::create($name, $capacity, $city);
//         return $result;
//     }

//     public static function updateStad($id, $name, $capacity, $city) {
//         $result = Stadium::update($id, $name, $capacity, $city);
//         return $result;
//     }

//     public static function deleteStad($id) {
//         $result = Stadium::delete($id);
//         return $result;
//     }
 }