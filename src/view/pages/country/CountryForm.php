<?php

$countryId = $countryName = $countryFlag = '';
$is_update = false;


if (isset($_GET['id'])) {
    $country = CountryController::getCountryById($_GET['id']);

    $countryId = $country[Country::$id];
    $countryName = $country[Country::$name];
    $countryFlagPath = $country['flag'];
    $is_update = true;

}

?>


<dialog
    id="countryModal"
    class="p-6 w-[32rem] bg-white shadow-lg rounded-md mx-auto my-auto">
    <form action="CountryList.php" method="post" id="countryForm" enctype="multipart/form-data" class="space-y-4">
        <input type="text" name="id" value="<?php echo $countryId; ?>" hidden />
        <div>
            <label class="block text-sm font-medium" for="name">Country Name</label>
            <input
                type="text"
                id="name"
                name="name"
                value="<?php echo $countryName; ?>"
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required />
        </div>
        <div>
            <label class="block text-sm font-medium" for="logo">Country Flag</label>
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
            <a href="CountryList.php"
                
                id="closeModal"
                class="bg-red-500 text-white px-5 py-1 rounded ">
                Close
                </a>
        </div>
    </form>
</dialog>



<script>
    const modal = document.getElementById("countryModal");
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