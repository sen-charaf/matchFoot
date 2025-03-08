<?php
require_once __DIR__ . '/../../../controller/StadiumController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        
        // Update the stadium (if ID exists)
        StadiumController::update();
    } else {
        // Create new stadium (if no ID)
        StadiumController::store();
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
    <title>Gestion de Stade</title>
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
                    <a href="StadeList.php?showModal"
                        id="openModal"
                        class="bg-green-700 text-white px-4 py-2 rounded">
                        + Create Stadium
                    </a>
                </div>
                <?php include __DIR__ . '/StadeForm.php'; ?>
                <table class="min-w-full border-separate rounded-lg overflow-hidden">
                    <thead class="text-left" style="color:#ACACAC;">
                        <tr>
                            <th class="px-4 py-2">Id</th>
                            <th class="px-4 py-2">Nom</th>
                            <th class="px-4 py-2">Ville</th>
                            <th class="px-4 py-2">Capacité</th>
                            <th class="px-4 py-2">Supprimer</th>
                            <th class="px-4 py-2">Modifier</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stadiums = StadiumController::index();
                        if (empty($stadiums)) {
                            echo '<tr>';
                            echo '<td colspan="7">Aucun stade trouvé</td>';
                            echo '</tr>';
                        } else {
                            foreach ($stadiums as $stadium):
                                //var_dump($stadium);
                        ?>
                                <tr>
                                    <td class="px-4 py-2"><?php echo $stadium[Stadium::$id]; ?></td>
                                    <td class="px-4 py-2"><?php echo $stadium[Stadium::$name]; ?></td>
                                    <td class="px-4 py-2"><?php echo $stadium['city'][Stadium::$name]; ?></td>
                                    <td class="px-4 py-2"><?php echo $stadium['capacity']; ?></td>
                                    <td class="px-4 py-2"><a href="DeleteStade.php?id=<?php echo $stadium[Stadium::$id]; ?>" class="text-red-500">Supprimer</a></td>
                                    <td class="px-4 py-2"><a href="StadeList.php?id=<?php echo $stadium[Stadium::$id]; ?>&&showModal" class="text-blue-500" id="modifyModel">Modifier</a></td>
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