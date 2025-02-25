<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require_once __DIR__ . '/../../../controller/ArbitreController.php';

    $result = ArbitreController::validateData($_POST);
    switch ($result) {
        case 'missed_data':
            $_SESSION['message'] = 'Missed data';
            break;
        case 'empty_data':
            $_SESSION['message'] = 'Empty data';
            break;
        case 'success':

            if (ArbitreController::create($_POST))
                $_SESSION['message'] = 'Arbitre a été ajouter avec success';
            else
                $_SESSION['message'] = 'Erreur lors de l\'ajout du personnel';
            break;
    }
    header('Location: ArbitreForm.php');
}


?>