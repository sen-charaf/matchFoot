<?php 


class Player extends Model{

    protected static $table = 'joueurs';

    public static $id='id';
    public static $firstName='name';
    public static $lastName='surname';
    public static $weight='weight';
    public static $height='height';
    public static $birthdate='birth_date';
    public static $country_id='country_id';
    public static $club_id='club_id';
    public static $position_id='position_id';

    public function __construct($id, $firstName, $lastName, $weight, $height, $birthdate, $country_id, $club_id, $position_id) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->weight = $weight;
        $this->height = $height;
        $this->birthdate = $birthdate;
        $this->country_id = $country_id;
        $this->club_id = $club_id;
        $this->position_id = $position_id;
    }

    public function __get($name) {
        return $this->$name;
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }
}