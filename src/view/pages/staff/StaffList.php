<?php
    require_once __DIR__ . '/../../../controller/StaffController.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            // Update the club (if ID exists)
            StaffController::update();
        } else {
            echo "store";
            // Create new club (if no ID)
            StaffController::store();
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
    <title>Gestion de Staff</title>
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
                    <a href="StaffList.php?showModal"
                        id="openModal"
                        class="bg-green-700 text-white px-4 py-2 rounded">
                        + Create Staff
                    </a>
                </div>
                <?php include __DIR__ . '/StaffForm.php'; ?>
                <table class="min-w-full border-separate rounded-lg overflow-hidden">
                    <thead class="text-left" style="color:#ACACAC;">
                        <tr>
                            <th class="px-4 py-2">Id</th>
                            <th class="px-4 py-2">Nom</th>
                            <th class="px-4 py-2">prenom</th>
                            <th class="px-4 py-2">Date Naissance</th>
                            <th class="px-4 py-2">Role</th>
                            <th class="px-4 py-2">Supprimer</th>
                            <th class="px-4 py-2">Modifier</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $staffs = StaffController::index();
                        if (empty($staffs)) {
                            echo '<tr>';
                            echo '<td colspan="7">Aucun staff trouvé</td>';
                            echo '</tr>';
                        
                        } else {
                            foreach ($staffs as $staff):
                                //var_dump($staff);
                        ?>
                                <tr>
                                    <td class="px-4 py-2"><?php echo $staff[Staff::$id]; ?></td>
                                    <td class="px-4 py-2"><?php echo $staff[Staff::$lastName]; ?></td>
                                    <td class="px-4 py-2"><?php echo $staff[Staff::$firstName]; ?></td>
                                    <td class="px-4 py-2"><?php echo $staff[Staff::$birthDate]; ?></td>
                                    <td class="px-4 py-2"><?php echo $staff['role'][StaffRole::$name]; ?></td>
                                    <td class="px-4 py-2"><a href="DeleteStaff.php?id=<?php echo $staff[Staff::$id]; ?>" class="text-red-500">Supprimer</a></td>
                                    <td class="px-4 py-2"><a href="StaffList.php?id=<?php echo $staff[Staff::$id]; ?>&&showModal" class="text-blue-500" id="modifyModel">Modifier</a></td>
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