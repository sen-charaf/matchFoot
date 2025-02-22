<?php

require_once __DIR__ . '/../database/connectDB.php';
require_once __DIR__ . '/../model/User.php';

class AuthController{

    public static function signup(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            isset($_POST['username']) ? $username = trim($_POST['username']) : $username = '';
            isset($_POST['displayed_name']) ? $displayed_name = trim($_POST['displayed_name']) : $displayed_name = '';
            isset($_POST['email']) ? $email = trim($_POST['email']) : $email = '';
            isset($_POST['password']) ? $password = trim($_POST['password']) : $password = '';
            isset($_POST['confirm_password']) ? $confirm_password = trim($_POST['confirm_password']) : $confirm_password = '';
            isset($_POST['pofile_image']) ? $pofile_image = trim($_POST['pofile_image']) : $pofile_image = '';

        
            if(empty($username)  || empty($email) || empty($password) || empty($confirm_password)){
                echo json_encode(['message' => 'All fields are required', 'status' => 400]);
                return;
            }

            if($password !== $confirm_password){
                echo json_encode(['message' => 'Passwords do not match', 'status' => 400]);
                return;
            }

            $existingUser = User::getUserByEmailOrUsername($email, $username);
            if($existingUser){
                echo json_encode(['message' => 'User already exists', 'status' => 400]);
                return;
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $created_at = date('Y-m-d H:i:s');
            $displayed_name = $displayed_name ?? $username;
            $res = User::create($username, $displayed_name, $email, $hashedPassword,$created_at);
            $res_array=json_decode($res,true);
            if( $res_array['status'] === 201){
                echo $res;
                return;
            }

            echo $res;
            return;
        }else{
            echo json_encode(['message' => 'Method not allowed', 'status' => 405]);
            return;
        }
    }

    public static function login(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            isset($_POST['email']) ? $email = trim($_POST['email']) : $email = '';
            isset($_POST['username']) ? $username = trim($_POST['username']) : $username = '';
            isset($_POST['password']) ? $password = trim($_POST['password']) : $password = '';

            if(empty($email) || empty($password)){
                echo json_encode(['message' => 'All fields are required', 'status' => 400]);
                return;
            }
            
            $user = User::getUserByEmailOrUsername($email, $username);
            if(!$user){
                echo json_encode(['message' => 'User not found', 'status' => 404]);
                return;
            }

            echo $user->getHashedPassword();            
            if(!password_verify($password, $user->password)){
                echo json_encode(['message' => 'Invalid credentials', 'status' => 400]);
                return;
            }

            session_start();
            $_SESSION['user'] = $user;

            echo json_encode(['message' => 'Login successful', 'status' => 200, 'user' => $user]);
            return;

        }else{
            echo json_encode(['message' => 'Method not allowed', 'status' => 405]);
            return;
        }
    }

    public static function logout(){
        session_start();
        if(!isset($_SESSION['user'])){
            echo json_encode(['message' => 'User not logged in', 'status' => 400]);
            return;
        }
        session_destroy();
        echo json_encode(['message' => 'Logout successful', 'status' => 200]);
        return;
    }
}