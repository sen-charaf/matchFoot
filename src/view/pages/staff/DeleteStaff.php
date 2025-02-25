<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    require_once __DIR__ . '/../../../controller/StaffController.php';
    $staff = StaffController::getStaffById($_GET['id']);
    if ($staff) {
        $result = StaffController::deleteStaff($staff['id']);
        
        if ($result) {
            $_SESSION['message'] = 'Staff deleted successfully';
            header('Location: Staffs.php');
        } else {
            $_SESSION['message'] = 'Staff not found';
            header('Location: Staffs.php');
        }
    } else {
        $_SESSION['message'] = 'Staff not found';
        header('Location: Staffs.php');
    }
}


?>