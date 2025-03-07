<?php

require_once __DIR__ . '/../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__); 
$dotenv->load();
var_dump($_ENV);

trait DbConnection
{

    static private $host;
    static private $user;
    static private $pass;
    static private $dbname;
    static private $charset;



    public static function connect()
    {

        self::$host = $_ENV['DB_HOST'];
        self::$user = $_ENV['DB_USER'];
        self::$pass = $_ENV['DB_PASS'];
        self::$dbname = $_ENV['DB_NAME'];
        self::$charset = $_ENV['DB_CHARSET'];
        try {
            $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$dbname . ";charset=" . self::$charset;
            $pdo = new PDO($dsn, self::$user, self::$pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}


