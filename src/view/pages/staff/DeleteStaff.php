<?php 
require_once __DIR__ . '/../../../controller/StaffController.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    StaffController::deleteStaff($id);
    
}