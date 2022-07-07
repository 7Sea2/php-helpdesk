<?php
include 'config.php';
include 'scripts/verify_user.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="table.css">
    <script src="https://kit.fontawesome.com/fbea3c1d87.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <?php
    include 'config.php';

    ?>
</head>

<body>

    <div class="wrapper">
        <div class="sidebar">
            <h2>Morb-OS</h2>
            <h4> User: <?php
                        echo $current_user['naam'];
                        ?></h4>
            <ul>
                <li><a href="index.php"><i class="fas fa-home"></i>Thuispagina</a></li>
                <li><a href="melding_visualize.php"><i class="fas fa-layer-group"></i>Zie Meldingen</a></li>
                <li><a href="melding_create.php"><i class="fas fa-plus"></i>Maak Melding</a></li>
                <?php
                    if (isset($current_user))
                    {
                        if ($current_user['rollID'] == 1) echo '<li><a href="admin.php"><i class="fas fa-address-book"></i>Administratie</a></li>';
                    }
                ?>
            </ul>
            <li><a href="logoutConfirm.php" class="logout"><i class="fas fa-minus"></i>Log Out</a></li>

        </div>
        <div class="main_content">
            <div class="header">Welcome!</div>
            <div class="info">
                <div>
                    <table class="table">
                        <tr>
                            <td>User<br> </td>
                            <td>Titel<br> </td>
                            <td>Melding ID<br> </td>
                            <td>Status<br> </td>
                            <td>Prioriteit <br> </td>
                            <td>Datum <br> </td>
                        </tr>


                        <?php
                        $user_now = $current_user['naam'];


                        $joinquery = "SELECT users.naam, meldingen.meldingID, status.status, meldingen.beschr_kort, meldingen.datum, meldingen.prioID FROM meldingen RIGHT JOIN status ON meldingen.meldingID = meldingen.meldingID LEFT JOIN users ON meldingen.userID = meldingen.userID WHERE meldingen.statusID = status.statusID AND status.statusID BETWEEN 0 AND 4 AND meldingen.userID = users.userID AND users.naam = '$user_now'";
                        $joinqueryresult = $conn->query($joinquery);
                        // $sql1 = "SELECT userID, meldingID, statusID, beschr_kort, datum, prioID FROM meldingen";
                        // $sql2 = "SELECT statusID, status FROM status";
                        $sql3 = "SELECT prioID, prioriteit FROM prioriteit";
                        $result3 = $conn->query($sql3);
                        // $result2 = $conn->query($sql2);
                        // $result = $conn->query($sql1);

                        while ($row = $joinqueryresult->fetch_assoc()) {
                            $mid = $row["meldingID"];
                            echo "<tr>";
                            echo "<td>" . $row["naam"] . "<br>  </td>";
                            echo "<td>" . $row["beschr_kort"] . "<br>  </td>";
                            echo "<td>" . $row["meldingID"] . "<br> </td>";
                            echo "<td>" . $row['status'] . "<br> </td>";
                            echo "<td>" . $row["prioID"] . "<br> </td>";
                            echo "<td>" . $row["datum"] . "<br> </td>";
                            echo "<td><a href='reactie.php?meldingid=$mid'>   <input type='button' value='Zie Melding'></a> <br> </td>";
                            echo "</tr>";
                        }

                        ?>

                  </input>
                  </table>

                  <br><br><h3>Gearchiveerde Meldingen</h3>

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

                        $joinquery2 = "SELECT users.naam, meldingen.meldingID, status.status, meldingen.beschr_kort, meldingen.datum, meldingen.prioID FROM meldingen RIGHT JOIN status ON meldingen.meldingID = meldingen.meldingID LEFT JOIN users ON meldingen.userID = meldingen.userID WHERE meldingen.statusID = status.statusID AND meldingen.statusID = 5 AND meldingen.userID = users.userID AND users.naam = '$user_now'";

                        // $sql1 = "SELECT meldingID, statusID, beschr_kort, datum, prioID FROM meldingen WHERE statusID = 5";
                        $sql3 = "SELECT prioID, prioriteit FROM prioriteit";
                        // $sql4 = "SELECT naam FROM users WHERE userID = ".$current_user['userID'];
                        // $result4 = $conn->query($sql4);
                        $result3 = $conn->query($sql3);
                        $result = $conn->query($joinquery2);

                        while ($row = $result->fetch_assoc()) {
                            $mid = $row["meldingID"];
                          echo "<tr>";
                          echo "<td>" .$row["naam"]."<br>  </td>"; 
                          echo "<td>" .$row["beschr_kort"]."<br>  </td>"; 
                          echo "<td>" .$row["meldingID"]."<br> </td>";
                          echo "<td>" .$row["status"]."<br> </td>";
                          echo "<td>" .$row["prioID"]."<br> </td>";                          
                          echo "<td>" .$row["datum"]."<br> </td>";
                          echo "<td><a href='reactie.php?meldingid=$mid'>   <input type='button' value='Zie Melding'></a> <br> </td>";
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