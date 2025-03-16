<?php 
require_once __DIR__ . '/../../../../controller/RefereeController.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    RefereeController::deleteReferee($id);
    
}