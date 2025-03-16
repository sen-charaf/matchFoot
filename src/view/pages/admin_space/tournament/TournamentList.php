<?php

require_once __DIR__ . '/../../../../controller/TournamentController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['id']) && !empty($_POST['id'])) {
      // Update the tournament (if ID exists)
      TournamentController::update();
  } else {
      // Create new tournament (if no ID)
      TournamentController::store();
  }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CreateTournament</title>
  <link rel="stylesheet" type="text/css" href="../../../styles/output.css">
  <link rel="stylesheet" type="text/css" href="../../../styles/menu.scss">
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
    <?php include __DIR__ . '/../../../components/Sidebar.php'; ?>
    <div class="flex w-full h-full  justify-center items-start mt-10">
      <div class="bg-white w-[98%] h-full py-4 px-10 rounded-lg shadow-md">
        <div class="p-5 bg-white rounded-lg">
          <h1 class="pl-3 mb-5 text-2xl font-bold text-gray-800">OPERATIONS CRUD</h1>
        </div>
        <div class="flex justify-end mb-5">
          <a href="TournamentList.php?showModal"
           
            
            class="bg-green-700 text-white px-4 py-2 rounded">
            + Create Tournament
  </a>
        </div>

        <?php include __DIR__ . '/TournamentForm.php'; ?>
        
        <table class="min-w-full border-separate   rounded-lg overflow-hidden">
          <thead class="  text-left" style="color:#ACACAC;">
            <tr>
              <th class="px-4 py-2">Id</th>
              <th class="px-4 py-2">Logo</th>
              <th class="px-4 py-2">Nom</th>
              <th class="px-4 py-2">Nombre d'equipes</th>
              <th class="px-4 py-2">Nombre de round</th>
              <th class="px-4 py-2">Supprimer</th>
              <th class="px-4 py-2">Modifier</th>
            </tr>
          </thead>
          <tbody class="">
            <?php
            $tournaments = TournamentController::index();
            if (empty($tournaments)) {
              echo '<tr>';
              echo '<td colspan="9">Aucun tournament trouvé</td>';
              echo '</tr>';
            } else {
              foreach ($tournaments as $tournament): 
              ?>
              <tr>
                <td class="px-4 py-2"><?php echo $tournament[Tournament::$id]; ?></td>
                <td class="px-4 py-2"> <img class="w-10 h-10" src="<?php echo $tournament['logo']; ?>" alt="Logo"> </td>
                <td class="px-4 py-2"><?php echo $tournament[Tournament::$name]; ?></td>
                <td class="px-4 py-2"><?php echo $tournament[Tournament::$teamNbr]; ?></td>
                <td class="px-4 py-2"><?php echo $tournament[Tournament::$roundNbr]; ?></td>
                <td class="px-4 py-2"><a href="DeleteTournament.php?id=<?php echo $tournament[Tournament::$id]; ?>" class="text-red-500">Supprimer</a></td>
                <td class="px-4 py-2"><a href="TournamentList.php?id=<?php echo $tournament[Tournament::$id]; ?>&&showModal" class="text-blue-500" id="modifyModel">Modifier</a></td>
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