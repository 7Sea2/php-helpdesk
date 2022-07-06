<?php
session_start();
?>


<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Confirm Logout</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/fbea3c1d87.js" crossorigin="anonymous"></script>
</head>

<div class=logoutPage>
    <div class=confirmBoxLogout>
        <div class=textBox>
            Are you sure you want to log out?
        </div>
    </div>
    <div class="buttonContainer">
        <?php

        if (isset($_POST['YES'])) {
            unset($_SESSION);
            session_destroy();
            session_write_close();
            header("location: indexLoggedout.php");
        }
        if (isset($_POST['NO'])) {
            header("location: index.php");
        }
        ?>

        <form method="post">
            <input type="submit" name="YES" value="YES" />

            <input type="submit" name="NO" value="NO" />
        </form>
    </div>
</div>
</body>

</html>