<?php
    require_once __DIR__ . '/../../../controller/PlayerController.php';
    

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            // Update the club (if ID exists)
            PlayerController::update();
        } else {
            echo "store";
            // Create new club (if no ID)
            PlayerController::store();
        }
      }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../styles/output.css">
    <link rel="stylesheet" type="text/css" href="../../styles/menu.scss">
    <title>Gestion de Player</title>
</head>

<body class="size-screen">
    <div class="h-screen bg-gray-200 flex">
        <?php include __DIR__ . '/../../components/Sidebar.php'; ?>
        <div class="flex w-full h-full justify-center items-start mt-10">
            <div class="bg-white w-[98%] h-full py-4 px-10 rounded-lg shadow-md">
                <div class="p-5 bg-white rounded-lg">
                    <h1 class="pl-3 mb-5 text-2xl font-bold text-gray-800">OPERATIONS CRUD</h1>
                </div>
                <div class="flex justify-end mb-5">
                    <a href="PlayerList.php?showModal"
                        id="openModal"
                        class="bg-green-700 text-white px-4 py-2 rounded">
                        + Create Player
                    </a>
                </div>
                <?php include __DIR__ . '/PlayerForm.php'; ?>
                <table class="min-w-full border-separate rounded-lg overflow-hidden">
                    <thead class="text-left" style="color:#ACACAC;">
                        <tr>
                            <th class="px-4 py-2">Id</th>
                            <th class="px-4 py-2">Profile</th>
                            <th class="px-4 py-2">Nom</th>
                            <th class="px-4 py-2">Prenom</th>
                            <th class="px-4 py-2">Date Naissance</th>
                            <th class="px-4 py-2">Taille</th>
                            <th class="px-4 py-2">Poids</th>
                            <th class="px-4 py-2">Pieds</th>
                            <th class="px-4 py-2">Equipe</th>
                            <th class="px-4 py-2">Nationalite</th>
                            <th class="px-4 py-2">Position</th>
                            <th class="px-4 py-2">Supprimer</th>
                            <th class="px-4 py-2">Modifier</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $players = PlayerController::index();
                        if (empty($players)) {
                            echo '<tr>';
                            echo '<td colspan="7">Aucun player trouvé</td>';
                            echo '</tr>';
                        
                        } else {
                            foreach ($players as $player):
                                //var_dump($player);
                        ?>
                                <tr>
                                    <td class="px-4 py-2"><?php echo $player[Player::$id]; ?></td>
                                    <td class="px-4 py-2"> <img class="w-10 h-10" src="<?php echo $player['profile']; ?>" alt="Logo"> </td>
                                    <td class="px-4 py-2"><?php echo $player[Player::$lastName]; ?></td>
                                    <td class="px-4 py-2"><?php echo $player[Player::$firstName]; ?></td>
                                    <td class="px-4 py-2"><?php echo $player[Player::$birthDate]; ?></td>
                                    <td class="px-4 py-2"><?php echo $player[Player::$height]; ?></td>
                                    <td class="px-4 py-2"><?php echo $player[Player::$weight]; ?></td>
                                    <td class="px-4 py-2"><?php echo $player[Player::$foot]; ?></td>
                                    <td class="px-4 py-2"><?php echo $player['club'][Club::$name]; ?></td>
                                    <td class="px-4 py-2"><?php echo $player['country'][Country::$name]; ?></td>
                                    <td class="px-4 py-2"><?php echo $player['position'][Position::$tag]; ?></td>
                                    <td class="px-4 py-2"><a href="DeletePlayer.php?id=<?php echo $player[Player::$id]; ?>" class="text-red-500">Supprimer</a></td>
                                    <td class="px-4 py-2"><a href="PlayerList.php?id=<?php echo $player[Player::$id]; ?>&&showModal" class="text-blue-500" id="modifyModel">Modifier</a></td>
                                </tr>
                        <?php endforeach;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    </body>

</html>