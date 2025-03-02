<?php
require_once __DIR__ . '/../helper/UploadFileHelper.php';
require_once __DIR__ . '/../model/Club.php';
require_once __DIR__ . '/StadiumController.php';

class ClubController
{

    public static function index(): array
    {
        try {
            $clubs = Club::getAll();
            $modifiedClubs = [];
            if ($clubs) {
                foreach ($clubs as $club) {
                    $stade = StadiumController::getStadById($club['stad_id']);
                    $club['logo'] = 'http://efoot/logo?file=' . $club['logo_path'];
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

        $stadium = Stadium::getById($club['stad_id']);
        $trainer = null; // Placeholder for now

        $club['logo'] = 'http://efoot/logo?file=' . $club['logo_path'];
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
            $stadium = StadiumController::getStadByName($stad_id);
            $club = [
                'nom' => $name,
                'nickname' => $nickname,
                'logo_path' => $logo_path,
                'entraineur_id' => $trainer_id,
                'stad_id' => $stadium['id'],
                'founded_at' => $founded_at,
                'created_at' => $created_at
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
        $stad_id = isset($_POST['stad_name']) ? trim($_POST['stad_name']) : null;
        $trainer_id = isset($_POST['trainer_id']) ? trim(intval($_POST['trainer_id'])) : null;
        $logo_path = null;
        $old_logo_path = null;

        if (empty($id) || empty($name) || empty($nickname) || empty($founded_at)) {
            $error = "All fields are required";
            include __DIR__ . '/../view/Error.php';
            return;
        }
        $club = Club::getById($id);
        $old_logo_path = $club['logo_path'];
        if (!$club) {
            $error = "Club not found";
            include __DIR__ . '/../view/Error.php';
            return;
        }

        // Handle file upload
        if (isset($_FILES["logo"])) {
            $logo = $_FILES["logo"];
            $uploadDir = __DIR__ . "/../../public/uploads/club_logo/";
            $logo_path = uploadImage($logo, $uploadDir);
        }

        $stade = StadiumController::getStadByName($stad_id);
        if(!$stade){
            $error = "Stadium not found";
            include __DIR__ . '/../view/Error.php';
            return;
        }


        $club = [
            'nom' => $name,
            'nickname' => $nickname,
            'founded_at' => $founded_at,
            'stad_id' => $stade['id'],
            'entraineur_id' => $trainer_id,
            'logo_path' => $logo_path,
            'created_at' => $club['created_at']
        ];

        try {

            $result = Club::update($id, $club);

            if ($result) {

                // Delete old logo if new logo is uploaded
                if ($logo_path && $old_logo_path) {
                    deleteImage(__DIR__ . "/../../public/uploads/club_logo/" . $old_logo_path);
                }

                header("Location: ClubList.php?updated=1");
                exit();
            } else {

                // Delete new logo if update failed
                if ($logo_path) {
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
            $logo_path = $club['logo_path'];
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
