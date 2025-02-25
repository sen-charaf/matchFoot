<?php

require __DIR__ . "/src/model/League.php";

use League\League;
use player\Player;

    echo "<pre>";
    print_r(League::getAll(1,20));
    echo "</pre>";
    // $player = new Player("maroruane","elmoujahid","2000-07-21",88,1.94,"D","dsd",9);
?>