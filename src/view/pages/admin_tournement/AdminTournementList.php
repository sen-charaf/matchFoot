<?php

require_once __DIR__ . '/../../../controller/AdminTournementController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['id']) && !empty($_POST['id'])) {
      // Update the adminTournement (if ID exists)
      AdminTournementController::update();
  } else {
      // Create new adminTournement (if no ID)
      AdminTournementController::store();
  }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CreateAdminTournement</title>
  <link rel="stylesheet" type="text/css" href="../../styles/output.css">
  <link rel="stylesheet" type="text/css" href="../../styles/menu.scss">
  <style>
    :root {
      --text-color: #060907;
      --bg-color: #f9fbf9;
      --primary-color: #44bb4e;
      --secondary-color: #94e699;
      --accent-color: #5de967;
      --main-color: #000;
      --secondary-color: #acacac;
      --main-bg-color: #a99567;
    }
  </style>
</head>

<body class="size-screen">
  <div class="h-screen bg-gray-200 flex">
    <!-- <div class="w-72 bg-white flex-col">
      <div class=" flex">
        <div class="text-center w-full text-2xl font-serif">SoftFoorBall</div>
      </div>
    </div> -->
    <?php include __DIR__ . '/../../components/Sidebar.php'; ?>
    <div class="flex w-full h-full  justify-center items-start mt-10">
      <div class="bg-white w-[98%] h-full py-4 px-10 rounded-lg shadow-md">
        <div class="p-5 bg-white rounded-lg">
          <h1 class="pl-3 mb-5 text-2xl font-bold text-gray-800">OPERATIONS CRUD</h1>
        </div>
        <div class="flex justify-end mb-5">
          <a href="AdminTournementList.php?showModal"
           
            
            class="bg-green-700 text-white px-4 py-2 rounded">
            + Create AdminTournement
  </a>
        </div>

        <?php include __DIR__ . '/AdminTournementForm.php'; ?>
        
        <table class="min-w-full border-separate   rounded-lg overflow-hidden">
          <thead class="  text-left" style="color:#ACACAC;">
            <tr>
              <th class="px-4 py-2">Id</th>
              <th class="px-4 py-2">Profile</th>
              <th class="px-4 py-2">Nom</th>
              <th class="px-4 py-2">Prenom</th>
              <th class="px-4 py-2">Email</th>
              <th class="px-4 py-2">Date Naissance</th>
              <th class="px-4 py-2">Phone Number</th>
              <th class="px-4 py-2">Date de Creation</th>
              <th class="px-4 py-2">Supprimer</th>
              <th class="px-4 py-2">Modifier</th>
            </tr>
          </thead>
          <tbody class="">
            <?php
            $adminTournements = AdminTournementController::index();
            if (empty($adminTournements)) {
              echo '<tr>';
              echo '<td colspan="9">Aucun adminTournement trouvé</td>';
              echo '</tr>';
            } else {
              foreach ($adminTournements as $adminTournement): 
              ?>
              <tr>
                <td class="px-4 py-2"><?php echo $adminTournement[Admin::$id]; ?></td>
                <td class="px-4 py-2"> <img class="w-10 h-10" src="<?php echo $adminTournement['profile']; ?>" alt="Logo"> </td>
                <td class="px-4 py-2"><?php echo $adminTournement[Admin::$lastName]; ?></td>
                <td class="px-4 py-2"><?php echo $adminTournement[Admin::$firstName]; ?></td>
                <td class="px-4 py-2"><?php echo $adminTournement[Admin::$email]; ?></td>
                <td class="px-4 py-2"><?php echo $adminTournement[Admin::$birthDate]; ?></td>
                <td class="px-4 py-2"><?php echo $adminTournement[Admin::$phoneNumber]; ?></td>
                <td class="px-4 py-2"><?php echo $adminTournement[Admin::$createdAt]; ?></td>
                <td class="px-4 py-2"><a href="DeleteAdminTournement.php?id=<?php echo $adminTournement[Admin::$id]; ?>" class="text-red-500">Supprimer</a></td>
                <td class="px-4 py-2"><a href="AdminTournementList.php?id=<?php echo $adminTournement[Admin::$id]; ?>&&showModal" class="text-blue-500" id="modifyModel">Modifier</a></td>
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