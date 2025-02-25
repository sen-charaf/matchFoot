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

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }   

    public static function getAllStads(){
        try {
            $table = self::$table;
            $pdo = self::connect();
            $stmt = $pdo->prepare("SELECT * FROM `$table`");
            $stmt->execute();
            $stads = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $stads;
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function getStadById($id){
        try {
            $table = self::$table;
            $pdo = self::connect();
            $stmt = $pdo->prepare("SELECT * FROM `$table` WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $stadData = $stmt->fetch(PDO::FETCH_ASSOC);
            return $stadData;
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function getStadByName($name){
        try {
            $table = self::$table;
            $pdo = self::connect();
            $stmt = $pdo->prepare("SELECT * FROM `$table` WHERE nom = :name");
            $stmt->execute(['name' => $name]);
            $stadData = $stmt->fetch(PDO::FETCH_ASSOC);
            return $stadData;
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function create($name,$capacity,$city){
        try {
            $pdo = self::connect();
            $table = self::$table;
            $stmt = $pdo->prepare("
                INSERT INTO `$table` (nom, capacity, city) 
                VALUES (:name, :capacity, :city)
            ");
            $stmt->execute([
                'name' => $name,
                'capacity' => $capacity,
                'city' => $city
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function update($id,$name,$capacity,$city){
        try {
            $pdo = self::connect();
            $table = self::$table;
            $stmt = $pdo->prepare("
                UPDATE `$table` 
                SET nom = :name, capacity = :capacity, city = :city 
                WHERE id = :id
            ");
            $stmt->execute([
                'name' => $name,
                'capacity' => $capacity,
                'city' => $city,
                'id' => $id
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }


    public static function delete($id) {
        try {
            $pdo = self::connect();
            $table = self::$table;
            $stmt = $pdo->prepare("DELETE FROM `$table` WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
