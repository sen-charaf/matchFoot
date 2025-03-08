<?php

namespace League;

use DbConnection;
use PDO;
use PDOException;

require __DIR__ . "/../database/connectDB.php";

class League {
    private  int $id;
    private  string $name;
    private  int  $clubsCount;
    private string $clubLogoPath;
    private string $leagueLogoPath;
    private int  $roundCount;

    public function __construct(int $id, string $name, int $clubsCount, string $leagueLogoPath, int $roundCount) {
        $this->id = $id;
        $this->name = $name;
        $this->clubsCount = $clubsCount;
        $this->leagueLogoPath = $leagueLogoPath;
        $this->roundCount = $roundCount;
    }

    public static function  create(string $name, int $clubsCount, string $leagueLogoPath, int $roundCount):bool
    {

        $stmt = DbConnection::connect()->prepare("INSERT INTO tournoies (nom,nbr_equipes, logo_path, nbr_round)
                                                VALUES (:name, :clubsCount , :leagueLogoPath, :roundCount)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':clubsCount', $clubsCount,PDO::PARAM_INT);
        $stmt->bindParam(':leagueLogoPath', $leagueLogoPath);
        $stmt->bindParam(':roundCount', $roundCount,PDO::PARAM_INT);

        return $stmt->execute();
    }

    public static function delete(int $id): bool
    {
        try
        {
            $stmt = DbConnection::connect()->prepare("DELETE FROM tournoies WHERE id = :id");
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
            return true;
        }catch (PDOException $e)
        {
            return false;
        }
    }

    public static function update(int $id, string $name, string $leagueLogoPath, int $roundCount): bool
    {
        $stmt = DbConnection::connect()->prepare("UPDATE tournoies  SET nom = :name, nbr_equipes = :clubsCount, leagueLogoPath = :leagueLogoPath, nbr_round = :roundCount WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':leagueLogoPath', $leagueLogoPath);
        $stmt->bindParam(':roundCount', $roundCount);
        return $stmt->execute();
    }

    public static function getAll(int $page=1, int $perPage=20) : array
    {
        if($page < 1) {
            $page = 1;
        }
        if($perPage < 1) {
            $perPage = 20;
        }
        
        $offset = ($page - 1) * $perPage;

        $stmt = DbConnection::connect()->query("SELECT * FROM tournoies LIMIT $perPage OFFSET " . $offset);
        $leagues = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $leagues;
    }

    public static function  getById(int $id): array | bool
    {
        $stmt = DbConnection::connect()->prepare("SELECT * FROM tournoies WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $league = $stmt->fetch(PDO::FETCH_ASSOC);
        return $league;
    }


    public static function getByName(string $name): array 
    {
        $stmt = DbConnection::connect()->prepare("SELECT * FROM tournoies WHERE nom LIKE :name");
        $stmt->bindValue(':name', "%$name%");
        $stmt->execute();
        $league = $stmt->fetch(PDO::FETCH_ASSOC);

        return is_bool($league) ? []: $league;
    }

    public static function getAllByName(string $name): array 
    {
        $stmt = DbConnection::connect()->prepare("SELECT * FROM tournoies WHERE nom LIKE :name");
        $stmt->bindValue(':name', "%$name%");
        $stmt->execute();
        $leagues = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return is_bool($leagues) ? []: $leagues;
    }


};



?>