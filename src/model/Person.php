<?php
require_once __DIR__ . '/../database/connectDB.php';

class Person {
    use DbConnection;
    protected $id;
    protected $fistName;
    protected $lastName;
    protected $birthDate;
    protected $age;
    
    public function __construct($id, $fistName, $lastName, $birthDate){
        $this->id = $id;
        $this->fistName = $fistName;
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

