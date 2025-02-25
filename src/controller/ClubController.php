<?php
require_once __DIR__ . '/../helper/UploadFileHelper.php';
require_once __DIR__ . '/../model/Club.php';
require_once __DIR__ . '/StadiumController.php'; 

class ClubController
{

    public static function index()
    {
        try {
            $clubs = Club::getAllClubs();
            if ($clubs) {
                $objectClubs = [];
                foreach ($clubs as $club) {
                    $stade = StadiumController::getStadById($club['stad_id']);
                    $objectClubs[] = new Club(
                        $club['id'],
                        $club['nom'],
                        $club['nickname'],
                        $club['founded_at'],
                        $club['created_at'],
                        'http://efoot/logo?file=' . $club['logo_path'],
                        $club['logo_path'],
                        null,
                        $stade
                    );
                }
                return $objectClubs;
            }else{
                return null;
            }
        } catch (Exception $e) {
            $error = "Error fetching clubs: " . $e->getMessage();
            include __DIR__ . '/../view/Error.php';
            return;
        }

    }
    public static function getClubById($id)
    {
        $clubData = Club::getClubDataById($id);

        if (!$clubData) {
            $error = "Club not found";
            include __DIR__ . '/../view/Error.php';
            return;
        }

        $stadium = Stadium::getStadById($clubData['stad_id']);
        $trainer = null; // Placeholder for now

        $club = new Club(
            $clubData['id'],
            $clubData['nom'],
            $clubData['nickname'],
            $clubData['founded_at'],
            $clubData['created_at'],
            'http://efoot/logo?file=' . $clubData['logo_path'],
            $clubData['logo_path'],
            $trainer,
            $stadium
        );

        return $club; // Display club details
    }

    public static function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = isset($_POST['name']) ? trim($_POST['name']) : null;
            $nickname = isset($_POST['nickname']) ? trim($_POST['nickname']) : null;
            $founded_at = isset($_POST['founded_at']) ? trim(intval($_POST['founded_at'])) : null;
            $stad_id = isset($_POST['stad_name']) ? trim($_POST['stad_name']) : null;
            $trainer_id = isset($_POST['trainer_id']) ? trim(intval($_POST['trainer_id'])) : null;
            $logo_path = null;

            if (empty($name) || empty($nickname) || empty($founded_at)) {
                $error = "All fields are required";
                include __DIR__ . '/../view/Error.php';
                return;
            }

            // Handle file upload
            if (isset($_FILES["logo"])) {

                $logo = $_FILES["logo"];
                $uploadDir = __DIR__ . "/../../public/uploads/club_logo/";
                $logo_path = uploadImage($logo, $uploadDir);
            }

            $created_at = date('Y-m-d H:i:s');
            $stadium=StadiumController::getStadByName($stad_id);

       

            try {
                $club = Club::create($name, $nickname, $logo_path, $trainer_id, $stadium['id'], $founded_at, $created_at);
                header("Location: ClubList.php?success=1");
                exit();
            } catch (Exception $e) {
                $error = "Failed to create club: " . $e->getMessage();
                include __DIR__ . '/../view/Error.php';
            }
        } else {
            $error = "Invalid request method";
            include __DIR__ . '/../view/Error.php';
        }
    }

    public static function update($id, $name, $nickname, $logo_path, $trainer_id, $stad_id, $founded_at, $created_at){

        try {
            $result = Club::update($id, $name, $nickname, $logo_path, $trainer_id, $stad_id, $founded_at, $created_at);
            if ($result) {
                header("Location: club_list.php?updated=1");
                exit();
            } else {
                $error = "Club not found or already updated";
                include __DIR__ . '/../view/Error.php';
            }
        } catch (Exception $e) {
            $error = "Error updating club: " . $e->getMessage();
            include __DIR__ . '/../view/Error.php';
        }
    }
    public static function deleteClub($id)
    {
        if (!$id) {
            $error = "Club ID is required";
            include __DIR__ . '/../view/Error.php';
            return;
        }

        try {
            $result = Club::delete($id);
            if ($result) {
                header("Location: ClubList.php?deleted=1");
            } else {
                $error = "Club not found or already deleted";
                include __DIR__ . '/../view/Error.php';
            }
        } catch (Exception $e) {
            $error = "Error deleting club: " . $e->getMessage();
            include __DIR__ . '/../view/Error.php';
        }
    }
}
