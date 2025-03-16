<?php

$tournamentName = '';
$tournamentNbrTeam = '';
$tournamentNbrRound = '';
$tournamentLogoPath = '';
$tournamentId = '';
$is_update = false;


if (isset($_GET['id'])) {
    $tournament = TournamentController::getTournamentById($_GET['id']);

    $tournamentId = $tournament[Tournament::$id];
    $tournamentName = $tournament[Tournament::$name];
    $tournamentNbrRound = $tournament[Tournament::$roundNbr];
    $tournamentNbrTeam = $tournament[Tournament::$teamNbr];
    $tournamentLogoPath = $tournament['logo'];
    $is_update = true;

}

?>


<dialog
    id="tournamentModal"
    class="p-6 w-[32rem] bg-white shadow-lg rounded-md mx-auto my-auto">
    <form action="TournamentList.php" method="post" id="tournamentForm" enctype="multipart/form-data" class="space-y-4">
        <input type="text" name="id" value="<?php echo $tournamentId; ?>" hidden />
        <div>
            <label class="block text-sm font-medium" for="name">Tournament Name</label>
            <input
                type="text"
                id="name"
                name="name"
                value="<?php echo $tournamentName; ?>"
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required />
        </div>
        <div>
            <label class="block text-sm font-medium" for="nbrTeam">Number of Teams</label>
            <input
                type="number"
                id="nbrTeam"
                name="teamNbr"
                value="<?php echo $tournamentNbrTeam; ?>"
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required />
        </div>
        <div>
            <label class="block text-sm font-medium" for="nbrRound">Number of Rounds</label>
            <input
                type="number"
                id="nbrRound"
                name="roundNbr"
                value="<?php echo $tournamentNbrRound; ?>"
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required />
        </div>
        
        <div>
            <label class="block text-sm font-medium" for="logo">Tournament Logo</label>
            <input
                type="file"
                id="logo"
                name="logo"
                
                class="w-full px-3 py-2 border rounded-md"
                accept="image/*" />
        </div>

        <div class="flex justify-between">
            <button
                type="submit"
                name="submit"
                class="bg-[#5de967] text-white px-5 py-1 rounded-md hover:bg-[#73ff7d]">
                <?php echo $is_update ? 'Update' : 'Create'; ?>
            </button>
            <a href="TournamentList.php"
                
                id="closeModal"
                class="bg-red-500 text-white px-5 py-1 rounded ">
                Close
                </a>
        </div>
    </form>
</dialog>



<script>
    const modal = document.getElementById("tournamentModal");
    // document
    //   .getElementById("openModal")
    //   .addEventListener("click", () => modal.showModal());
    // document
    //   .getElementById("closeModal")
    //   .addEventListener("click", () => modal.close());


    const creationField = document.getElementById("creation_date");
    creationField.addEventListener("change", (e) => {
     const digit = e.target.value();
        if (digit.length > 4) {
        e.target.value = digit.slice(0, 4);
        }
    });
    </script>
  <?php
  if (isset($_GET['showModal'])) {
    echo '<script>modal.showModal();</script>';
  }
  ?>