<?php
require_once __DIR__ . '/../../../../controller/TournamentController.php';
$adminTournamentId = '';
$adminTournamentFirstName = '';
$adminTournamentLastName = '';
$adminTournamentBirthDay = '';
$adminTournamentEmail = '';
$adminTournamentPhoneNumber = '';
$adminTournamentPassword = '';
$tournamentsAdmin = [];
$is_update = false;


$tournaments = TournamentController::index();

if (isset($_GET['id'])) {
    $adminTournamentId = $_GET['id'];
    $adminTournament = AdminTournamentController::getAdminTournamentById($adminTournamentId);
    $adminTournamentFirstName = $adminTournament[Admin::$firstName];
    $adminTournamentLastName = $adminTournament[Admin::$lastName];
    $adminTournamentBirthDay = $adminTournament[Admin::$birthDate];
    $adminTournamentEmail = $adminTournament[Admin::$email];
    $adminTournamentPassword = $adminTournament[Admin::$password];
    $adminTournamentPhoneNumber = $adminTournament[Admin::$phoneNumber];
    $tournamentsAdmin = $adminTournament['tournaments'];
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
        <div>
            <label class="block text-sm font-medium" for="role">Tournaments</label>
            <div>
            <select name="tournaments" id="tournament">
                <?php
                foreach ($tournaments as $tournament): ?>
                    <option value="<?php echo $tournament[Tournament::$id]; ?>"><?php echo $tournament[Tournament::$name]; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="button" class="bg-[#5de967] text-white px-5 py-1 rounded-md hover:bg-[#73ff7d]" id="addTournament">Ajouter</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody id="tournaments_table">
                    <?php
                    foreach ($tournamentsAdmin as $tourntournamentAdmin): ?>
                        <tr>
                            <input type="hidden" name="tournaments[]" value="<?php echo $tournamentsAdmin[Tournament::$id] ?>">
                            <td> <?php echo $tournamentsAdmin[Tournament::$id] ?></td>;
                            <td> <?php echo $tournamentsAdmin[Tournament::$name] ?> </td>;
                            <td> <button class="text-red-600 hover:text-red-800"> Supprimer </button>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
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


    // const creationField = document.getElementById("creation_date");
    // creationField.addEventListener("change", (e) => {
    //     const digit = e.target.value();
    //     if (digit.length > 4) {
    //         e.target.value = digit.slice(0, 4);
    //     }
    // });
    
    const addTournament = document.getElementById("addTournament");
    addTournament.addEventListener("submit", () => {
        e.preventDefault();
    })
    addTournament.addEventListener("click", () => {
       
        const select = document.getElementById("tournament");
        const option = select.options[select.selectedIndex];
        const tournamentId = option.value;
        const tournamentName = option.text;
        const table = document.getElementById("tournaments_table");
        const row = document.createElement("tr");
        row.innerHTML = `
            <input type="hidden" name="tournaments[]" value="${tournamentId}">
            <td>${tournamentId}</td>
            <td>${tournamentName}</td>
            <td><button class="text-red-600 hover:text-red-800">Supprimer</button></td>
        `;
        table.appendChild(row);
    });
</script>
<?php
if (isset($_GET['showModal'])) {
    echo '<script>modal.showModal();</script>';
}
?>