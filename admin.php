<?php
    Include 'config.php';
    Include 'scripts/verify_user.php';
    need_admin($current_user);

    if (isset($_GET['archive']))
    {
        $conn->query("UPDATE meldingen SET statusID=5 WHERE meldingID = ".$_GET['archive']);
    }
    if (isset($_GET['prio']))
    {
        $conn->query("UPDATE meldingen SET prioID=".$_GET['prio']." WHERE meldingID = ".$_GET['messID']);
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
                        $sql3 = "SELECT prioID, prioriteit FROM prioriteit";
                        $result3 = $conn->query($sql3);
                        $result = $conn->query($sql1);

                        $prio_arr = [];

                        while($row = $result3->fetch_assoc())
                        {
                            $prio_arr[] = $row;
                        }

                        while($row = $result->fetch_assoc()) {
                            $mid = $row["meldingID"];

                          echo "<tr>";
                          echo "<td>" .$current_user["naam"]."<br>  </td>"; 
                          echo "<td>" .$row["beschr_kort"]."<br>  </td>"; 
                          echo "<td>" .$row["meldingID"]."<br> </td>";
                          echo "<td>" .$row["statusID"]."<br> </td>";
                          echo "<td><form action='admin.php' method='get'><input type='hidden' name='messID' value='".$row["meldingID"]."'><select name='prio'>";
                          foreach($prio_arr as $prio_row)
                          {
                            $default = "";
                            if ($prio_row['prioID'] == $row['prioID']) $default = "selected='selected'";
                            echo "<option value='".$prio_row['prioID']."' ".$default.">".$prio_row['prioriteit']."</option>";
                          }
                          echo "</select><br>";
                          echo "<button class='btn btn-success btn-sm' type='submit'>update</button></form></td>";
                          echo "<td>" .$row["datum"]."<br> </td>";
                          echo "<td><form action='admin.php' method='get'><input type='hidden' name='archive' value='".$row["meldingID"]."'><button type='submit' class='btn btn-warning'>archiveren</button></form> <br> </td>";
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