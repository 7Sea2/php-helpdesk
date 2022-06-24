
<?php
session_start();
//in DB, collectors table, handelingen, daar staan de users die toegang hebben tot de database met de bijbehorende servernaam en username.

Include 'env.php';

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

        if(empty($_POST["name"]) || empty($_POST["surname"]) || empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["email"]))
        {
            $message = '<label>All fields are required</label>';
        }
        else
        {
            $query = "INSERT INTO collectors (Name, Surname, Username, Password, Email) 
            VALUES (:name, :surname, :username, :password, :email )";
            $statement = $conn->prepare($query);

            $statement->bindParam(':name', $name);
            $statement->bindParam(':surname', $surname);
            $statement->bindParam(':username', $username);
            $statement->bindParam(':password', $password);
            $statement->bindParam(':email', $email);

            // $statement->bindParam(":name", $param_name, PDO::PARAM_STR);
            // $statement->bindParam(":surname", $param_surname, PDO::PARAM_STR);
            // $statement->bindParam(":username", $param_username, PDO::PARAM_STR);
            // $statement->bindParam(":password", $param_password, PDO::PARAM_STR);
            // $statement->bindParam(":email", $param_email, PDO::PARAM_STR);


            $name      =      $_POST["name"];
            $surname      =      $_POST["surname"];
            $username      =      $_POST["username"];
            $password      =      password_hash($_POST["password"], PASSWORD_DEFAULT);
            $email      =      $_POST["email"];

            // $param_username = $username;
            // $param_password = password_hash($password, PASSWORD_DEFAULT);

            $statement->execute();

            $count = $statement->rowCount();
            if($count > 0)
            {
                $_SESSION["username"] = $_POST["username"];
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

        <title>Login Page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <link rel="stylesheet" type="text/css" href="../bootstrap/css/main.css">
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/logintest.css">

        <style>
            <?php include "main.css" ?>
            <?php include "login.css" ?>
            /* using php to connect to a css file */
        </style>


 
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
        
      
    </head>
    
    <body >


        <!--THIS IS THE NAVBAR-->
    <div class="main">
        <nav class="navbar navbar-expand-md">
            <a class="navbar-brand" href="index.php">CollectionHub</a>
            <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="main-navigation">
                <ul class="navbar-nav">
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#"></a>                        
                        <div class="form-group has-search">
                            <span class="fa fa-search form-control-feedback"></span>
                            <input type="text" class="form-control" placeholder="Search">
                          </div>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="#">Profile</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>



        

        <header class="page-header header container-fluid">
            <!-- <div class="overlay"></div>        -->
                        
            <div class="container" style="width:500px;">  
                <?php  
                if(isset($message))  
                {  
                     echo '<label class="text-danger">'.$message.'</label>';  
                }  
                ?>  
                <h3 >Create your CollectionHub account</h3><br />  
                <form action=""  method="POST">  
                     <label>Name</label>  
                     <input type="text" name="name" class="form-control" />  
                     <br />  
                     <label>Surname</label>  
                     <input type="text" name="surname" class="form-control" />  
                     <br />  
                     <label>Username</label>  
                     <input type="text" name="username" class="form-control" />  
                     <br />  
                     <label>Password</label>  
                     <input type="password" name="password" class="form-control" />  
                     <br />  
                     <label>Email</label>  
                     <input type="email" name="email" class="form-control" />  
                     <br />  
                     <input type="submit" name="register" class="btn btn-info" value="Sign Up" />  
                </form>  
           </div>
        </header>


        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>


        
    </body>
    
</html>