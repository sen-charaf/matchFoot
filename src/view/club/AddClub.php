<?php
require_once __DIR__ . '/../../controller/ClubController.php';
$clubName = '';
$clubNickname = '';
$clubStadeName = '';
$clubCreationDate = '';
$clubLogoPath = '';

if (isset($_GET['id'])) {
    $club = ClubController::getClubById($_GET['id']);
    $clubName = $club->name;
    $clubNickname = $club->nickname;
    $clubStadeName = $club->stadium['nom'];
    $clubCreationDate = $club->founded_at;
    $clubLogoPath = $club->logo;



}
?>

<dialog
    id="clubModal"
    class="p-6 w-[32rem] bg-white shadow-lg rounded-md mx-auto my-auto">
    <form action="ClubList.php" method="post" id="clubForm" enctype="multipart/form-data" class="space-y-4">
        <div>
            <label class="block text-sm font-medium" for="name">Club Name</label>
            <input
                type="text"
                id="name"
                name="name"
                value="<?php echo $clubName; ?>"
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required />
        </div>
        <div>
            <label class="block text-sm font-medium" for="nickname">Nickname</label>
            <input
                type="text"
                id="nickname"
                name="nickname"
                value="<?php echo $clubNickname; ?>"
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required />
        </div>
        <div>
            <label class="block text-sm font-medium" for="staedname">Stade Name</label>
            <input
                type="text"
                id="staedname"
                name="stad_name"
                value="<?php echo $clubStadeName; ?>"
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required />
        </div>
        <div>
            <label class="block text-sm font-medium" for="logo">Creation Date</label>
            <input
                type="number"
                id="creation_date"
                name="founded_at"
                value="<?php echo $clubCreationDate; ?>"
                class="w-full px-3 py-2 border rounded-md" />
        </div>

        <div>
            <label class="block text-sm font-medium" for="logo">Club Logo</label>
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
                Create Club
            </button>
            <button
                type="button"
                id="closeModal"
                class="bg-red-500 text-white px-5 py-1 rounded">
                Close
            </button>
        </div>
    </form>
</dialog>



<script>
    const modal = document.getElementById("clubModal");
    document
      .getElementById("openModal")
      .addEventListener("click", () => modal.showModal());
    document
      .getElementById("closeModal")
      .addEventListener("click", () => modal.close());
    document.getElementById("modifyModel").addEventListener("submit", () => {
      modal.showModal();
    })
  </script>

  <?php
  if (isset($_GET['id'])){
    echo '<script>modal.showModal();</script>';
  }
  ?>