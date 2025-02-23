<?php
require_once __DIR__ . '/../database/connectDB.php';

class Stadium
{

    use DbConnection;

    private static $table = 'stads';

    private $id;
    private $name;
    private $capacity;
    private $city;

    public function __construct($id,$name,$capacity,$city)
    {
        $this->id=$id;
        $this->name=$name;
        $this->capacity=$capacity;
        $this->city=$city;
    }

    public static function getStadById($id){
        
    }
}
