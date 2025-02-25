<?php

namespace controllers;
include __DIR__ . "/../model/League.php";
use League\League;
use PDO;

class LeagueController 
{
    private League $league;

    public function __construct()
    {
        $this->league = new League(0, "", 0, "", 0);
    }

    public static function getAll(): array
    {
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $perPage = isset($_GET['per_page']) ? intval($_GET['per_page']) : 20;

        return League::getAll($page, $perPage);
    }

    public static function getById(): array
    {
        if (!isset($_GET['id'])) {
            return [];
        }

        $idLeague = intval($_GET['id']);
        $league = League::getById($idLeague);

        if ($league) {
            return $league;
        } else {
            return [];
        }
    }

    public function create(): bool
    {
        $data = $_POST;

        if (!$this->validateLeagueData($data)) {
            return false;
        }

        $requiredFields = ['name', 'clubsCount', 'leagueLogoPath', 'roundCount'];
        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                return false;
            }
        }

        return League::create($data['name'], $data['clubsCount'], $data['leagueLogoPath'], $data['roundCount']);
    }

    public function update(): bool
    {
        $data = $_POST;

        if (!$this->validateLeagueData($data)) {
            return false;
        }

        $requiredFields = ['id', 'name', 'leagueLogoPath', 'roundCount'];
        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                return false;
            }
        }

        return League::update($data['id'], $data['name'], $data['leagueLogoPath'], $data['roundCount']);
    }

    public static function delete(): bool
    {
        if (!isset($_GET['id'])) {
            return false;
        }

        $idLeague = intval($_GET['id']);
        return League::delete($idLeague);

    }
    public function validateLeagueData(): bool
    {
        $data = $_POST;
        return isset($data['name']) && isset($data['clubsCount']) && isset($data['leagueLogoPath']) && isset($data['roundCount']);
    }

}


?>