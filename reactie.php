<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/fbea3c1d87.js" crossorigin="anonymous"></script>
    <?php 
     include 'config.php';
     include 'scripts/verify_user.php';
     if($_SERVER["REQUEST_METHOD"] == "GET"){
     $meldingID = $_GET["meldingid"];
     }  
     if($_SERVER["REQUEST_METHOD"] == "POST"){
       
        $meldingID = $_POST['meldingID'];
        $userID = $current_user['userID'];
        $reactie = $_POST['reactie'];
        $datum = date('Y-m-d H:i:s');
    
        $insertquery = "INSERT INTO reacties (meldingID, userID, reactie, datum)
        VALUES ('$meldingID', '$userID', '$reactie', '$datum')";
        $insertresult = $conn->query($insertquery);
    }
    
    ?>
</head>
<body>



    <div class="wrapper">
        <div class="sidebar">
            <h2>[user-name]</h2>
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
                <?php
                    $sql1 = "SELECT meldingID, statusID, beschr_kort, beschr_lang, userID, prioID, statusID, itemID, reactieID, datum FROM  meldingen  WHERE meldingID = $meldingID";
                    $sql2 = "SELECT statusID, status FROM status";
                    $result2 = $conn->query($sql2);
                    $result = $conn->query($sql1);
                        
                    while($row = $result->fetch_assoc()) {
                    $mid = $row["meldingID"];
                    echo "<tr>";
                    echo "<td>" .$row["beschr_kort"]."<br>  </td>"; 
                    echo "<td>" .$row["beschr_lang"]."<br>  </td>"; 
                    echo "<td>" .$row["prioID"]."<br>  </td>"; 
                    echo "<td>" .$row["userID"]."<br>  </td>"; 
                    echo "<td>" .$row["meldingID"]."<br> </td>";
                    echo "<td>" .$row["statusID"]."<br> </td>";
                    echo "<td>" .$row["datum"]."<br> </td>";
                    echo "</tr>";
                          
                    }                 
                 ?>
                </div>
            </div>
            <div class="header">Reacties</div>
            <div class="info">
                <div>
                <?php
                    $sql3 = "SELECT reactie, reacties.userID, users.naam FROM  reacties LEFT JOIN users on reacties.userID = users.userID  WHERE meldingID = $meldingID";
                    
                    $result3 = $conn->query($sql3);
                        
                    while($row = $result3->fetch_assoc()) {
                    echo "<br> <tr>";
                    echo "<td>" .$row["naam"]."<br>  </td>"; 
                    echo "<td>" .$row["reactie"]."<br>  </td>"; 
                    echo "<br> </tr>";
                          
                    }                 
                 ?>
                </div>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  method="POST">

                        <label>Reageer</label>
                        <input type="text" name="reactie" class="form-label"/>
                        <input type = hidden name="meldingID" value= "<?php echo $meldingID ?>">
                        
                        <button type="submit" value="Submit" class="btn btn-primary" style="background-color: #3597e7">Post</button> 
                    </form>  
        </div>
    </div>

</body>
</html>