<?php
session_start();
require __DIR__ . "/../../controller/palyerController.php";

use controllers\PlayerController;

$player = new PlayerController(DbConnection::connect());

// Initialize $player_data with default values
$player_data = [
    'nom' => '',
    'prenom' => '',
    'date_naissance' => '',
    'pied' => '',
    'poid' => '',
    'taille' => '',
    'equip' => '',
    'photoPath' => '',
];

// Fetch player data if ID is provided
if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $fetched_data = $player->getById($_GET['id']);
    if ($fetched_data) {
        $player_data = array_merge($player_data, $fetched_data); // Merge with default values
    } else {
        echo "<h1>Player not found.</h1>";
    }
}else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($player->validatePlayerData($_POST)) {
        if ($player->update()) {
            header("Location: players.php");
            exit();
        } else {
            echo "<h1>Error updating player.</h1>";
        }
    } else {
        echo "<h1>Invalid player data.</h1>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier joueur</title>
    <link rel="stylesheet" href="./../styles/output.css">
</head>
<body class="bg-gray-100 p-5">
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-5 text-center">Modifier un joueur</h1>
        <form method="POST" action="">
            <div class="mb-4 ">
                <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" name="nom" id="nom" value="<?php echo htmlspecialchars($player_data['nom']); ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom</label>
                <input type="text" name="prenom" id="prenom" value="<?php echo htmlspecialchars($player_data['prenom']); ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="date_naissance" class="block text-sm font-medium text-gray-700">Date de Naissance</label>
                <input type="date" name="date_naissance" id="date_naissance" value="<?php echo htmlspecialchars($player_data['date_naissance']); ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="pied" class="block text-sm font-medium text-gray-700">Pied (G/D)</label>
                <input type="text" name="pied" id="pied" value="<?php echo htmlspecialchars($player_data['pied']); ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="poid" class="block text-sm font-medium text-gray-700">Poid (kg)</label>
                <input type="number" step="0.1" name="poid"  id="poid"  value="<?php echo htmlspecialchars($player_data['poid']); ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="taille" class="block text-sm font-medium text-gray-700">Taille (m)</label>
                <input type="number" step="0.01" name="taille" id="taille"  value="<?php echo htmlspecialchars($player_data['taille']); ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="equip" class="block text-sm font-medium text-gray-700">Equip</label>
                <input type="number" name="equip" id="equip"  value="<?php echo htmlspecialchars($player_data['equip']); ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="photoPath" class="block text-sm font-medium text-gray-700">Photo Path</label>
                <input type="text" name="photoPath" id="photoPath" value="<?php echo htmlspecialchars($player_data['photoPath']); ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                <input type="hidden" name="id_joueur" value="<?php echo htmlspecialchars($_GET['id']); ?>" />
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-[var(--main-bg-color)] text-white px-4 py-2 rounded-lg hover:bg-[var(--secondary-color)]  transition duration-200 ease-out">Modifier joueur</button>
            </div>
        </form>
    </div>
</body>
</html>