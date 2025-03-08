<?php
require_once __DIR__ . '/../model/StaffRole.php';
require_once __DIR__ . '/Controller.php';

class StaffRoleController extends Controller
{

    public static function index(): array
    {
        $staffRoles = StaffRole::getAll();
        return $staffRoles;
    }

    public static function getStaffRoleById($id): array
    {
        $staffRole = StaffRole::getById($id);
        if (!$staffRole) {
            $error = "Staff Role not found";
            include __DIR__ . '/../view/Error.php';
            return [];
        }
        return $staffRole;
    }

}