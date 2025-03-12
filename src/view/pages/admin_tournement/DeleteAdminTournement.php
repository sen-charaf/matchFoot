<?php
require_once __DIR__ . '/../../../controller/AdminTournementController.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    AdminTournementController::deleteAdminTournement($id);
    
}