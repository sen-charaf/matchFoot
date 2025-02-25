<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staffs</title>
    <link rel="stylesheet" href="./staff.scss">
</head>

<body>
    <main>
        <?php include __DIR__ . "/../../components/SideBar.php"; ?>

        <div class="content">
            <div class="navbar">
                <input type="search" placeholder="Search" class="search-bar">
            </div>

            <div class="content-header">
                <h1 class="content-title">Staffs</h1>
                <a class="add-button btn-primary" href="StaffForm.php">Add Staff</a>
            </div>
            <div class="content-body">
                <p class="feedback-message">
                    <?php
                    session_start();
                    if (isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    }
                    ?>
                </p>
                <table>
                    <thead>
                        <tr>
                            <th>Staff ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Birthdate</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require __DIR__ . "/../../../controller/StaffController.php";

                        // use StaffController;
                        
                        foreach (StaffController::getAll() as $staff): ?>
                            <tr class="hover:bg-gray-100  transition duration-300 ease-in-out">
                                <td class="pt-5  text-center"><?php echo $staff['id']; ?></td>
                                <td class="pt-5  text-center"><?php echo $staff['firstName']; ?></td>
                                <td class="pt-5  text-center"><?php echo $staff['lastName']; ?></td>
                                <td class="pt-5  text-center"><?php echo $staff['birthDate']; ?></td>
                                <td class="pt-5  text-center"><?php echo $staff['role']; ?></td>
                                <td class="pt-5  text-center"><button class="text-red-600 hover:text-red-800"><a
                                            href="DeleteStaff.php?id=<?php echo $staff['id'] ?>">Supprimer</a></button>
                                    <button class="text-blue-600 hover:text-blue-800">Modifier</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
    </main>
</body>

</html>