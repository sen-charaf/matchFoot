<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require_once __DIR__ . '/../controller/AuthController.php';
require_once __DIR__ . '/../controller/ClubController.php';
require_once __DIR__ . '/../model/User.php';

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];
//midlleWares 


// Route handler function
$routes = [
    'POST' => [
        '/signup' => [AuthController::class, 'signup'],
        '/login' => [AuthController::class, 'login'],
        '/create_club' => [ClubController::class, 'store']
    ],
    'GET' => [
        '/club_list' => [ClubController::class, 'index'],
        '/logout' => [AuthController::class, 'logout'],
        '/getUser' => function () {
            $userId = $_GET['id'] ?? null;
            if (!$userId) {
                return jsonResponse(['message' => 'User ID required'], 400);
            }
            return jsonResponse(User::getUser($userId));
        },
        '/profiles' => function () {
            if (!isset($_GET['file'])) {
                return jsonResponse(['message' => 'File name required'], 400);
            }
            $fileName = basename($_GET['file']);
            $filePath = __DIR__ . "/uploads/profiles/" . $fileName;

            if (!file_exists($filePath)) {
                return jsonResponse(['message' => 'File not found'], 404);
            }

            // Determine the correct Content-Type
            $mimeType = mime_content_type($filePath);
            header("Content-Type: " . $mimeType);
            readfile($filePath);
            exit;
        },
        '/club_logo' => function () {
            if (!isset($_GET['file'])) {
                return jsonResponse(['message' => 'File name required'], 400);
            }
            $fileName = basename($_GET['file']);
            $filePath = __DIR__ . "/uploads/club_logo/" . $fileName;

            if (!file_exists($filePath)) {
                return jsonResponse(['message' => 'File not found'], 404);
            }

            // Determine the correct Content-Type
            $mimeType = mime_content_type($filePath);
            header("Content-Type: " . $mimeType);
            readfile($filePath);
            exit;
        }

    ]
];


if (isset($routes[$requestMethod][$requestUri])) {
    $response = call_user_func($routes[$requestMethod][$requestUri]);
    exit($response);
}

// 404 Response
//jsonResponse(['message' => '404 - Page not found', 'requested_url' => $requestUri], 404);

// Helper function to send JSON responses
// function jsonResponse($data, $statusCode = 200)
// {
//     http_response_code($statusCode);
//     header('Content-Type: application/json');
//     echo json_encode($data);
//     exit;
// }
