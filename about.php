<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/fbea3c1d87.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="wrapper">
        <div class="sidebar">
            <ul>
                <li><a href="indexLoggedout.php"><i class="fas fa-home"></i>Thuispagina</a></li>
                <li><a href="about.php"><i class="fas fa-pager"></i>About Us</a></li>
            </ul>
            <li><a href="inlog.php" class="logout"><i class="fas fa-plus"></i>Log In</a></li>
        </div>
        <div class="main_content">
            <div class="header">About us.</div>
            <div class="info">
                <div>Welcome, we are the team of morbers and we have an affinity for php coding
                    . We are the best coders in the whole wide world and nobody is better than us.
                    Of course you all do not know that yet since you are not as amazing and
                    beautiful as the morbers.
                    eat morb.
                </div>
            </div>
        </div>
    </div>

</body>

</html>