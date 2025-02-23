<?php

    require __DIR__ . "/../controller/palyerController.php";


    use controllers\PlayerController;

    $player = new PlayerController(DbConnection::connect());

    if($player->create())
    {
        echo "<h1>joueur est ajouter<h1>";
    }
    else
    {
        echo "<h1>joueur n'est pas ajouter<h1>";

    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter joueur</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-5">
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-5 text-center">Ajouter un joueur</h1>
        <form method="POST" action="">
            <div class="mb-4">
                <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" name="nom" id="nom" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom</label>
                <input type="text" name="prenom" id="prenom" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="date_naissance" class="block text-sm font-medium text-gray-700">Date de Naissance</label>
                <input type="date" name="date_naissance" id="date_naissance" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="pied" class="block text-sm font-medium text-gray-700">Pied (G/D)</label>
                <input type="text" name="pied" id="pied" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="poid" class="block text-sm font-medium text-gray-700">Poid (kg)</label>
                <input type="number" step="0.1" name="poid" id="poid" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="taille" class="block text-sm font-medium text-gray-700">Taille (m)</label>
                <input type="number" step="0.01" name="taille" id="taille" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="equip" class="block text-sm font-medium text-gray-700">Equip</label>
                <input type="number" name="equip" id="equip" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="photoPath" class="block text-sm font-medium text-gray-700">Photo Path</label>
                <input type="text" name="photoPath" id="photoPath" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-300">Add Player</button>
            </div>
        </form>
    </div>
</body>
</html>