<?php

Include 'config.php';

//hieronder de query
$sql1 = "SELECT catID, cat_naam FROM categorie ORDER BY catID";

//hieronder de query uitgevoerd op het connectieobject en opgeslagen in de variabele result1
$cat_result = $conn->query($sql1);

$sql2 = "SELECT itemID, item_naam FROM items ORDER BY itemID";
$item_result = $conn->query($sql2);

if($_SERVER["REQUEST_METHOD"] == "POST"){
echo 'dfdgbfa';
    $catID = $_POST['categorie'];
    $beschr_kort = $_POST['beschr_kort'];
    $beschr_lang = $_POST['beschr_lang'];
    $itemID = $_POST['item'];

    $insertquery = "INSERT INTO meldingen (catID, beschr_kort, beschr_lang, itemID)
    VALUES ('$catID', '$beschr_kort', '$beschr_lang', '$itemID')";
    $insertresult = $conn->query($insertquery);
}

?>

<DOCTYPE html>

<head>

        <title>melding</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <link rel="stylesheet" type="text/css" href="../bootstrap/css/main.css">
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/logintest.css">
 
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      
    </head>
    
    <body>
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
        <input type="submit" value="Submit" />  
    </form>  


    </body>
</html>