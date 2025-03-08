<?php

function uploadImage($image,$uploadDir):string{
    if (isset($image)) {
        if ($image["error"] !== UPLOAD_ERR_OK){
            $error = "Error uploading file: " . $image["error"];
            include __DIR__ . '/../view/Error.php';
        }
            

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $fileName = basename($image['name']);
        $fileTmpPath = $image['tmp_name'];
        $fileSize = $image['size'];
        $fileType = $image['type'];

        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];

        if (!in_array($fileType, $allowedTypes))
        {
            $error = "Invalid file type. Only JPEG, JPG, and PNG files are allowed.";
            include __DIR__ . '/../view/Error.php';
        }

        $newFileName = time() . "_" . uniqid() . "_" . $fileName;

        $destination = $uploadDir . $newFileName;

        if (!move_uploaded_file($fileTmpPath, $destination)) 
        {
            $error = "Error uploading file.";
            include __DIR__ . '/../view/Error.php';
        }

        return $newFileName;
    }
    $error = "No file selected";
    include __DIR__ . '/../view/Error.php';
    return "";
}

function deleteImage($imagePath):bool{
    if (file_exists($imagePath)) {
        if(unlink($imagePath)){
            return true;
        }else{
            $error="Error deleting image";
            include __DIR__ . '/../view/Error.php';
            return false;
        }
    }
    $error="Image not found";
    include __DIR__ . '/../view/Error.php';
    return false;
}
