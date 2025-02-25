<?php
require_once __DIR__ . '/../helper/responseHelper.php';
require_once __DIR__ . '/../helper/UploadFileHelper.php';
require_once __DIR__ . '/../model/Arbitre.php';

class ArbitreController
{

    public static function getAll(): array
    {
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $perPage = isset($_GET['per_page']) ? intval($_GET['per_page']) : 20;

        return Arbitre::getAll($page, $perPage);
    }

    public static function getArbitreById($id)
    {
        $arbitreData = Arbitre::getArbitreDataById($id);
        if ($arbitreData) {
            return $arbitreData;
        } else {
            return null;
        }
    }

    public static function create($arbitre)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // isset($_POST['id']) ? $id = trim(string: $_POST['id']) : $id = null;
            // isset($_POST['firstName']) ? $firstName = trim($_POST['firstName']) : $firstName = null;
            // isset($_POST['lastName']) ? $lastName = trim($_POST['lastName']) : $lastName = null;
            // isset($_POST['birthDate']) ? $birthDate = trim($_POST['birthDate']) : $birthdate = null;
            // isset($_POST['role']) ? $role = trim($_POST['role']) : $role = null;

            // if (empty($firstName) | empty($lastName) | empty($birthdate) | empty($role)) {
            //     return false;
            // }

            try {
                return Arbitre::create($arbitre['id'], $arbitre['firstName'], $arbitre['lastName'], $arbitre['birthDate'], $arbitre['role']) ?? false;
            } catch (Exception $e) {
                return false;
            }
        }
    }

    public static function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {

            isset($_POST['id']) ? $id = trim(string: $_POST['id']) : $id = null;
            isset($_POST['firstName']) ? $firstName = trim($_POST['firstName']) : $firstName = null;
            isset($_POST['lastName']) ? $lastName = trim($_POST['lastName']) : $lastName = null;
            isset($_POST['birthdate']) ? $birthdate = trim($_POST['birthDate']) : $birthdate = null;
            isset($_POST['role']) ? $role = trim($_POST['role']) : $role = null;

            if (empty($firstName) | empty($lastName) | empty($birthdate) | empty($role)) {
                return false;
            }

            try {
                return Arbitre::update($id, $firstName, $lastName, $birthdate, $role) ?? false;
            } catch (Exception $e) {
                return false;
            }
        } else {
            return false;
        }
    }


    public static function deleteArbitre($id)
    {
        if (!$id) {
            return false;
        }

        try {
            $result = Arbitre::delete($id);
            if ($result)
                return $result;
            else
                return false;
        } catch (Exception $e) {
            return false;
        }

    }

    public static function validateData($data)
    {
        if (!(isset($data['firstName']) && isset($data['lastName']) && isset($data['birthDate']) && isset($data['role']))) {
            return 'missed_data';
        }

        if (empty($data['firstName']) || empty($data['lastName']) || empty($data['birthDate']) || empty($data['role'])) {
            return 'empty_data';
        }

        return 'success';
    }

}
