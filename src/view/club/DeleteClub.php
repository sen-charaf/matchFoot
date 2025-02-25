<?php
require_once __DIR__ . '/../../controller/ClubController.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    ClubController::deleteClub($id);
    
}