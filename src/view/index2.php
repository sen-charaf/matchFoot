<?php


// Get the route from the URL
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($requestUri) {
    case '/':
        include __DIR__ . '/club/ClubList.php';
        break;

    case 'create-club':
        include __DIR__ . '/club_form.php';
        break;

    case '/logo' :
        if (!isset($_GET['file'])) {
            return; //jsonResponse(['message' => 'File name required'], 400);
        }
        $fileName = basename($_GET['file']);
        $filePath = __DIR__ . "/../../public/uploads/club_logo/" . $fileName;

        if (!file_exists($filePath)) {
            echo $filePath;
            return; //jsonResponse(['message' => 'File not found'], 404);
        }

        // Determine the correct Content-Type
        $mimeType = mime_content_type($filePath);
        header("Content-Type: " . $mimeType);
        readfile($filePath);
        
        exit;
    
    default:
        $error = "Page not found";
        include __DIR__ . '/error.php';
}
