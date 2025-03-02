<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arbitre form</title>
    <link rel="stylesheet" href="arbitre-form.scss">
</head>

<body>

    <main>

        <?php include __DIR__ . "/../../components/SideBar.php"; ?>
        <section class="content">
            <form action="AddArbitre.php" method="POST">
                <h1>Arbitre form</h1>
                <p class="<?php
                session_start();
                if (isset($_SESSION['message'])) {
                    if ($_SESSION['message'] == 'Empty data' || $_SESSION['message'] == 'Missed data') {
                        echo 'feedback-message-error';
                    } else {
                        echo 'feedback-message';
                    }
                }

                ?>">
                    <?php
                    if (isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    }
                    ?>
                </p>
                <input type="hidden" name="id" value="<?php echo $arbitre['id'] ?? '' ?>">
                <label for="firstName">First Name</label>
                <input type="text" name="firstName" id="firstName" value="<?php echo $arbitre['firstName'] ?? '' ?>">
                <label for="lastName">Last Name</label>
                <input type="text" name="lastName" id="lastName" value="<?php echo $arbitre['lastName'] ?? '' ?>">
                <label for="birthdate">Birthdate</label>
                <input type="date" name="birthDate" id="birthdate" value="<?php echo $arbitre['birthdate'] ?? '' ?>">
                <label for="role">Role</label>
                <input type="text" name="role" id="role" value="<?php echo $arbitre['role'] ?? '' ?>">
                <div class="horizontal-container">
                    <a href="Arbitres.php">Cancel</a>
                    <button type="submit">Submit</button>
                </div>
            </form>
        </section>
    </main>
</body>

</html>