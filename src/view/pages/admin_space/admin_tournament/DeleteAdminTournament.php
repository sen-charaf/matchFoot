<?php
require_once __DIR__ . '/../../../../controller/AdminTournamentController.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    AdminTournamentController::deleteAdminTournament($id);
    
}