<?php
require_once __DIR__ . '/Model.php';


class Player extends Model{

    protected static $table = 'player';

    public static $id='id';
    public static $firstName='name';
    public static $lastName='surname';
    public static $weight='weight';
    public static $height='height';
    public static $foot='foot';
    public static $birthDate='birth_date';
    public static $profilePath='profile_path';
    public static $countryId='country_id';
    public static $clubId='club_id';
    public static $positionId='position_id';

    public function __construct($id, $firstName, $lastName, $weight, $height, $birthDate,$profilePath, $countryId, $clubId, $positionId) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->weight = $weight;
        $this->height = $height;
        $this->birthDate = $birthDate;
        $this->profilePath = $profilePath;
        $this->countryId = $countryId;
        $this->clubId = $clubId;
        $this->positionId = $positionId;
    }

    public function __get($name) {
        return $this->$name;
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }
}