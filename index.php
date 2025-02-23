<?php

use controllers\PlayerController;

    require("./src/controller/palyerController.php");
    echo "<pre>";
    PlayerController::getAllPlayers();
    echo "</pre>";
?>