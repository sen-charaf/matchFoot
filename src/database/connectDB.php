<?php

class DbConnection {

    private string $host        = "db";
    private string $user        = "root"; 
    private string $pass        = "root";
    private string $dbname      = "efoot";
    private string $charset     = "utf8mb4";

    public function __construct() {
        // todo work with entry env file
        // $this->host = $_ENV["MYSQL_HOST"];
        // $this->user = $_ENV["MYSQL_USER"];
        // $this->pass = $_ENV["MYSQL_PASSWORD"];
        // $this->dbname = $_ENV["MYSQL_DB_NAME"];
    }

    public function connect() {
        try {
            $dsn = "mysql:host=" . $this->getHost() . ";dbname=" . $this->getDbname() . ";charset=" . $this->getCharset();
            $pdo = new PDO($dsn, $this->getUser(), $this->getPass());
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
