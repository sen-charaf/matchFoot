<?php
require __DIR__ . "/../controller/palyerController.php";

use controllers\PlayerController;

    $player= new PlayerController();
    $player->delete();
    header("location:players.php");
?>