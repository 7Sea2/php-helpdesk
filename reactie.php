<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/fbea3c1d87.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <?php 
     include 'config.php';
     include 'scripts/verify_user.php';

     $meldingID = $_GET["meldingid"];


     if($_SERVER["REQUEST_METHOD"] == "POST"){
        $userID = $current_user['userID'];
        $reactie = $_POST['reactie'];
        $datum = date('Y-m-d H:i:s');
    
        $insertquery = "INSERT INTO reacties (meldingID, userID, reactie, datum)
        VALUES ('$meldingID', '$userID', '$reactie', '$datum')";
        $insertresult = $conn->query($insertquery);
    }

    $messQuery = $conn->query("SELECT userID FROM meldingen WHERE meldingID = ".$meldingID);
    while($row = $messQuery->fetch_assoc())
    {
        $messID = $row['userID'];
    }

    need_user($messID, true);
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
            <form action="<?php echo get_url();?>"  method="POST">

                        <label>Reageer</label>
                        <input type="text" name="reactie" class="form-label"/>
                        
                        <button type="submit" value="Submit" class="btn btn-primary" style="background-color: #3597e7">Post</button> 
                    </form>  
        </div>
    </div>

</body>

</html>