<?php
require_once __DIR__ . '/Model.php';


class Staff extends Model
{
    protected static $table = 'staff';
    public static $id= 'id';
    public static $firstName='name';
    public static $lastName='surname';
    public static $birthDate='birth_date';
    public static $role_id='role_id';

    public function __construct($id, $firstName, $lastName, $birthDate, $role)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->birthDate = $birthDate;
        $this->role = $role;
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

// use Person;

// class Staff extends Person implements JsonSerializable
// {

//     use DbConnection;

//     private static $table = 'staffs';

//     private $role;



//     public function __construct($id, $firstName, $lastName, $birthDate, $role)
//     {
//         $this->role = $role;
//         parent::__construct($id, $firstName, $lastName, $birthDate);
//     }

//     public static function getAll(int $page = 0, int $perPage = 30): array
//     {
//         if ($page < 1) {
//             $page = 1;
//         }
    
//         if ($perPage < 1) {
//             $perPage = 20;
//         }
    
//         $offset = ($page - 1) * $perPage;
    
//         $table = self::$table;
//         $pdo = self::connect();
//         $query = "SELECT * FROM `$table` LIMIT :perPage OFFSET :offset";
//         $stmt = $pdo->prepare($query);
//         $stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);
//         $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
//         $stmt->execute();
    
//         $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
//         return array_map(function ($staff) {
//             return [
//                 'id'         => $staff['id'],
//                 'firstName'  => $staff['prenom'],
//                 'lastName'   => $staff['nom'],   
//                 'birthDate'  => $staff['date_naissance'],
//                 'role'       => $staff['role'],
//             ];
//         }, $result);
//     }
    
//     public static function getStaffDataById($id)
//     {
//         try {
//             $table = self::$table;
//             $pdo = self::connect();
//             $stmt = $pdo->prepare("SELECT * FROM `$table` WHERE id = :id");
//             $stmt->execute(['id' => $id]);
//             $staffData = $stmt->fetch(PDO::FETCH_ASSOC);
//             return $staffData;
//         } catch (PDOException $e) {
//             return null;
//         }
//     }

//     public static function create($id, $fistName, $lastName, $birthDate, $role)
//     {
//         try {
//             $pdo = self::connect();
//             $table = self::$table;

//             $stmt = $pdo->prepare("INSERT INTO `$table` (id, nom, prenom, date_naissance, role) VALUES (:id, :fistName, :lastName, :birthDate, :role)");
//             $stmt->execute([
//                 'id' => $id,
//                 'fistName' => $fistName,
//                 'lastName' => $lastName,
//                 'birthDate' => $birthDate,
//                 'role' => $role
//             ]);

//             $staff = new Staff($id, $fistName, $lastName, $birthDate, $role);
//             return $staff;
//         } catch (PDOException $e) {
//             throw $e;
//         }
//     }

//     public static function update($id, $fistName, $lastName, $birthDate, $role)
//     {
//         try {
//             $pdo = self::connect();
//             $table = self::$table;

//             $stmt = $pdo->prepare("UPDATE `$table` SET id=:id, prenom=:firstName, nom=:lastName, date_naissance=:birthDate, role=:role WHERE id = :id");
//             $stmt->execute([
//                 'id' => $id,
//                 'fistName' => $fistName,
//                 'lastName' => $lastName,
//                 'birthDate' => $birthDate,
//                 'role' => $role
//             ]);

//             $staff = new Staff($id, $fistName, $lastName, $birthDate, $role);
//             return $staff;
//         } catch (PDOException $e) {
//             throw $e;
//         }
//     }

//     public static function delete($id)
//     {
//         try {
//             $pdo = self::connect();
//             $table = self::$table;

//             $stmt = $pdo->prepare("DELETE FROM `$table` WHERE id = :id");
//             $stmt->execute(['id' => $id]);

//             if ($stmt->rowCount() > 0) {

//                 print_r($stmt->rowCount());
//                 return true;
//             } else {
//                 return false;
//             }
//         } catch (PDOException $e) {
//             throw $e;
//         }
//     }

//     public function jsonSerialize(): array
//     {
//         return [
//             'id' => $this->id,
//             'fistName' => $this->fistName,
//             'lastName' => $this->lastName,
//             'birthDate' => $this->birthDate,
//             'role' => $this->role
//         ];
//     }

//     public function getId()
//     {
//         return $this->id;
//     }

//     public function getFistName()
//     {
//         return $this->fistName;
//     }

//     public function getLastName()
//     {
//         return $this->lastName;
//     }

//     public function getBirthDate()
//     {
//         return $this->birthDate;
//     }

//     public function getRole()
//     {
//         return $this->role;
//     }

// }