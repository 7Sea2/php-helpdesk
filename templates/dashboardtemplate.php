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
</head>

<body>

    <div class="wrapper">
        <div class="sidebar">
            <h2>[user-name]</h2>
            <ul>
                <li><a href="dashboard.html"><i class="fas fa-home"></i>Thuispagina</a></li>
                <li><a href="../melding_visualize.php"><i class="fas fa-layer-group"></i>Zie Meldingen</a></li>
                <li><a href="../melding_create.php"><i class="fas fa-plus"></i>Maak Melding</a></li>
            </ul>
            <li><a href="#" class="logout"><i class="fas fa-minus"></i>Log Out</a></li>
        </div>
        <div class="main_content">
            <div class="header">Welcome!</div>
            <div class="info">
<<<<<<< Updated upstream:helpdesk-dashboard/dashboard.html
                <div>
                    
                </div>
=======
                <?php
                if ($_SESSION['loggedin']) {
                    echo "logged in succesfully";
                } else {
                    echo "not logged in";
                }
                ?>
                <!--<div>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eveniet fugit, animi repudiandae placeat, molestiae incidunt praesentium unde earum vitae 
                     maiores reprehenderit impedit amet consequatur quaerat quasi m
                     inima numquam ratione sapiente possimus eaque illo eius. Beatae laboriosam at animi vel. Non
                     , beatae eligendi. Esse veniam consequuntur eveniet soluta dolorem nisi corrupti autem minima nihil sunt optio 
                     sed maiores ea quam suscipit omnis ex temporibus cum, accusantium laudantium cupiditate. Consequatur blanditiis ab non suscipit aliquid dolorem cumque harum
                     , corrupti, repellendus qui unde!</div>
>>>>>>> Stashed changes:templates/dashboardtemplate.php
            </div>
        </div>-->
            </div>

</body>

</html>