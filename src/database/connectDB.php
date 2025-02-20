<?php
$host = "localhost:88";
$user = "root"; 
$pass = ""; 
$dbname = "efoot";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
