<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arbitres</title>
    <link rel="stylesheet" href="./arbitre.scss">
</head>

<body>
    <main>
        <?php include __DIR__ . "/../../components/SideBar.php"; ?>

        <div class="content">
            <div class="navbar">
                <input type="search" placeholder="Search" class="search-bar">
            </div>

            <div class="content-header">
                <h1 class="content-title">Arbitres</h1>
                <a class="add-button btn-primary" href="ArbitreForm.php">Add Arbitre</a>
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
                            <th>Arbitre ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Birthdate</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require __DIR__ . "/../../../controller/ArbitreController.php";

                        // use ArbitreController;
                        
                        foreach (ArbitreController::getAll() as $arbitre): ?>
                            <tr class="hover:bg-gray-100  transition duration-300 ease-in-out">
                                <td class="pt-5  text-center"><?php echo $arbitre['id']; ?></td>
                                <td class="pt-5  text-center"><?php echo $arbitre['firstName']; ?></td>
                                <td class="pt-5  text-center"><?php echo $arbitre['lastName']; ?></td>
                                <td class="pt-5  text-center"><?php echo $arbitre['birthDate']; ?></td>
                                <td class="pt-5  text-center"><?php echo $arbitre['role']; ?></td>
                                <td class="pt-5  text-center"><button class="text-red-600 hover:text-red-800"><a
                                            href="DeleteArbitre.php?id=<?php echo $arbitre['id'] ?>">Supprimer</a></button>
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