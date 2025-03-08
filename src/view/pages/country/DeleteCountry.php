<?php
require_once __DIR__ . '/../../../controller/CountryController.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    CountryController::deleteCountry($id);
    
}