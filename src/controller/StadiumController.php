<?php
require_once __DIR__ . '/../model/Stadium.php';
require_once __DIR__ . '/../model/City.php';

class StadiumController {
    public static function getAllStads() {
        $stadiums = Stadium::getAllStads();
        return $stadiums;
    }

    public static function getStadById($id) {
        $stadium = Stadium::getStadById($id);
        $city = City::getCityById($stadium['ville_id']);
        return new Stadium($stadium['id'], $stadium['nom'], $stadium['capacity'], $city);
    }

    public static function getStadByName($name) {
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