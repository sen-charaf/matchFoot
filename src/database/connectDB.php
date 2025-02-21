<?php

class DbConnection{

    private $host = "localhost:88";
    private $user = "root"; 
    private $pass = ""; 
    private $dbname = "efoot";
    private $charset = "utf8mb4";

    public function connect(){
        try {
            $dsn = "mysql:host=".$this->host.";dbname=".$this->dbname.";charset=".$this->charset;
            $pdo = new PDO($dsn, $this->user, $this->pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        } catch (PDOException $e) {
            echo "Connection failed: ".$e->getMessage();
        }
    }


}

