
<?php
    require_once __DIR__ . '/../../../../controller/RefereeController.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            // Update the club (if ID exists)
            RefereeController::update();
        } else {
            // Create new club (if no ID)
            RefereeController::store();
        }
      }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../../styles/output.css">
    <link rel="stylesheet" type="text/css" href="../../../styles/menu.scss">
    <title>Gestion de Referee</title>
</head>

<body class="size-screen">
    <div class="h-screen bg-gray-200 flex">
        <?php include __DIR__ . '/../../../components/Sidebar.php'; ?>
        <div class="flex w-full h-full justify-center items-start mt-10">
            <div class="bg-white w-[98%] h-full py-4 px-10 rounded-lg shadow-md">
                <div class="p-5 bg-white rounded-lg">
                    <h1 class="pl-3 mb-5 text-2xl font-bold text-gray-800">OPERATIONS CRUD</h1>
                </div>
                <div class="flex justify-end mb-5">
                    <a href="RefereeList.php?showModal"
                        id="openModal"
                        class="bg-green-700 text-white px-4 py-2 rounded">
                        + Create Referee
                    </a>
                </div>
                <?php include __DIR__ . '/RefereeForm.php'; ?>
                <table class="min-w-full border-separate rounded-lg overflow-hidden">
                    <thead class="text-left" style="color:#ACACAC;">
                        <tr>
                            <th class="px-4 py-2">Id</th>
                            <th class="px-4 py-2">Nom</th>
                            <th class="px-4 py-2">prenom</th>
                            <th class="px-4 py-2">Date Naissance</th>
                            <th class="px-4 py-2">Country</th>
                            <th class="px-4 py-2">Supprimer</th>
                            <th class="px-4 py-2">Modifier</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $referees = RefereeController::index();
                        if (empty($referees)) {
                            echo '<tr>';
                            echo '<td colspan="7">Aucun referee trouvé</td>';
                            echo '</tr>';
                        
                        } else {
                            foreach ($referees as $referee):
                                //var_dump($referee);
                        ?>
                                <tr>
                                    <td class="px-4 py-2"><?php echo $referee[Referee::$id]; ?></td>
                                    <td class="px-4 py-2"><?php echo $referee[Referee::$lastName]; ?></td>
                                    <td class="px-4 py-2"><?php echo $referee[Referee::$firstName]; ?></td>
                                    <td class="px-4 py-2"><?php echo $referee[Referee::$birthDate]; ?></td>
                                    <td class="px-4 py-2"><?php echo $referee['country'][Country::$name]; ?></td>
                                    <td class="px-4 py-2"><a href="DeleteReferee.php?id=<?php echo $referee[Referee::$id]; ?>" class="text-red-500">Supprimer</a></td>
                                    <td class="px-4 py-2"><a href="RefereeList.php?id=<?php echo $referee[Referee::$id]; ?>&&showModal" class="text-blue-500" id="modifyModel">Modifier</a></td>
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