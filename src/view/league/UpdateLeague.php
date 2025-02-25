<?php
session_start();

require __DIR__ . "/../../controller/LeagueController.php";
use controllers\LeagueController;

$league = new LeagueController();

// Initialize $league_data with default values
$league_data = [
    'name' => '',
    'clubsCount' => '',
    'leagueLogoPath' => '',
    'roundCount' => '',
];

// Fetch league data if ID is provided
if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $fetched_data = $league->getById();
    if ($fetched_data) {
        $league_data = array_merge($league_data, $fetched_data); // Merge with default values
    } else {
        echo "<h1>League not found.</h1>";
    }
}else if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($league->validateLeagueData()) {
        if ($league->update()) {
            header("Location: Leagues.php");
            exit();
        } else {
            echo "<h1>Error updating league.</h1>";
        }
    } else {
        echo "<h1>Invalid league data.</h1>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un tournoi</title>
    <link rel="stylesheet" href="./../styles/output.css">
    <link rel="stylesheet" href="./../../../assets/icons//all.min.css">
</head>
<body class="bg-gray-100 p-5">
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-5 text-center">Ajouter un Tournoi</h1>
        <form method="POST" action="">
            <div class="mb-4">
                <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($league_data['nom']); ?>"
                    id="nom" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="nbr_equipes" class="block text-sm font-medium text-gray-700">Nombre d'équipes</label>
                <input type="number" name="clubsCount" value="<?php echo htmlspecialchars($league_data['nbr_equipes']); ?>"
                    id="nbr_equipes" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="logo_path" class="block text-sm font-medium text-gray-700">Logo (Chemin d'accès)</label>
                <input type="text" name="leagueLogoPath" value="<?php echo htmlspecialchars($league_data['logo_path']); ?>"
                 id="logo_path" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
            </div>
            <div class="mb-4">
                <label for="nbr_round" class="block text-sm font-medium text-gray-700">Nombre de Rounds</label>
                <input type="number" name="roundCount" value="<?php echo htmlspecialchars($league_data['nbr_round']); ?>"
                 id="nbr_round" value="1" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
            </div>
            <div class="flex justify-end">
                <button type="submit"class="" >Modifier  tournoi</button>
            </div>
        </form>
    </div>
</body>
</html>
