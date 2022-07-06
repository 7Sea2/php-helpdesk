<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="table.css">
    <script src="https://kit.fontawesome.com/fbea3c1d87.js" crossorigin="anonymous"></script>
      <?php
      include 'config.php';
      include 'scripts/verify_user.php';
      need_login();
      ?>
</head>
<body>

    <div class="wrapper">
        <div class="sidebar">
            <h2><?php if($_SESSION['loggedin']){echo $current_user['naam'];} else{echo 'je moet inloggen';} ?></h2>
            <ul>
                <li><a href="index.php"><i class="fas fa-home"></i>Thuispagina</a></li>
                <li><a href="melding_visualize.php"><i class="fas fa-layer-group"></i>Zie Meldingen</a></li>
                <li><a href="melding_create.php"><i class="fas fa-plus"></i>Maak Melding</a></li>
            </ul>
            <li><a href="logoutConfirm.php" class="logout"><i class="fas fa-minus"></i>Log Out</a></li>

        </div>
        <div class="main_content">
            <div class="header">Welcome!</div>
            <div class="info">
                <div>
                  <table class = "table">
                  <tr>
                          <td>User<br> </td> 
                          <td>Titel<br> </td> 
                          <td>Melding ID<br> </td>
                          <td>Status<br> </td>
                          <td>Prioriteit <br> </td>
                          <td>Datum <br> </td>
                          </tr>
                  
                     
                  <?php

                        
                        $sql1 = "SELECT meldingID, statusID, beschr_kort, datum, prioID FROM meldingen";
                        $sql3 = "SELECT prioID, prioriteit FROM prioriteit";
                        // $sql4 = "SELECT naam FROM users WHERE userID = ".$current_user['userID'];
                        // $result4 = $conn->query($sql4);
                        $result3 = $conn->query($sql3);
                        $result = $conn->query($sql1);

                        while($row = $result->fetch_assoc()) {
                            $mid = $row["meldingID"];
                          echo "<tr>";
                          echo "<td>" .$current_user["naam"]."<br>  </td>"; 
                          echo "<td>" .$row["beschr_kort"]."<br>  </td>"; 
                          echo "<td>" .$row["meldingID"]."<br> </td>";
                          echo "<td>" .$row["statusID"]."<br> </td>";
                          echo "<td>" .$row["prioID"]."<br> </td>";                          
                          echo "<td>" .$row["datum"]."<br> </td>";
                          echo "<td><a href='reactie.php?meldingid=$mid'>   <input type='button' value='test'></a> <br> </td>";
                          echo "</tr>";
                          
                          } 

                  ?>

                  </input>
                  </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>