<?php
require_once __DIR__ . '/../helper/responseHelper.php';
require_once __DIR__ . '/../helper/UploadFileHelper.php';
require_once __DIR__ . '/../model/Club.php';

class ClubController
{

    public static function getClubById($id)
    {
        $clubData = Club::getClubDataById($id);

        if (!$clubData) {
            jsonResponse(["message" => "Club not found", "status" => 404], 404);
        }

        $stadium = Stadium::getStadById($clubData['entraineur_id']);
        $trainer = null; // Placeholder for now

        $club = new Club(
            $clubData['id'],
            $clubData['name'],
            $clubData['nickname'],
            $clubData['created_at'],
            'http://efoot/logo' . $clubData['logo_path'],
            $clubData['logo_path'],
            $trainer,
            $stadium
        );

        jsonResponse(["message" => "Club retrieved", "status" => 200, "club" => $club], 200);
    }

    public static function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            isset($_POST['name']) ? $name = trim($_POST['name']) : $name = null;
            isset($_POST['nickname']) ? $nickname = trim($_POST['nickname']) : $nickname = null;
            isset($_POST['founded_at']) ? $founded_at = trim($_POST['founded_at']) : $founded_at = null;
            isset($_POST['satd_id']) ? $satd_id = trim($_POST['satd_id']) : $satd_id = null;
            isset($_POST['trainer_id']) ? $trainer_id = trim($_POST['trainer_id']) : $trainer_id = null;
            $logo_path = null;

            if (empty($name) | empty($nickname) | empty($founded_at))
                jsonResponse(['message' => 'All fields are required', 'status' => 400], 400);

            if (isset($_FILES["logo"])) {

                $logo = $_FILES["logo"];
                $uploadDir = __DIR__ . "/../public/uploads/club_logo/";
                $logo_path = uploadImage($logo, $uploadDir);
            }

            $created_at = date('Y-m-d H:i:s');

            try {
                $club = Club::create($name, $nickname, $logo_path, $trainer_id, $satd_id, $founded_at, $created_at);
                jsonResponse(['message' => 'Club created successfully', 'status' => 201, 'club' => $club], 201);
            } catch (Exception $e) {
                jsonResponse(['message' => 'Failed to create club', 'status' => 201, 'error' => $e->getMessage()], 500);
            }
        } else
            jsonResponse(['message' => 'Method not allowed', 'status' => 405], 405);
    }


    public static function deleteClub($id) {
        if (!$id) {
            echo json_encode(['message' => 'Club ID is required', 'status' => 400]);
            return;
        }
        
        try{
            $result = Club::delete($id);
            if ($result)
                jsonResponse(['message' => 'Club deleted successfully', 'status' => 200]);
            else
                jsonResponse(['message' => 'Club not found or already deleted', 'status' => 404],404);
        }catch(Exception $e){
            jsonResponse(["message" => "Error deleting club: " . $e->getMessage(), "status" => 500],500);
        }

    }

}
