<?php
    Include 'config.php';
    Include 'scripts/verify_user.php';
    need_admin($current_user);

    if (isset($_GET['archive']))
    {
        $conn->query("UPDATE meldingen SET statusID=5 WHERE meldingID = ".$_GET['archive']);
    }
    if (isset($_GET['stat']))
    {
        $conn->query("UPDATE meldingen SET statusID=".$_GET['stat']." WHERE meldingID = ".$_GET['messID']);
    }
    if (isset($_GET['prio']))
    {
        $conn->query("UPDATE meldingen SET prioID=".$_GET['prio']." WHERE meldingID = ".$_GET['messID']);
    }
    if (isset($_GET['revive']))
    {
        $conn->query("UPDATE meldingen SET statusID = 2 WHERE meldingID = ".$_GET['revive']);
    }
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
        <h2>Morb-OS</h2>
            <h4> User: <?php
                        echo $current_user['naam'];
                        ?></h4>
            <ul>
                <li><a href="index.php"><i class="fas fa-home"></i>Thuispagina</a></li>
                <li><a href="melding_visualize.php"><i class="fas fa-layer-group"></i>Zie Meldingen</a></li>
                <li><a href="melding_create.php"><i class="fas fa-plus"></i>Maak Melding</a></li>
            </ul>

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
                        
                        $sql1 = "SELECT meldingID, statusID, beschr_kort, datum, prioID FROM meldingen WHERE statusID != 5 ORDER BY prioID";
                        $sql2 = "SELECT * FROM status";
                        $sql3 = "SELECT prioID, prioriteit FROM prioriteit";
                        $result3 = $conn->query($sql3);
                        $result2 = $conn->query($sql2);
                        $result = $conn->query($sql1);

                        $prio_arr = [];
                        $stat_arr = [];

                        while($row = $result3->fetch_assoc())
                        {
                            $prio_arr[] = $row;
                        }

                        while($row = $result2->fetch_assoc())
                        {
                            $stat_arr[] = $row;
                        }

                        while($row = $result->fetch_assoc()) {
                            $mid = $row["meldingID"];

                          echo "<tr>";
                          echo "<td>" .$current_user["naam"]."<br>  </td>"; 
                          echo "<td>" .$row["beschr_kort"]."<br>  </td>"; 
                          echo "<td>" .$row["meldingID"]."<br> </td>";
                          echo "<td><form action='admin.php' method='get'><input type='hidden' name='messID' value='".$row["meldingID"]."'><select name='stat' onchange='this.form.submit()'>";
                          foreach($stat_arr as $stat_row)
                          {
                            $default = "";
                            if ($stat_row['statusID'] == $row['statusID']) $default = "selected='selected'";
                            echo "<option value='".$stat_row['statusID']."' ".$default."'>".$stat_row['status']."</option>";
                          }
                          echo "</select></form></td>";
                          echo "<td><form action='admin.php' method='get'><input type='hidden' name='messID' value='".$row["meldingID"]."'><select name='prio' onchange='this.form.submit()'>";
                          foreach($prio_arr as $prio_row)
                          {
                            $default = "";
                            if ($prio_row['prioID'] == $row['prioID']) $default = "selected='selected'";
                            echo "<option value='".$prio_row['prioID']."' ".$default.">".$prio_row['prioriteit']."</option>";
                          }
                          echo "</select></form></td>";
                          echo "<td>" .$row["datum"]."<br> </td>";
                          echo "<td><form action='admin.php' method='get'><input type='hidden' name='archive' value='".$row["meldingID"]."'><button type='submit' class='btn btn-warning'>archiveren</button></form> <br> </td>";
                          echo "</tr>";
                        } 

                  ?>

                  </input>
                  </table>

                <br><br>
                <h3>Gearchiveerde Meldingen</h3>

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


                    $sql1 = "SELECT meldingID, statusID, beschr_kort, datum, prioID FROM meldingen WHERE statusID = 5";
                    $sql3 = "SELECT prioID, prioriteit FROM prioriteit";
                    // $sql4 = "SELECT naam FROM users WHERE userID = ".$current_user['userID'];
                    // $result4 = $conn->query($sql4);
                    $result3 = $conn->query($sql3);
                    $result = $conn->query($sql1);

                    while ($row = $result->fetch_assoc()) {
                        $mid = $row["meldingID"];
                        echo "<tr>";
                        echo "<td>" . $current_user["naam"] . "<br>  </td>";
                        echo "<td>" . $row["beschr_kort"] . "<br>  </td>";
                        echo "<td>" . $row["meldingID"] . "<br> </td>";
                        echo "<td>" . $row["statusID"] . "<br> </td>";
                        echo "<td>" . $row["prioID"] . "<br> </td>";
                        echo "<td>" . $row["datum"] . "<br> </td>";
                        echo "<td><form action='admin.php' method='get'><input type='hidden' name='revive' value='".$row["meldingID"]."'><button class='btn btn-warning' type='submit'>zet terug</button></form> <br> </td>";
                        echo "</tr>";
                    }

                    ?>
                </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>