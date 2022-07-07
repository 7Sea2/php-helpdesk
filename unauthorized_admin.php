<?php
    Include 'config.php';
    Include 'scripts/verify_user.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/fbea3c1d87.js" crossorigin="anonymous"></script>
</head>
<body>

    <div class="wrapper">
        <div class="sidebar">
            <h2><?php if ($_SESSION['loggedin']) {echo $current_user['naam'];} else {echo "[user-name]"; } ?></h2>
            <ul>
                <li><a href="#"><i class="fas fa-home"></i>Thuispagina</a></li>
                <li><a href="#"><i class="fas fa-layer-group"></i>Zie Meldingen</a></li>
                <li><a href="#"><i class="fas fa-plus"></i>Maak Melding</a></li>
            </ul>

        </div>
        <div class="main_content">
            <div class="header">Welcome!</div>
            <div class="info">
                <div>
                    unauthorized user
                </div>
            </div>
        </div>
    </div>

</body>
</html>