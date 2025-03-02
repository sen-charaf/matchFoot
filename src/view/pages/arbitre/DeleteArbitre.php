<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    require_once __DIR__ . '/../../../controller/ArbitreController.php';
    $arbitre = ArbitreController::getArbitreById($_GET['id']);
    if ($arbitre) {
        $result = ArbitreController::deleteArbitre($arbitre['id']);
        
        if ($result) {
            $_SESSION['message'] = 'Arbitre deleted successfully';
            header('Location: Arbitres.php');
        } else {
            $_SESSION['message'] = 'Arbitre not found';
            header('Location: Arbitres.php');
        }
    } else {
        $_SESSION['message'] = 'Arbitre not found';
        header('Location: Arbitres.php');
    }
}


?>