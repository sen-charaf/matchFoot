<?php

trait DbConnection{

    static private $host = "localhost:88";
    static private $user = "root"; 
    static private $pass = ""; 
    static private $dbname = "efoot";
    static private $charset = "utf8mb4";

    // static private $host = "efoot-ilisi1-2025-marwanmoujahid008-82ae.h.aivencloud.com:19232";
    // static private $user = "avnadmin"; 
   
    // static private $dbname = "efoot";
    // static private $charset = "utf8mb4";

    public static function connect(){
        try {
            $dsn = "mysql:host=".self::$host.";dbname=".self::$dbname.";charset=".self::$charset;
            $pdo = new PDO($dsn, self::$user, self::$pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        } catch (PDOException $e) {
            echo "Connection failed: ".$e->getMessage();
        }
    }


}

