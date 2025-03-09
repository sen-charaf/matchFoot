<?php
require_once __DIR__ . '/../model/Position.php';
require_once __DIR__ . '/Controller.php';

class PositionController extends Controller
{

    public static function index(): array
    {
        try {
            $positions = Position::getAll();
            return $positions;
        } catch (Exception $e) {
            $error = "Error fetching positions: " . $e->getMessage();
            include __DIR__ . '/../view/Error.php';
            return [];
        }
    }

    public static function getPositionById($id): array
    {
        try {
            $position = Position::getById($id);
            if (!$position) {
                $error = "Position not found";
                include __DIR__ . '/../view/Error.php';
                return [];
            }
            return $position;
        } catch (Exception $e) {
            $error = "Error fetching position: " . $e->getMessage();
            include __DIR__ . '/../view/Error.php';
            return [];
        }
    }
}
