<?php
require_once __DIR__ . '/../model/Admin.php';
require_once __DIR__ . '/../helper/UploadFileHelper.php';
require_once __DIR__ . '/Controller.php';

class AdminTournementController extends Controller
{
    private static $uploadDirectory = __DIR__ . '/../../public/uploads/admin_profiles/';
    private static $uploadSubDirectory = 'admin_profiles';

    public static function index()
    {
        try {

            $admins = Admin::getByFields(['role_id' => 2]);
            $modifiedAdmins = [];
            if ($admins) {
                foreach ($admins as $admin) {
                    $admin['profile'] = 'http://efoot/logo?file=' . $admin[Admin::$profilePath] . '&dir=' . self::$uploadSubDirectory;
                    $modifiedAdmins[] = $admin;
                }
                return $modifiedAdmins;
            }
            return [];
        } catch (Exception $e) {
            $error = "Error fetching tournements: " . $e->getMessage();
            include __DIR__ . '/../view/Error.php';
            return [];
        }
        return $admin;
    }

    public static function getAdminById($id)
    {
        try {
            $admin = Admin::getById($id);
            if (!$admin) {
                $error = "Admin not found";
                include __DIR__ . '/../view/Error.php';
                return [];
            }

            $admin['profile'] = 'http://efoot/logo?file=' . $admin[Admin::$profilePath] . '&dir=' . self::$uploadSubDirectory;
        } catch (Exception $e) {
            $error = "Error fetching admin: " . $e->getMessage();
            include __DIR__ . '/../view/Error.php';
            return [];
        }
        return $admin;
    }

    public static function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $error = "Invalid request method";
            include __DIR__ . '/../view/Error.php';
            return;
        }

        $firstName = isset($_POST['first_name']) ? trim($_POST['first_name']) : null;
        $lastName = isset($_POST['last_name']) ? trim($_POST['last_name']) : null;
        $email = isset($_POST['email']) ? trim($_POST['email']) : null;
        $password = isset($_POST['password']) ? trim($_POST['password']) : null;
        $birthDate = isset($_POST['birth_date']) ? trim($_POST['birth_date']) : null;
        $phoneNumber = isset($_POST['phone_number']) ? trim($_POST['phone_number']) : null;
        $profilePath = null;

        $data = [
            Admin::$firstName => $firstName,
            Admin::$lastName => $lastName,
            Admin::$email => $email,
            Admin::$password => $password,
            Admin::$birthDate => $birthDate,
            Admin::$phoneNumber => $phoneNumber,
        ];

        $rules = [
            Admin::$firstName => 'required|max:255',
            Admin::$lastName => 'required|max:255',
            Admin::$email => 'required|email|unique',
            Admin::$password => 'required|min:6|max:255',
            Admin::$birthDate => 'required|date_format:Y-m-d',
            Admin::$phoneNumber => 'required|max:255'
        ];

        $validator_results = self::validate($data, $rules);

        if ($validator_results !== true) {
            $error = $validator_results;
            include __DIR__ . '/../view/Error.php';
            return;
        }

        if (isset($_FILES['profile_path'])) {
            $file = $_FILES['profile_path'];
            $profilePath = uploadImage($file, self::$uploadDirectory);
            if ($profilePath === false) {
                $error = "Error uploading profile image";
                include __DIR__ . '/../view/Error.php';
                return;
            }
        }

        $data[Admin::$profilePath] = $profilePath;
        try {
            $admin = Admin::create($data);
            if ($admin) {
                header('Location: AdminList.php');
            } else {
                $error = "Error creating admin";
                include __DIR__ . '/../view/Error.php';
            }
        } catch (Exception $e) {
            if ($profilePath) {
                deleteImage(self::$uploadDirectory . $profilePath);
            }
            $error = "Error creating admin: " . $e->getMessage();
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
        $firstName = isset($_POST['first_name']) ? trim($_POST['first_name']) : null;
        $lastName = isset($_POST['last_name']) ? trim($_POST['last_name']) : null;
        $email = isset($_POST['email']) ? trim($_POST['email']) : null;
        $password = isset($_POST['password']) ? trim($_POST['password']) : null;
        $birthDate = isset($_POST['birth_date']) ? trim($_POST['birth_date']) : null;
        $phoneNumber = isset($_POST['phone_number']) ? trim($_POST['phone_number']) : null;
        $profilePath = null;
        $oldProfilePath = null;


        $validator_results = self::validate($data, $rules);

        if ($validator_results !== true) {
            $error = $validator_results;
            include __DIR__ . '/../view/Error.php';
            return;
        }

        if (!$id) {
            $error = "Invalid admin id";
            include __DIR__ . '/../view/Error.php';
            return;
        }

        $admin = Admin::getById($id);

        if (!$admin) {
            $error = "Admin not found";
            include __DIR__ . '/../view/Error.php';
            return;
        }


        $data = [
            Admin::$id => $id,
            Admin::$firstName => $firstName,
            Admin::$lastName => $lastName,
            Admin::$email => $email,
            Admin::$password => $password,
            Admin::$birthDate => $birthDate,
            Admin::$phoneNumber => $phoneNumber,
        ];
        $rules = [
            Admin::$id => 'required|numeric',
            Admin::$firstName => 'required|max:255',
            Admin::$lastName => 'required|max:255',
            Admin::$email => 'required|email|unique',
            Admin::$password => 'required|min:6|max:255',
            Admin::$birthDate => 'required|date_format:Y-m-d',
            Admin::$phoneNumber => 'required|max:255'
        ];


        if (isset($_FILES['profile_path'])) 
        {
            $oldProfilePath = $admin[Admin::$profilePath];
            $file = $_FILES['profile_path'];
            $profilePath = uploadImage($file, self::$uploadDirectory);
            if ($profilePath === false) {
                $error = "Error uploading profile image";
                include __DIR__ . '/../view/Error.php';
                return;
            }
            $data[Admin::$profilePath] = $profilePath;
        }

        try {
            $result = Admin::update($id, $data);
            if ($result) {
                if ($oldProfilePath) {
                    deleteImage(self::$uploadDirectory . $oldProfilePath);
                }
                header('Location: AdminList.php');
            } else {
                $error = "Error updating admin";
                include __DIR__ . '/../view/Error.php';
            }
        } catch (Exception $e) {
            if ($profilePath) {
                deleteImage(self::$uploadDirectory . $profilePath);
            }
            $error = "Error updating admin: " . $e->getMessage();
            include __DIR__ . '/../view/Error.php';
        }
    }

    public static function deleteAdmin($id)
    {
        if (!$id) {
            $error = "Invalid admin id";
            include __DIR__ . '/../view/Error.php';
            return;
        }

        try {
            $result = Admin::delete($id);
            if ($result) {
                header('Location: AdminList.php');
            } else {
                $error = "Error deleting admin";
                include __DIR__ . '/../view/Error.php';
            }
        } catch (Exception $e) {
            $error = "Error deleting admin: " . $e->getMessage();
            include __DIR__ . '/../view/Error.php';
        }
    }
}
