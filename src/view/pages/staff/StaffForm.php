<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff form</title>
    <link rel="stylesheet" href="staff-form.scss">
</head>

<body>

    <main>

        <?php include __DIR__ . "/../../components/SideBar.php"; ?>
        <section class="content">
            <form action="AddStaff.php" method="POST">
                <h1>Staff form</h1>
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
                <input type="hidden" name="id" value="<?php echo $staff['id'] ?? '' ?>">
                <label for="firstName">First Name</label>
                <input type="text" name="firstName" id="firstName" value="<?php echo $staff['firstName'] ?? '' ?>">
                <label for="lastName">Last Name</label>
                <input type="text" name="lastName" id="lastName" value="<?php echo $staff['lastName'] ?? '' ?>">
                <label for="birthdate">Birthdate</label>
                <input type="date" name="birthDate" id="birthdate" value="<?php echo $staff['birthdate'] ?? '' ?>">
                <label for="role">Role</label>
                <input type="text" name="role" id="role" value="<?php echo $staff['role'] ?? '' ?>">
                <div class="horizontal-container">
                    <a href="Staffs.php">Cancel</a>
                    <button type="submit">Submit</button>
                </div>
            </form>
        </section>
    </main>
</body>

</html>