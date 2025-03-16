<?php 
require_once __DIR__ . '/../../../../controller/PlayerController.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    PlayerController::deletePlayer($id);
    
}