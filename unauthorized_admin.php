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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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