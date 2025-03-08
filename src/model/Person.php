<?php

namespace person;

require_once __DIR__ . '/../database/connectDB.php';
use DateTime;
use DbConnection;

class Person {
    use DbConnection;
    protected $id;
    protected $firstName;
    protected $lastName;
    protected $birthDate;
    protected $age;
    
    public function __construct($id, $firstName, $lastName, $birthDate){
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->birthDate = $birthDate;
    }

        public function getAge() {
        $birthDate = new DateTime($this->birthDate);
        $currentDate = new DateTime();
        $age = $currentDate->diff($birthDate)->y;
        return $age;
    }

}

