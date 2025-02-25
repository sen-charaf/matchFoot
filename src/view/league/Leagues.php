<?php
include __DIR__ . "/../../controller/LeagueController.php";
$leagues = LeagueController::getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./../styles/output.css">
    <link rel="stylesheet" href="./../styles/output.css">
    <link rel="stylesheet" href="./../../../assets/icons/fontawesome/css/all.min.css">
    <title>Leagues Management</title>
</head>
<body>

    <div class="container flex-column ml-7">
        <div class="p-5 bg-white rounded-lg">
            <h1 class="pl-3 mb-5 text-2xl font-bold text-gray-800 border-l-3 border-l-[var(--main-bg-color)]">LEAGUES MANAGEMENT</h1>
        </div>

        <div class="add-league flex justify-between items-center mb-5">
            <h1 class="text-xl font-semibold text-gray-700 border-l-3 border-l-[var(--main-bg-color)] pl-1">List of Leagues</h1>
            <button class="bg-[var(--main-bg-color)] text-white px-4 py-2 rounded-lg hover:bg-[var(--secondary-color)] hover:text-[var(--main-bg-color)] transition duration-300">
                <a href="addLeague.php">Add League</a>
            </button>
        </div>

        <table class="min-w-full border-separate rounded-lg overflow-hidden">
            <thead style="color:#ACACAC;">
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Nom</th>
                    <th class="px-4 py-2">Nombre d'équipes</th>
                    <th class="px-4 py-2">Logo</th>
                    <th class="px-4 py-2">Nombre des round </th>
                    <!-- <th class="px-4 py-2">Actions</th> -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($leagues as $league): ?>
                <tr class="hover:bg-gray-100 transition duration-300 ease-in-out">
                    <td class="pt-5 text-center"><?= $league['id'] ?></td>
                    <td class="pt-5 text-center"><?= $league['nom'] ?></td>
                    <td class="pt-5 text-center"><?= $league['nbr_equipes'] ?></td>
                    <td class="pt-5 text-center">
                        <img src="<?= $league['logo_path'] ?>" alt="League Logo" class="w-12 h-12 object-cover rounded-md mx-auto">
                    </td>
                    <td class="pt-5 text-center"><?= $league['nbr_round'] ?></td>
                    
                    <td class="pt-5 text-center">
                        <div class="flex justify-between border border-[var(--main-bg-color)] rounded-[7px] px-1">
                            <button class="text-[var(--main-bg-color)] hover:text-[var(--secondary-color)]">
                                <a href="deleteLeague.php?id=<?= $league['id'] ?>"><i class="fa-solid fa-trash"></i></a>
                            </button>
                            <button class="text-[var(--main-bg-color)] hover:text-[var(--secondary-color)]">
                                <a href="editLeague.php?id=<?= $league['id'] ?>"><i class="fa-solid fa-pen"></i></a>
                            </button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
