<?php
require_once __DIR__ . '/../model/Staff.php';
require_once __DIR__ . '/StaffRoleController.php';
require_once __DIR__ . '/Controller.php';

class StaffController extends Controller
{

    public static function index(): array
    {
        try {
            $staffs = Staff::getAll();
            $modifiedStaffs = [];
            if ($staffs) {
                foreach ($staffs as $staff) {
                    $role = StaffRole::getById($staff[Staff::$role_id]);
                    $staff['role'] = $role;
                    $modifiedStaffs[] = $staff;
                }
                return $modifiedStaffs;
            } else {
                return [];
            }
        } catch (Exception $e) {
            $error = "Error fetching staffs: " . $e->getMessage();
            include __DIR__ . '/../view/Error.php';
            return [];
        }
    }

    public static function getStaffById($id): array
    {

        try {
            $staff = StaffRoleController::index($id);
            if (!$staff) {
                $error = "Staff not found";
                include __DIR__ . '/../view/Error.php';
                return [];
            }
            $role = StaffRoleController::getStaffRoleById($staff[Staff::$role_id]);
            $staff['role'] = $role;
            return $staff;
        } catch (Exception $e) {
            $error = "Error fetching staff: " . $e->getMessage();
            include __DIR__ . '/../view/Error.php';
            return [];
        }
    }

    public static function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstName = isset($_POST['first_name']) ? trim($_POST['first_name']) : null;
            $lastName = isset($_POST['last_name']) ? trim($_POST['last_name']) : null;
            $role_id = isset($_POST['role']) ? trim($_POST['role']) : null;
            $birthDate = isset($_POST['birth_date']) ? trim($_POST['birth_date']) : null;

            $data = [
                Staff::$firstName => $firstName,
                Staff::$lastName => $lastName,
                Staff::$role_id => $role_id,
                Staff::$birthDate => $birthDate
            ];

            $rules = [
                Staff::$firstName => 'required|min:2|max:30',
                Staff::$lastName => 'required|min:2|max:30',
                Staff::$role_id => 'required|numeric',
                Staff::$birthDate => 'required|date_format:Y-m-d'
            ];

            $validator_result = self::validate($data, $rules);

            if ($validator_result !== true) {
                $error = $validator_result;
                include __DIR__ . '/../view/Error.php';
                return;
            }

            try {
                Staff::create($data);
                header('Location:StaffList.php');
            } catch (Exception $e) {
                $error = "Error storing staff: " . $e->getMessage();
                include __DIR__ . '/../view/Error.php';
            }
        }
    }

    public static  function update(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = isset($_POST['id']) ? trim($_POST['id']) : null;
            $firstName = isset($_POST['first_name']) ? trim($_POST['first_name']) : null;
            $lastName = isset($_POST['last_name']) ? trim($_POST['last_name']) : null;
            $role_id = isset($_POST['role']) ? trim($_POST['role']) : null;
            $birthDate = isset($_POST['birth_date']) ? trim($_POST['birth_date']) : null;

            $data = [
                Staff::$firstName => $firstName,
                Staff::$lastName => $lastName,
                Staff::$role_id => $role_id,
                Staff::$birthDate => $birthDate
            ];

            $rules = [
                Staff::$firstName => 'required|min:2|max:30',
                Staff::$lastName => 'required|min:2|max:30',
                Staff::$role_id => 'required|numeric',
                Staff::$birthDate => 'required|date_format:Y-m-d'
            ];


            $validator_result = self::validate($data, $rules);

            if ($validator_result !== true) {
                $error = "Invalid data";
                include __DIR__ . '/../view/Error.php';
                return;
            }

            try {
                Staff::update($id, $data);
                header('Location:StaffList.php');
            } catch (Exception $e) {
                $error = "Error updating staff: " . $e->getMessage();
                include __DIR__ . '/../view/Error.php';
            }
        }
    }

    public static function deleteStaff($id): void
    {
        if (!$id) {
            $error = "Invalid staff id";
            include __DIR__ . '/../view/Error.php';
            return;
        }

        try {
            Staff::delete($id);
            header('Location:StaffList.php');
        } catch (Exception $e) {
            $error = "Error deleting staff: " . $e->getMessage();
            include __DIR__ . '/../view/Error.php';
        }
    }
}
