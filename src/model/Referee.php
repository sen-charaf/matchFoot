<?php
require_once __DIR__ . '/../model/Model.php';

class Referee extends Model{
    
    protected static $table = 'referee';
    public static $id = 'id';
    public static $firstName = 'name';
    public static $lastName = 'surname';
    public static $birthDate = 'birth_date';
    public static $country_id = 'country_id';

    public function __construct($id, $firstName, $lastName, $birthDate, $country_id)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->birthDate = $birthDate;
        $this->country_id = $country_id;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

}