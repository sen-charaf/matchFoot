<?php


function jsonResponse($data, $status = 200,$exit=1) {
    header('Content-Type: application/json');
    http_response_code($status);
    echo json_encode($data);
    if($exit)
        exit; // Ensure script stops execution after sending JSON response
    else
        return;
}