<?php

$stadeId= $stadeName = $stadeCityName = $stadeCapacity = '';
$is_update = false;

if (isset($_GET['id'])) {
    $stade = StadiumController::getStadById($_GET['id']);
    $stadeId = $stade['id'];
    $stadeName = $stade['nom'];
    $stadeCityName = $stade['city']['nom'];
    $stadeCapacity = $stade['capacity'];
    $is_update = true;



}
?>

<dialog
    id="clubModal"
    class="p-6 w-[32rem] bg-white shadow-lg rounded-md mx-auto my-auto">
    <form action="StadeList.php" method="post" id="clubForm" enctype="multipart/form-data" class="space-y-4">
        <input type="text" name="id" value="<?php echo $stadeId; ?>" hidden />
        <div>
            <label class="block text-sm font-medium" for="name">Stade Name</label>
            <input
                type="text"
                id="name"
                name="name"
                value="<?php echo $stadeName; ?>"
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                required />
        </div>
        <div>
            <label class="block text-sm font-medium" for="staedname">City Name</label>

            <select name="city_id" id="city_id" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
                <option value="-1" default disabled selected>
                    Select City
                </option>
                <?php
                $cities = CityController::index();
                foreach ($cities as $city):?>
                    <option value="<?php echo $city['id']; ?>" <?php echo $stadeCityName == $city['nom'] ? 'selected' : ''; ?>>
                        <?php echo $city['nom']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium" for="capacity">Capacity</label>
            <input
                type="text"
                id="capacity"
                oninput="this.value = this.value.replace(/\D/g, '')"
                name="capacity"
                value="<?php echo $stadeCapacity; ?>"
                class="w-full px-3 py-2 border rounded-md" />
        </div>
        

        <div class="flex justify-between">
            <button
                type="submit"
                name="submit"
                class="bg-[#5de967] text-white px-5 py-1 rounded-md hover:bg-[#73ff7d]">
                <?php echo $is_update ? 'Update' : 'Create'; ?>
            </button>
            <a href="StadeList.php"
                
                id="closeModal"
                class="bg-red-500 text-white px-5 py-1 rounded ">
                Close
                </a>
        </div>
    </form>
</dialog>



<script>
    const modal = document.getElementById("clubModal");


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