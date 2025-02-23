<?php

namespace controllers;
require __DIR__ . '/../model/player.php';

use player\Player;
use PDO;

class PlayerController
{
    private Player $player;

    public function __construct(PDO $pdo)
    {
        // $this->player = new Player("", "", "", 0, 0, "", "", 0);
        // $this->player->setPDO($pdo);
    }

    public static function  getAllPlayers() : array
    {
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $perPage = isset($_GET['per_page']) ? intval($_GET['per_page']) : 20;

        return  Player::getAllPlayers($page, $perPage);
    }


    public function getById(): array
    {
        if (!isset($_GET['id'])) {
            return ["error" => "ID is required"];
            
        }

        $idPlayer = intval($_GET['id']);
        $player = $this->player->getById($idPlayer);

        if ($player) {
            return $player;
        } else {
            return ["error" => "Player not found"];
        }
    }

    public function create(): bool
    {
        $data = $_POST;
    
        if (!$this->validatePlayerData($data)) {
            return false; 
        }
    
        
        $requiredFields = ['nom', 'prenom', 'date_naissance', 'poid', 'taille', 'pied', 'photoPath', 'equip'];
        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                return false;
            }
            // debug to delete 
            echo"$field: $data[$field]<br>";
        }
    
        $this->player = new Player(
            $data['nom'],
            // $data['prenom'],
            "dsdsd",
            $data['date_naissance'],
            floatval($data['poid']),
            floatval($data['taille']),
            $data['pied'],
            $data['photoPath'],
            intval($data['equip'])
        );
    
        return $this->player->create() ?? false; // Ensure a boolean return
    }
    

    public function update(): bool
    {
        $data = $_POST;

        if (!isset($data['id_joueur']) || !$this->validatePlayerData($data)) {
            return (["error" => "Invalid input"]);
        }

        return  $this->player->update(
            intval($data['id_joueur']),
            $data['nom'],
            $data['prenom'],
            $data['date_naissance'],
            floatval($data['poid']),
            floatval($data['taille']),
            intval($data['equip']),
            $data['pied'],
            $data['photoPath']
        );

    }

    public function delete(): array
    {
        if (!isset($_GET['id'])) {
            return (["error" => "ID is required"]);
        
        }

        $idPlayer = intval($_GET['id']);
        return $success = $this->player->delete($idPlayer);

    }

    private function validatePlayerData(array $data): bool
    {
        return isset($data['nom'], $data['prenom'], $data['date_naissance'], $data['poid'], $data['taille'], $data['pied'], $data['photoPath'], $data['equip']);
    }
}
?>
