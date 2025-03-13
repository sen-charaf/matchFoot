<?php 
require_once __DIR__ . '/../helper/UploadFileHelper.php';
require_once __DIR__ . '/../model/Tournament.php';
require_once __DIR__ . '/Controller.php';

class TournamentController extends Controller
{
    private static $uploadDirectory = __DIR__ . '/../../public/uploads/tournament_logo/';
    private static $uploadSubDirectory = 'tournament_logo';

    public static function index(): array
    {
        try{
            $tournaments = Tournament::getAll();
            $modifiedTournament = [];
            if($tournaments){
                foreach($tournaments as $tournament){
                    $tournament['logo']='http://efoot/logo?file=' . $club[Tournament::$logo_path] . '&dir=' . self::$uploadSubDirectory;
                    $modifiedTournament[] = $tournament;
                }
                return $modifiedTournament;
            }
            return [];
        }catch(PDOException $e){
            $error = "Error fetching clubs: " . $e->getMessage();
            include __DIR__ . '/../view/Error.php';
            return [];
        }
    }
}