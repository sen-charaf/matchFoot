<?php

namespace person;

require_once __DIR__ . '/../database/connectDB.php';
use DateTime;


class Person {
    protected $pdo;
    protected $id;
    protected $firstName;
    protected $lastName;
    protected $birthDate;
    protected $age;
    
    public function __construct($pdo, $id, $firstName, $lastName, $birthDate){
        $this->pdo = $pdo;
        $this->id = $id;
        $this->firstName = $firstName;
        $this->birthDate = $birthDate;
    }

        public function getAge() {
        $birthDate = new DateTime($this->birthDate);
        $currentDate = new DateTime();
        $age = $currentDate->diff($birthDate)->y;
        return $age;
    }

}

