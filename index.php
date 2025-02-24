<?php

require __DIR__ . "/src/model/player.php";
use player\Player;

        echo "<pre>";
    print_r(Player::getById(3));
    echo "</pre>";
    // $player = new Player("maroruane","elmoujahid","2000-07-21",88,1.94,"D","dsd",9);
?>