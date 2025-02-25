<?php

class DbConnection {

    static private $host = "db";
    static private $user = "root"; 
    static private $pass = "root"; 
    static private $dbname = "efoot";
    static private $charset = "utf8mb4";

    public static function connect(){
        try {
            $dsn = "mysql:host=".self::$host.";dbname=".self::$dbname.";charset=".self::$charset;
            $pdo = new PDO($dsn, self::$user, self::$pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    // Getters
    private function getHost(): string { return $this->host; }
    private function getUser(): string { return $this->user; }
    private function getPass(): string { return $this->pass; }
    private function getDbname(): string { return $this->dbname; }
    private function getCharset(): string { return $this->charset; }

}
