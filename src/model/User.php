<?php
require_once __DIR__ . '/../database/connectDB.php';

class User extends DbConnection
{
    private static $table = 'user';

    

    protected $id;
    protected $username;
    protected $displayed_name;
    protected $email;
    protected $password;
    protected $profile_path;
    protected $created_at;

    public function __construct($id, $username, $displayed_name, $email, $password, $profile_path = null, $created_at)
    {
        
        $this->id = $id;
        $this->username = $username;
        $this->displayed_name = $displayed_name;
        $this->email = $email;
        $this->password = $password;
        $this->profile_path = $profile_path;
        $this->created_at = $created_at;
    }

    public static function getUser($id)
    {

        try {
            $table = self::$table;
            $pdo = self::connect();
            $stmt = $pdo->prepare("SELECT * FROM `$table` WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($userData) {
                return new User(
                    $pdo,
                    $userData['id'],
                    $userData['username'],
                    $userData['displayed_name'],
                    $userData['email'],
                    $userData['password'],
                    $userData['profile_path'],
                    $userData['created_at']
                );
            }
        } catch (PDOException $e) {
            $e->getMessage();
            return null;
        }
    }

    public static function getUserByEmailOrUsername($email, $username)
    {
        try {
            $table = self::$table;
            $pdo = self::connect();
            $stmt = $pdo->prepare("SELECT * FROM `$table` WHERE email = :email OR username = :username");
            $stmt->execute(['email' => $email, 'username' => $username]);
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($userData) {
                return new User(
                    $pdo,
                    $userData['id'],
                    $userData['username'],
                    $userData['displayed_name'],
                    $userData['email'],
                    $userData['password'],
                    $userData['profile_path'],
                    $userData['created_at']
                );
            }
        } catch (PDOException $e) {
            $e->getMessage();
            return null;
        }
    }

    public static function create($username, $displayed_name=null, $email, $password, $profile_path, $created_at)
    {
        

        try {
            $pdo = self::connect();
            $table = self::$table;
            $stmt = $pdo->prepare(" INSERT INTO `$table` (username, displayed_name, email, password, profile_path) 
                                VALUES (:username, :displayed_name, :email, :password, :profile_path)");
            $stmt->execute(['username' => $username, 'displayed_name' => $displayed_name, 'email' => $email, 'password' => $password, 'profile_path' => $profile_path]);
            $id = $pdo->lastInsertId();
            return new User($pdo, $id, $username, $displayed_name, $email, $password, $profile_path, $created_at);
        } catch (PDOException $th) {
            $th->getMessage();
            return null;
        } catch (Exception $e) {
            $e->getMessage();
            return null;
        }
    }

    public function update() {}


    //To be Updated
    public function delete()
    {

        try {
            $table = self::$table;
            $pdo = self::connect();
            $stmt = $pdo->prepare("DELETE FROM `$table` WHERE id = :id");
            $stmt->execute(['id' => $this->id]);
            return true;
        } catch (PDOException $e) {
            $e->getMessage();
            return false;
        }
    }
}
