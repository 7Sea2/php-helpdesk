
<?php

Include 'config.php';
include 'scripts/verify_user.php';


$servername = $DB_HOST;
$username = $DB_USER;
$password = $DB_PASSWORD;
$databasename = $DB_NAAM;
$message = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";

  if(isset($_POST["register"])){

    var_dump($_POST);

        if(empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["email"]) || empty($_POST["tel1"]))
        {
            $message = '<label>All fields are required</label>';
        }
        else
        {
            $query = "INSERT INTO users (naam, wachtwoord, email, telnr, alt_telnr) 
            VALUES (:username, :password, :email, :tel1, :tel2)";
            $statement = $conn->prepare($query);

            $statement->bindParam(':username', $username);
            $statement->bindParam(':password', $password);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':tel1', $tel1);
            $statement->bindParam(':tel2', $tel2);

            $username      =      $_POST["username"];
            $password      =      password_hash($_POST["password"], PASSWORD_DEFAULT);
            $email      =      $_POST["email"];
            $tel1   =   $_POST["tel1"];
            $tel2   =   $_POST['tel2'];

            $statement->execute();

            $count = $statement->rowCount();
            if($count > 0)
            {
                $_SESSION["email"] = $_POST["email"];
                header("location:inlog.php");
            }
            else
            {
                $message = '<label>Wrong Data</label>';
            }
        }
  }
}
  catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/fbea3c1d87.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>Registratie</title>
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

    <div class="wrapper">
        <div class="sidebar">
            <h2><?php if($_SESSION['loggedin']){echo $current_user['naam'];} else{echo 'je moet inloggen';} ?></h2>
            <ul>
                <li><a href="dashboard.html"><i class="fas fa-home"></i>Thuispagina</a></li>
                <li><a href="melding_visualize.php"><i class="fas fa-layer-group"></i>Zie Meldingen</a></li>
                <li><a href="melding_create.php"><i class="fas fa-plus"></i>Maak Melding</a></li>
                <?php
                    if (isset($current_user))
                    {
                        if ($current_user['rollID'] == 1) echo '<li><a href="admin.php"><i class="fas fa-address-book"></i>Administratie</a></li>';
                    }
                ?>
            </ul>
            <li><a href="#" class="logout"><i class="fas fa-minus"></i>Log Out</a></li>
        </div>
        <div class="main_content">
            <div class="header">Welcome!</div>
            <div class="info">
                <!-- <?php
                if ($_SESSION['loggedin']) {
                    echo "logged in succesfully";
                } else {
                    echo "not logged in";
                }
                ?> -->

<header class="page-header header container-fluid">                        
            <div class="container" style="width:500px;">  
                <?php  
                if(isset($message))  
                {  
                     echo '<label class="text-danger">'.$message.'</label>';  
                }  
                ?>  
                <h3 >Maak je Morb OS account aan</h3><br />  
                <form action=""  method="POST">
                     <label>Naam</label>  
                     <input type="text" name="username" class="form-control" />  
                     <br />  
                     <label>Wachtwoord</label>  
                     <input type="password" name="password" class="form-control" />  
                     <br />  
                     <label>Email</label>  
                     <input type="email" name="email" class="form-control" />  
                     <br />  
                     <label>Telefoon nummer</label>  
                     <input type="tel" name="tel1" class="form-control" />  
                     <br /> 
                     <label>Alternatief Telefoon nummer</label>  
                     <input type="tel" name="tel2" class="form-control" />  
                     <br /> 
                     <input type="submit" name="register" class="btn btn-info" value="Sign Up" />  
                </form>  
           </div>
        </header>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
   
            </div>
</body>
</html>