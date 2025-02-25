<?php
require_once __DIR__ . '/../database/connectDB.php';

class City
{

    use DbConnection;

    private static $table = 'villes';

    private $id;
    private $name;

    public function __construct($id, $name)
    {
        $this->$id = $id;
        $this->$name = $name;
    }

    

    public static function getAllCities()
    {
        try {
            $pdo = self::connect();
            $table = self::$table;
            $stmt = $pdo->prepare("SELECT * FROM `$table`");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function getCityById($id)
    {
        try {
            $pdo = self::connect();
            $table = self::$table;
            $stmt = $pdo->prepare("SELECT * FROM `$table` WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function getCityByName($name)
    {
        try {
            $pdo = self::connect();
            $table = self::$table;
            $stmt = $pdo->prepare("SELECT * FROM `$table` WHERE name = :name");
            $stmt->execute(['name' => $name]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            return false;
        }
    }   

    public static function create($name) {
        try {
            $pdo = self::connect();
            $table = self::$table;
            $stmt = $pdo->prepare("
                INSERT INTO `$table` (name) 
                VALUES (:name)
            ");
            $stmt->execute([
                'name' => $name
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }   

    public static function update($id, $name) {
        try {
            $pdo = self::connect();
            $table = self::$table;
            $stmt = $pdo->prepare("
                UPDATE `$table` 
                SET name = :name 
                WHERE id = :id
            ");
            $stmt->execute([
                'name' => $name,
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
