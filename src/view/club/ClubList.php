<?php

require_once __DIR__ . '/../../controller/ClubController.php';

if (isset($_POST['submit'])) {
  ClubController::store();
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CreateClub</title>
  <link rel="stylesheet" type="text/css" href="../styles/output.css">
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
    <div class="w-72 bg-white flex-col">
      <div class=" flex">
        <div class="text-center w-full text-2xl font-serif">SoftFoorBall</div>
      </div>
    </div>
    <div class="flex w-full h-full  justify-center items-start mt-10">
      <div class="bg-white w-[98%] h-full py-4 px-10 rounded-lg shadow-md">
        <div class="p-5 bg-white rounded-lg">
          <h1 class="pl-3 mb-5 text-2xl font-bold text-gray-800">OPERATIONS CRUD</h1>
        </div>
        <div class="flex justify-end mb-5">
          <button
           id="openModal"
            
            class="bg-green-700 text-white px-4 py-2 rounded">
            + Create Club
          </button>
        </div>
        <?php include __DIR__ . '/AddClub.php'; ?>
        <table class="min-w-full border-separate   rounded-lg overflow-hidden">
          <thead class="  text-left" style="color:#ACACAC;">
            <tr>
              <th class="px-4 py-2">Id</th>
              <th class="px-4 py-2">Logo</th>
              <th class="px-4 py-2">Nom</th>
              <th class="px-4 py-2">NickName</th>
              <th class="px-4 py-2">Stade</th>
              <th class="px-4 py-2">Entraineur</th>
              <th class="px-4 py-2">Date de Creation</th>
              <th class="px-4 py-2">Supprimer</th>
              <th class="px-4 py-2">Modifier</th>
            </tr>
          </thead>
          <tbody class="">
            <?php
            require_once __DIR__ . '/../../controller/ClubController.php';
            $clubs = ClubController::index();
            if (empty($clubs)) {
              echo '<tr>';
              echo '<td colspan="9">Aucun club trouvé</td>';
              echo '</tr>';
            } else {
              foreach ($clubs as $club): 
              var_dump($club) ?>
              <tr>
                <td class="px-4 py-2"><?php echo $club['id']; ?></td>
                <td class="px-4 py-2"> <img class="w-10 h-10 rounded-full" src="<?php echo $club['logo']; ?>" alt="Logo"> </td>
                <td class="px-4 py-2"><?php echo $club['nom']; ?></td>
                <td class="px-4 py-2"><?php echo $club['nickname']; ?></td>
                <td class="px-4 py-2"><?php echo $club['stadium']['nom']; ?></td>
                <td class="px-4 py-2"><?php echo $club['trainer']; ?></td>
                <td class="px-4 py-2"><?php echo $club['created_at']; ?></td>
                <td class="px-4 py-2"><a href="DeleteClub.php?id=<?php echo $club['id']; ?>" class="text-red-500">Supprimer</a></td>
                <td class="px-4 py-2"><a href="ClubList.php?id=<?php echo $club['id']; ?>" class="text-blue-500" id="modifyModel">Modifier</a></td>
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