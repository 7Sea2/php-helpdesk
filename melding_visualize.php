<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="helpdesk-dashboard/style.css">
    <link rel="stylesheet" href="table.css">
    <script src="https://kit.fontawesome.com/fbea3c1d87.js" crossorigin="anonymous"></script>
      <?php
      include 'config.php';
      $servername = $DB_HOST;
      $username = $DB_USER;
      $password = $DB_PASSWORD;
      $databasename = $DB_NAAM;
      $conn = new mysqli($servername, $username, $password, $databasename);
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

      ?>
</head>
<body>

    <div class="wrapper">
        <div class="sidebar">
            <h2>[user-name]</h2>
            <ul>
                <li><a href="helpdesk-dashboard/dashboard.html"><i class="fas fa-home"></i>Thuispagina</a></li>
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
                        $sql1 = "SELECT userID, meldingID, statusID, beschr_kort, datum, prioID FROM meldingen";
                        $sql2 = "SELECT statusID, status FROM status";
                        $sql3 = "SELECT prioID, prioriteit FROM prioriteit";
                        $result3 = $conn->query($sql3);
                        $result2 = $conn->query($sql2);
                        $result = $conn->query($sql1);

                        while($row = $result->fetch_assoc()) {
                          
                          echo "<tr>";
                          echo "<td>" .$row["userID"]."<br> </td>"; 
                          echo "<td>" .$row["beschr_kort"]."<br> </td>"; 
                          echo "<td>" .$row["meldingID"]."<br> </td>";
                          echo "<td>" .$row["statusID"]."<br> </td>";
                          echo "<td>" .$row["prioID"]."<br> </td>";                          
                          echo "<td>" .$row["datum"]."<br> </td>";
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