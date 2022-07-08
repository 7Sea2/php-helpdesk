<?php
session_start();
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
            <img src="img/morbius.png" class=amogus></img>
            <h2>Morb-OS</h2>
            <ul>
                <li><a href="indexLoggedout.php"><i class="fas fa-home"></i>Thuispagina</a></li>
                <li><a href="about.php"><i class="fas fa-pager"></i>About Us</a></li>
                <?php
                if (isset($current_user)) {
                    if ($current_user['rollID'] == 1) echo '<li><a href="admin.php"><i class="fas fa-address-book"></i>Administratie</a></li>';
                }
                ?>
            </ul>
            <li><a href="inlog.php" class="logout"><i class="fas fa-plus"></i>Log In</a></li>
        </div>
        <div class="main_content">
            <div class="header">Welcome!</div>
            <div class="info">
                <div>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eveniet fugit, animi repudiandae placeat, molestiae incidunt praesentium unde earum vitae
                    maiores reprehenderit impedit amet consequatur quaerat quasi m
                    inima numquam ratione sapiente possimus eaque illo eius. Beatae laboriosam at animi vel. Non
                    , beatae eligendi. Esse veniam consequuntur eveniet soluta dolorem nisi corrupti autem minima nihil sunt optio
                    sed maiores ea quam suscipit omnis ex temporibus cum, accusantium laudantium cupiditate. Consequatur blanditiis ab non suscipit aliquid dolorem cumque harum
                    , corrupti, repellendus qui unde!</div>
            </div>
        </div>
    </div>

</body>

</html>