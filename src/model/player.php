<?php

namespace player;

use PDO;
use Person; // Ensure the correct namespace for Person class

class Player extends Person
{
    private int $idPlayer;
    private float $poid;
    private float $taille;
    private string $foot;
    private string $photoPath;
    private int $equip;


    private function isExist(int $idPlayer): bool
    {
        $query = "SELECT COUNT(*) FROM joueur WHERE id_joueur=?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$idPlayer]);
        return $stmt->fetchColumn() > 0;
    }


    public function __construct(string $firstName, string $lastName, string $birthDate, float $poid, float $taille, string $foot, string $photoPath, int $equip)
    {
        // Initialize child-specific properties
        $this->poid = $poid;
        $this->taille = $taille;
        $this->foot = $foot;
        $this->photoPath = $photoPath;
        $this->equip = $equip;

        // Call the parent constructor (PDO already exists in Person)
        parent::__construct(null, $firstName, $lastName, $birthDate);
    }



    // CREATE
    public function create(): bool
    {
        $query = "INSERT INTO joueur (nom, prenom, date_naissance, pied, poid, taille, equip, photoPath) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($query);

        return $stmt->execute([
            $this->firstName,  // nom
            $this->lastName,   // prenom
            $this->birthDate,  // date_naissance
            $this->foot,       // pied
            $this->poid,       // poid
            $this->taille,     // taille
            $this->equip,      // equip
            $this->photoPath   // photoPath
        ]);
    }

    // UPDATE
    public function update(int $idPlayer, string $firstName, string $lastName, string $birthDate, float $poid, float $taille, int $equip, string $foot, string $photoPath): bool
    {
        if (!$this->isExist($idPlayer)) return false;

        $this->idPlayer = $idPlayer;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->birthDate = $birthDate;
        $this->poid = $poid;
        $this->taille = $taille;
        $this->foot = $foot;
        $this->photoPath = $photoPath;
        $this->equip = $equip;

        $query = "UPDATE joueur SET nom=?, prenom=?, date_naissance=?, pied=?, poid=?, taille=?, equip=?, photoPath=? WHERE id_joueur=?";
        $stmt = $this->pdo->prepare($query);

        return $stmt->execute([
            $firstName,  // nom
            $lastName,   // prenom
            $birthDate,  // date_naissance
            $foot,       // pied
            $poid,       // poid
            $taille,     // taille
            $equip,      // equip
            $photoPath,  // photoPath
            $idPlayer   // id_joueur
        ]);
    }

    // DELETE
    public function delete(int $idPlayer): bool
    {
        if (!$this->isExist($idPlayer)) return false;

        $query = "DELETE FROM joueur WHERE id_joueur=?";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([$idPlayer]);
    }

    // read all players
    public function getAllPlayers(int $page=0,int $perPage=30): array
    {
        if( $page < 1 ) $page=1;
        
        if( $perPage < 1 )    $perPage = 20;


        $offset = ($page - 1) * $perPage;

        $query = "SELECT * FROM joueur LIMIT :perPage OFFSET :offset";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // read single player by id
    public function getById(int $idPlayer): ?array
    {
        $query = "SELECT * FROM joueur WHERE id_joueur=?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$idPlayer]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    } 

    public function getPlayersByAge(int $minAge = 0, int $maxAge = 100): array
    {
        $query = "SELECT *, TIMESTAMPDIFF(YEAR, date_naissance, CURDATE()) AS age 
                FROM joueur 
                WHERE TIMESTAMPDIFF(YEAR, date_naissance, CURDATE()) BETWEEN ? AND ?";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$minAge, $maxAge]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /* search */
    public function searchByFullName(string $firstName, string $lastName): array
    {
        $query = "SELECT * FROM joueur WHERE nom LIKE ? OR prenom LIKE ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(["%$firstName%", "%$lastName%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function searchByLastName(string $lastName): array
    {
        $query = "SELECT * FROM joueur WHERE nom LIKE ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(["%$lastName"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function searchByTeam(string $team): array
    {
        $query = "SELECT * FROM joueur WHERE equip LIKE ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(["%$team%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    


    /* count player */

    // count all the players
    public function countAll(): int
    {
        
        $query = "SELECT count(*)  as player_count FROM joueur ";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $stmt->fetch(PDO::FETCH_ASSOC);
        return $stmt['player_count'];
    
    }

    // count the players of a team
    public function countTeam(string $team): int
    {
        if(!isset($team)) return 0;

        $query = "SELECT count(*)  as player_count FROM joueur  WHERE equip='?'";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$team]);
        $stmt->fetch(PDO::FETCH_ASSOC);
        return $stmt['player_count'];
    }

}
?>