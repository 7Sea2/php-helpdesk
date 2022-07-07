<?php
Include 'config.php';
include 'scripts/verify_user.php';


//hieronder de query
$sql1 = "SELECT catID, cat_naam FROM categorie ORDER BY catID";

//hieronder de query uitgevoerd op het connectieobject en opgeslagen in de variabele result1
$cat_result = $conn->query($sql1);

$sql2 = "SELECT itemID, item_naam FROM items ORDER BY itemID";
$item_result = $conn->query($sql2);

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $catID = $_POST['categorie'];
    $beschr_kort = $_POST['beschr_kort'];
    $beschr_lang = $_POST['beschr_lang'];
    $itemID = $_POST['item'];
    $datetime = date('Y-m-d H:i:s');
    $userID = $current_user['userID'];
    $status = 1;

    $insertquery = "INSERT INTO meldingen (userID, catID, beschr_kort, beschr_lang, itemID, datum, statusID)
    VALUES ('$userID', '$catID', '$beschr_kort', '$beschr_lang', '$itemID', '$datetime', '$status')";
    $insertresult = $conn->query($insertquery);
    header("location:melding_visualize.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Maak melding aan</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/fbea3c1d87.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


        <link rel="stylesheet" type="text/css" href="../bootstrap/css/main.css">
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/logintest.css">
 
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
      
    </head>
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
                    <h3>Maak melding aan</h3><br>
        
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  method="POST">
                        <label>Titel</label>
                        <input type="text" name="beschr_kort" maxlength="50" class="form-control" />  
                        <br/>  
                        <label>Lange Beschrijving</label>
                        <input type="text" name="beschr_lang" class="form-control"/>
                        <br/>
                        <?php
                        echo "Categorie<br>";
                        //hieronder maak ik de 'list' aan
                        echo "<select name='categorie' id='catID'>";
                        //en hieronder vul ik de list door alle waarden uit de array te halen in een loop
                        while($row = $cat_result->fetch_assoc()) {
                            $catnaam = $row["cat_naam"];
                            $catID = $row["catID"];
                            echo "<option value='$catID'>$catnaam</option>";
                        }
                        echo "</select>";

                        echo "<br><br>Apparaat<br>";
                        echo "<select name='item' id='item'>";
                        while($row2 = $item_result->fetch_assoc()) {
                            $itemnaam = $row2["item_naam"];
                            $itemID = $row2["itemID"];
                            echo "<option value='$itemID'>$itemnaam</option>";
                        }
                        echo "</select>";
                        ?>
                        <br/>
                        <br/>
                        <!-- <input type="submit" value="Submit" />  -->
                        <button type="submit" value="Submit" class="btn btn-primary" style="background-color: #3597e7">Submit</button> 
                    </form>  
                </div>
            </div>
        </div>
    </div>

</body>
</html>

