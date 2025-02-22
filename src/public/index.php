<?php

require_once __DIR__ . '/../controller/AuthController.php';

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Route handler
function route($uri, $method) {
    if ($_SERVER['REQUEST_URI'] === $uri && $_SERVER['REQUEST_METHOD'] === $method) {
        return true;
    }
    return false;
}

// Define routes
header('Content-Type: application/json');
if (route('/signup', 'POST')) {
    // Handle signup POST request
    $res = AuthController::signup();
    
} elseif (route('/login', 'POST')) {
    // You can handle other routes here, e.g., login form
    $res = AuthController::login();
}elseif (route('/logout', 'GET')) {
    // You can handle other routes here, e.g., login form
    $res = AuthController::logout();
} else {
    echo "404 - Page not found. ".$_SERVER['REQUEST_URI'];
}
