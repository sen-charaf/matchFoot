<?php
require __DIR__ . "/../../controller/LeagueController.php";
use controllers\LeagueController;
use League\League;

    if(LeagueController::delete())
    {
        header("location: Leagues.php");
    }
    else {
        echo "Error deleting league id:". $_GET['id'];
    }


?>