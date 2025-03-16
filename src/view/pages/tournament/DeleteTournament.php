<?php
require_once __DIR__ . '/../../../controller/TournamentController.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    TournamentController::deleteTournament($id);
    
}