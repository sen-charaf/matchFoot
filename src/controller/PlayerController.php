<?php
require_once __DIR__ . '/../model/Player.php';
require_once __DIR__ . '/Controller.php';

class PlayerController extends Controller {

    private static $uploadDirectory = __DIR__ . '/../../public/uploads/';
    private static $uploadSubDirectory = 'player_logo';
}