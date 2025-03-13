<?php

$adminTournamentId = '';
$adminTournamentFirstName = '';
$adminTournamentLastName = '';
$adminTournamentBirthDay = '';
$adminTournamentEmail = '';
$adminTournamentPhoneNumber = '';
$adminTournamentPassword = '';
$is_update = false;

if (isset($_GET['id'])) {
    $adminTournamentId = $_GET['id'];
    $adminTournament = AdminTournamentController::getAdminTournamentById($adminTournamentId);
    $adminTournamentFirstName = $adminTournament[Admin::$firstName];
    $adminTournamentLastName = $adminTournament[Admin::$lastName];
    $adminTournamentBirthDay = $adminTournament[Admin::$birthDate];
    $adminTournamentEmail = $adminTournament[Admin::$email];
    $adminTournamentPassword = $adminTournament[Admin::$password];
    $adminTournamentPhoneNumber = $adminTournament[Admin::$phoneNumber];

    $is_update = true;
}
?>

<dialog
    id="clubModal"
    class="p-6 w-[32rem] bg-white shadow-lg rounded-md mx-auto my-auto">
    <form action="AdminTournamentList.php" method="post" id="adminTournamentForm" enctype="multipart/form-data" class="space-y-4">
        <input type="text" name="id" value="<?php echo $adminTournamentId; ?>" hidden />
        <div>
            <label class="block text-sm font-medium" for="first_name">First Name</label>
            <input
                type="text"
                id="first_name"
                name="first_name"
                value="<?php echo $adminTournamentFirstName; ?>"
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                required />
        </div>
        <div>
            <label class="block text-sm font-medium" for="last_name">Last Name</label>
            <input
                type="text"
                id="last_name"
                name="last_name"
                value="<?php echo $adminTournamentLastName; ?>"
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
                value="<?php echo $adminTournamentBirthDay; ?>"
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                required>
        </div>
        <div>
            <label class="block text-sm font-medium" for="email">Email</label>
            <input
                type="email"
                name="email"
                id="email"
                value="<?php echo $adminTournamentEmail; ?>"
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                required>
        </div>
        <div>
            <label class="block text-sm font-medium" for="password">Mot de Passe</label>
            <input
                type="password"
                name="password"
                id="password"
                value="<?php echo $adminTournamentPassword; ?>"
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                required>
        </div>
        <div>
            <label class="block text-sm font-medium" for="phone_number">Numéro de téléphone</label>
            <input
                
                name="phone_number"
                id="phone_number"
                value="<?php echo $adminTournamentPhoneNumber; ?>"
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                required>
        </div>
        <div>
            <label class="block text-sm font-medium" for="image">Profile Image</label>
            <input
                type="file"
                id="image"
                name="profile_path"
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" />
        </div>
        <div class="flex justify-between">
            <button
                type="submit"
                name="submit"
                class="bg-[#5de967] text-white px-5 py-1 rounded-md hover:bg-[#73ff7d]">
                <?php echo $is_update ? 'Update' : 'Create'; ?>
            </button>
            <a href="AdminTournamentList.php"

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