<?php
Include 'env.php';
include 'scripts/verify_user.php';


// var_dump($_SESSION);
//in DB, collectors table, handelingen, daar staan de users die toegang hebben tot de database met de bijbehorende servernaam en email.


$servername = $DB_HOST;
$user = $DB_USER;
$password = $DB_PASSWORD;
$databasename = $DB_NAAM;
$message = "";


try {
  $conn = new PDO("mysql:host=$servername;dbname=$databasename", $user, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";

  $email = $password = "";
  $email_err = $password_err = $login_err = "";

  function pr($data, $kill_script = false)
{
    echo '<pre>'.print_r($data,1).'</pre>';
    if($kill_script) exit;
 }

    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if email is empty
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter email.";
    }
    else{
        $email = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    }
    else{
        $password = trim($_POST["password"]);
    }

        // Validate Credentials
        if(empty($email_err) && empty($password_err)){
            //prepare a select statement
            $sql = "SELECT userID, email, wachtwoord FROM users WHERE email = :email";
    

            if($stmt = $conn->prepare($sql)){
                // bind variables to the prepared statement as parameters
                $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
                //set parameters
                $param_email = trim($_POST["email"]);
                if($stmt->execute()){

                    // check if email exits, if yes then verify password
                    
                    if($stmt->rowCount() == 1){
                        if($row = $stmt->fetch()){
                            $UserID = $row["userID"];
                            $email = $row["email"];
                            $hashed_password = $row["wachtwoord"];


                            if(password_verify($password, $hashed_password)){
                                // password is correct, so start new session
                                session_start();
                                
                                //store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["userID"] = $UserID;
                                $_SESSION["email"] = $email;

                                //redirect user to welcome page
                                if (isset($_SESSION['page']))
                                {
                                    header("location: ".$_SESSION['page']);
                                }
                                else
                                {
                                    header("location: index.php");
                                }
                            }
                            else{
                                //invalid password, display error message
                                $login_err = "Invalid email or password. 1";
                            }
                        }
                    }
                    else{
                        //email doesn't exist, display error message

                        $login_err = "Invalid email or password. 2";
                    }   
                }
                else{
                    echo "Something went wrong, please try again later.";
                }

                //close statement
                unset($stmt);
            }
        }

        //close connection
        unset($conn);
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

    <title>Login Page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


        <link rel="stylesheet" type="text/css" href="../bootstrap/css/main.css">
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/logintest.css">



 
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
</head>

<body>

    <div class="wrapper">
        <div class="sidebar">
        <img src="img/morbius.png" class=amogus></img>
            <h2>Morb-OS</h2>
            <ul>
                <li><a href="index.php"><i class="fas fa-home"></i>Thuispagina</a></li>
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
                
       
        <header class="page-header header container-fluid">                        
            <div class="wrapper">
        <h1>Login</h1>
        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group"><br><br><br>
                <label>Email</label>
                <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" name="login" class="btn btn-primary" value="Login">
            </div>
            <p>Nog geen account?<a href="register.php"> Maak nu één aan!</a>.</p>
        </form>
    </div>
        </header>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>






            </div>
</body>
</html>






