<?php
include 'config.php';
include 'scripts/verify_user.php';
?>



<h2>Morb-OS</h2>
<h4> User: <?php
            echo $current_user['naam'];
            ?></h4>
<ul>
    <li><a href="index.php"><i class="fas fa-home"></i>Thuispagina</a></li>
    <li><a href="melding_visualize.php"><i class="fas fa-layer-group"></i>Zie Meldingen</a></li>
    <li><a href="melding_create.php"><i class="fas fa-plus"></i>Maak Melding</a></li>
</ul>
<li><a href="logoutConfirm.php" class="logout"><i class="fas fa-minus"></i>Log Out</a></li>