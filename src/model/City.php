<?php
require_once __DIR__ . '/../database/connectDB.php';
require_once __DIR__ . '/Model.php';
class City extends Model
{

    use DbConnection;

    protected static $table = 'villes';

    private $id;
    private $name;

    public function __construct($id, $name)
    {
        $this->$id = $id;
        $this->$name = $name;
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



    
}
