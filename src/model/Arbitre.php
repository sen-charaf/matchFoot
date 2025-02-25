<?php
require_once __DIR__ . '/../database/connectDB.php';


require 'Person.php';

// use Person;

class Arbitre extends Person implements JsonSerializable
{

    use DbConnection;

    private static $table = 'arbitres';

    private $role;



    public function __construct($id, $firstName, $lastName, $birthDate, $role)
    {
        $this->role = $role;
        parent::__construct($id, $firstName, $lastName, $birthDate);
    }

    public static function getAll(int $page = 0, int $perPage = 30): array
    {
        if ($page < 1) {
            $page = 1;
        }
    
        if ($perPage < 1) {
            $perPage = 20;
        }
    
        $offset = ($page - 1) * $perPage;
    
        $table = self::$table;
        $pdo = self::connect();
        $query = "SELECT * FROM `$table` LIMIT :perPage OFFSET :offset";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
    
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return array_map(function ($arbitre) {
            return [
                'id'         => $arbitre['id'],
                'firstName'  => $arbitre['prenom'],
                'lastName'   => $arbitre['nom'],   
                'birthDate'  => $arbitre['date_naissance'],
                'role'       => $arbitre['role'],
            ];
        }, $result);
    }
    

    public static function getArbitreDataById($id)
    {
        try {
            $table = self::$table;
            $pdo = self::connect();
            $stmt = $pdo->prepare("SELECT * FROM `$table` WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $arbitreData = $stmt->fetch(PDO::FETCH_ASSOC);
            return $arbitreData;
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function create($id, $fistName, $lastName, $birthDate, $role)
    {
        try {
            $pdo = self::connect();
            $table = self::$table;

            $stmt = $pdo->prepare("INSERT INTO `$table` (id, nom, prenom, date_naissance, role) VALUES (:id, :fistName, :lastName, :birthDate, :role)");
            $stmt->execute([
                'id' => $id,
                'fistName' => $fistName,
                'lastName' => $lastName,
                'birthDate' => $birthDate,
                'role' => $role
            ]);

            $arbitre = new Arbitre($id, $fistName, $lastName, $birthDate, $role);
            return $arbitre;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public static function update($id, $fistName, $lastName, $birthDate, $role)
    {
        try {
            $pdo = self::connect();
            $table = self::$table;

            $stmt = $pdo->prepare("UPDATE `$table` SET id=:id, prenom=:firstName, nom=:lastName, date_naissance=:birthDate, role=:role WHERE id = :id");
            $stmt->execute([
                'id' => $id,
                'fistName' => $fistName,
                'lastName' => $lastName,
                'birthDate' => $birthDate,
                'role' => $role
            ]);

            $arbitre = new Arbitre($id, $fistName, $lastName, $birthDate, $role);
            return $arbitre;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public static function delete($id)
    {
        try {
            $pdo = self::connect();
            $table = self::$table;

            $stmt = $pdo->prepare("DELETE FROM `$table` WHERE id = :id");
            $stmt->execute(['id' => $id]);

            if ($stmt->rowCount() > 0) {

                print_r($stmt->rowCount());
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            throw $e;
        }
    }


    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'fistName' => $this->fistName,
            'lastName' => $this->lastName,
            'birthDate' => $this->birthDate,
            'role' => $this->role
        ];
    }



    public function getId()
    {
        return $this->id;
    }

    public function getFistName()
    {
        return $this->fistName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getBirthDate()
    {
        return $this->birthDate;
    }

    public function getRole()
    {
        return $this->role;
    }

}