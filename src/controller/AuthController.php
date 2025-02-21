<?php

require_once __DIR__ . '/../database/connectDB.php';

class AuthController{

    public function signup(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $username = trim($_POST['username']);
            $displayed_name = trim($_POST['displayed_name']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $confirm_password = trim($_POST['confirm_password']);
            $pofile_image = trim($_POST['pofile_image']);

            if(empty($username)  || empty($email) || empty($password) || empty($confirm_password)){
                echo 'All fields are required';
                return;
            }


            if($password !== $confirm_password){
                echo 'Passwords do not match';
                return;
            }

            $existingUser = User::getUserByEmailOrUsername($email, $username);
            if($existingUser){
                echo 'User already exists';
                return;
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $created_at = date('Y-m-d H:i:s');
            $displayed_name = $displayed_name ?? $username;
            $user = User::create($username, $displayed_name, $email, $hashedPassword, $pofile_image, $created_at);
            if($user){
                echo 'User created successfully';
                return;
            }

            echo 'Failed to create user';
        }
    }
}