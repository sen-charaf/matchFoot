<?php

namespace controllers;
require __DIR__ . '/../model/player.php';

use player\Player;
use DateTime;
use DbConnection;
use PDO;

class PlayerController
{
    private Player $player;

    
    public function __construct(/*PDO $pdo = DbConnection::connect()*/)
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
        }
    
        $this->player = new Player(
            $data['nom'],
            $data['prenom'],
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

    public  static function delete(): bool
    {
        if (!isset($_GET['id'])) {
            return false;
        
        }

        $idPlayer = intval($_GET['id']);
        return Player::delete($idPlayer);

    }

    public function validatePlayerData(array $data): bool
    {
        // Check if all required fields are present
        if (!isset($data['nom'], $data['prenom'], $data['date_naissance'], $data['poid'], $data['taille'], $data['pied'], $data['photoPath'], $data['equip'])) {
            return false;
        }
    
        // Validate data types and formats
        if (
            !is_string($data['nom']) || empty(trim($data['nom'])) || // 'nom' must be a non-empty string
            !is_string($data['prenom']) || empty(trim($data['prenom'])) || // 'prenom' must be a non-empty string
            !DateTime::createFromFormat('Y-m-d', $data['date_naissance']) || // 'date_naissance' must be a valid date in 'Y-m-d' format
            !is_numeric($data['poid']) || // 'poid' must be numeric
            !is_numeric($data['taille']) || // 'taille' must be numeric
            !in_array($data['pied'], ['left', 'right']) || // 'pied' must be either 'left' or 'right'
            !is_string($data['photoPath']) || empty(trim($data['photoPath'])) || // 'photoPath' must be a non-empty string
            !is_string($data['equip']) || empty(trim($data['equip'])) // 'equip' must be a non-empty string
        ) {
            return false;
        }
    
        // Additional validations (if needed)
        // For example, ensure 'poid' and 'taille' are positive numbers
        if ($data['poid'] <= 0 || $data['taille'] <= 0) {
            return false;
        }
    
        return true;
    }
}
?>
