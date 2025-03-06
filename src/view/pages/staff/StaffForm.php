<?php

$staffId = $staffFirstName = $staffLastName = $staffRole = $staffBirthDay = '';
$is_update = false;

if (isset($_GET['id'])) {
    $staffId = $_GET['id'];
    $staff = StaffController::getStaffById($staffId);
    $staffFirstName = $staff['prenom'];
    $staffLastName = $staff['nom'];
    $staffRole = $staff['role'];
    $staffBirthDay = $staff['date_naissance'];

    $is_update = true;
}
?>

<dialog
    id="clubModal"
    class="p-6 w-[32rem] bg-white shadow-lg rounded-md mx-auto my-auto">
    <form action="StaffList.php" method="post" id="staffForm" enctype="multipart/form-data" class="space-y-4">
        <input type="text" name="id" value="<?php echo $staffId; ?>" hidden />
        <div>
            <label class="block text-sm font-medium" for="first_name">First Name</label>
            <input
                type="text"
                id="first_name"
                name="first_name"
                value="<?php echo $staffFirstName; ?>"
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                required />
        </div>
        <div>
            <label class="block text-sm font-medium" for="last_name">Last Name</label>
            <input
                type="text"
                id="last_name"
                name="last_name"
                value="<?php echo $staffLastName; ?>"
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                required />
        </div>
        <div>
            <label for="birth_date" class="block text-sm font-medium">Date Naissance</label>
            <input
                type="date"
                dateformat="yyyy-mm-dd"
                name="birth_date"
                id="birth_date"
                value="<?php echo $staffBirthDay; ?>"
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                required>
        </div>
        <div>
            <label class="block text-sm font-medium" for="role">Role</label>
            <input
                type="text"
                id="role"
                name="role"
                value="<?php echo $staffRole; ?>"
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                required />
        </div>
        <div class="flex justify-between">
            <button
                type="submit"
                name="submit"
                class="bg-[#5de967] text-white px-5 py-1 rounded-md hover:bg-[#73ff7d]">
                <?php echo $is_update ? 'Update' : 'Create'; ?>
            </button>
            <a href="StaffList.php"

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