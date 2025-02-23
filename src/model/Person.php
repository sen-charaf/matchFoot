<?php
require_once __DIR__ . '/../database/connectDB.php';

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
        $this->fistName = $firstName;
        $this->birthDate = $birthDate;
    }

        public function getAge() {
        $birthDate = new DateTime($this->birthDate);
        $currentDate = new DateTime();
        $age = $currentDate->diff($birthDate)->y;
        return $age;
    }

}

