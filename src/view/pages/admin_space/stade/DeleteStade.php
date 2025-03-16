<?php
require_once __DIR__ . '/../../../../controller/StadiumController.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    StadiumController::deleteStad($id);
    
}