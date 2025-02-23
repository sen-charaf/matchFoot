<?php

function uploadImage($image,$uploadDir){
    if (isset($image)) {
        if ($image["error"] !== UPLOAD_ERR_OK)
            jsonResponse(['message' => 'Image Upload Failed', 'status' => 400],400);



        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $fileName = basename($image['name']);
        $fileTmpPath = $image['tmp_name'];
        $fileSize = $image['size'];
        $fileType = $image['type'];

        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];

        if (!in_array($fileType, $allowedTypes)) 
            jsonResponse(['message' => 'Invalid file type. Only JPG and PNG allowed.', 'status' => 400],400);

        $newFileName = time() . "_" . uniqid() . "_" . $fileName;

        $destination = $uploadDir . $newFileName;

        if (!move_uploaded_file($fileTmpPath, $destination)) 
            jsonResponse(['message' => 'Failed to move uploaded file.', 'status' => 500],500);

        return $newFileName;
    }
}