<?php
require_once __DIR__ . '/../helper/UploadFileHelper.php';
require_once __DIR__ . '/../model/Club.php';
require_once __DIR__ . '/StadiumController.php';
require_once __DIR__ . '/Controller.php';

class ClubController extends Controller
{

    public static function index(): array
    {
        try {
            $clubs = Club::getAll();
            $modifiedClubs = [];
            if ($clubs) {
                foreach ($clubs as $club) {
                    $stade = StadiumController::getStadById($club[Club::$stadium_id]);
                    $club['logo'] = 'http://efoot/logo?file=' . $club[Club::$logo_path];
                    $club['stadium'] = $stade;
                    $club['trainer'] = null;
                    $modifiedClubs[] = $club;
                }
                return $modifiedClubs;
            } else {
                return [];
            }
        } catch (Exception $e) {
            $error = "Error fetching clubs: " . $e->getMessage();
            include __DIR__ . '/../view/Error.php';
            return [];
        }
    }
    public static function getClubById($id): array
    {
        $club = Club::getById($id);
        if (!$club) {
            $error = "Club not found";
            include __DIR__ . '/../view/Error.php';
            return [];
        }

        $stadium = Stadium::getById($club[Club::$stadium_id]);
        $trainer = null; // Placeholder for now

        $club['logo'] = 'http://efoot/logo?file=' . $club[Club::$logo_path];
        $club['stadium'] = $stadium;
        $club['trainer'] = $trainer;


        return $club; // Display club details
    }

    public static function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = isset($_POST['name']) ? trim($_POST['name']) : null;
            $nickname = isset($_POST['nickname']) ? trim($_POST['nickname']) : null;
            $founded_at = isset($_POST['founded_at']) ? trim(intval($_POST['founded_at'])) : null;
            $stade_id = isset($_POST['stade_id']) ? trim($_POST['stade_id']) : null;
            $trainer_id = isset($_POST['trainer_id']) ? trim(intval($_POST['trainer_id'])) : null;
            $logo_path = null;

            $data = [
                Club::$name => $name,
                Club::$nickname => $nickname,
                Club::$founded_at => $founded_at,
                Club::$stadium_id => $stade_id,
                Club::$trainer_id => $trainer_id
            ];

            $rules = [
                Club::$name => 'required',
                Club::$nickname => 'required|max:5',
                Club::$founded_at => 'required|numeric|max:4|min:4',
                Club::$stadium_id => 'required|numeric',
                Club::$trainer_id => 'numeric'
            ];

            $validate_result = self::validate($data, $rules);
          //  echo $validate_result;
            if ($validate_result !== true) {
                $error = $validate_result;
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

            if(!Stadium::exists([Club::$id => $stade_id])) {
                $error = "Stadium not found";
                include __DIR__ . '/../view/Error.php';
                return;
            }
            $club = [
                Club::$name => $name,
                Club::$nickname => $nickname,
                Club::$logo_path => $logo_path,
                Club::$trainer_id => $trainer_id,
                Club::$stadium_id => $stade_id,
                Club::$founded_at => $founded_at,
                Club::$created_at => $created_at
            ];

            try {

                Club::create($club);


                header("Location: ClubList.php?success=1");
                exit();
            } catch (Exception $e) {
                if ($logo_path) {
                    deleteImage(__DIR__ . "/../../public/uploads/club_logo/" . $logo_path);
                }
                $error = "Failed to create club: " . $e->getMessage();
                include __DIR__ . '/../view/Error.php';
            }
        } else {
            $error = "Invalid request method";
            include __DIR__ . '/../view/Error.php';
        }
    }

    public static function update(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $error = "Invalid request method";
            include __DIR__ . '/../view/Error.php';
            return;
        }


        $id = isset($_POST['id']) ? trim(intval($_POST['id'])) : null;
        $name = isset($_POST['name']) ? trim($_POST['name']) : null;
        $nickname = isset($_POST['nickname']) ? trim($_POST['nickname']) : null;
        $founded_at = isset($_POST['founded_at']) ? trim(intval($_POST['founded_at'])) : null;
        $stade_id = isset($_POST['stade_id']) ? trim($_POST['stade_id']) : null;
        $trainer_id = isset($_POST['trainer_id']) ? trim(intval($_POST['trainer_id'])) : null;
        $logo_path = null;
        $old_logo_path = null;

        $data = [
            Club::$name => $name,
            Club::$nickname => $nickname,
            Club::$founded_at => $founded_at,
            Club::$stadium_id => $stade_id,
            Club::$trainer_id => $trainer_id
        ];

        $rules = [
            Club::$name => 'required',
            Club::$nickname => 'required|max:5',
            Club::$founded_at => 'required|numeric|max:4|min:4',
            Club::$stadium_id => 'required|numeric',
            Club::$trainer_id => 'numeric'
        ];

        $validate_result = self::validate($data, $rules);
      //  echo $validate_result;
        if ($validate_result !== true) {
            $error = $validate_result;
            include __DIR__ . '/../view/Error.php';
            return;
        }

        if (empty($id) || empty($name) || empty($nickname) || empty($founded_at)) {
            $error = "All fields are required";
            include __DIR__ . '/../view/Error.php';
            return;
        }
        $club = Club::getById($id);
        $logo_path = $club[Club::$logo_path];
        
        if (!$club) {
            $error = "Club not found";
            include __DIR__ . '/../view/Error.php';
            return;
        }

        // Handle file upload
        if (isset($_FILES["logo"]) && $_FILES["logo"]["size"] > 0) {
            $error = $_FILES["logo"];
            include __DIR__ . '/../view/Error.php';
            return;
            $logo = $_FILES["logo"];
            $uploadDir = __DIR__ . "/../../public/uploads/club_logo/";
            $old_logo_path = $logo_path;
            $logo_path = uploadImage($logo, $uploadDir);
        }

        if(!Stadium::exists([Stadium::$id => $stade_id])) {
            $error = "Stadium not found";
            include __DIR__ . '/../view/Error.php';
            return;
        }

      


        $club = [
            Club::$name => $name,
            Club::$nickname => $nickname,
            Club::$founded_at => $founded_at,
            Club::$stadium_id => $stade_id,
            Club::$trainer_id => $trainer_id,
            Club::$logo_path => $logo_path,
            Club::$created_at => $club[Club::$created_at]
        ];

        try {

            $result = Club::update($id, $club);

            if ($result) {

                // Delete old logo if new logo is uploaded
                if ($old_logo_path) {
                    deleteImage(__DIR__ . "/../../public/uploads/club_logo/" . $old_logo_path);
                }

                header("Location: ClubList.php?updated=1");
                exit();
            } else {

                // Delete new logo if update failed
                if ($old_logo_path) {
                    deleteImage(__DIR__ . "/../../public/uploads/club_logo/" . $logo_path);
                }
                $error = "Club not found or already updated";
                include __DIR__ . '/../view/Error.php';
            }
        } catch (Exception $e) {
            $error = "Error updating club: " . $e->getMessage();
            include __DIR__ . '/../view/Error.php';
        }
    }


    public static function deleteClub($id): void
    {
        if (!$id) {
            $error = "Club ID is required";
            include __DIR__ . '/../view/Error.php';
            return;
        }

        try {
            $club = Club::getById($id);
            if (!$club) {
                $error = "Club not found";
                include __DIR__ . '/../view/Error.php';
                return;
            }
            $logo_path = $club[Club::$logo_path];
            $result = Club::delete($id);
            if (!$result) {
                $error = "Club not found or already deleted";
                include __DIR__ . '/../view/Error.php';
                return;
            }


            if ($result) {
                if ($logo_path) {
                    deleteImage(__DIR__ . "/../../public/uploads/club_logo/" . $logo_path);
                }
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
