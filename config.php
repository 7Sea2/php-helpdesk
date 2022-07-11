<?php

session_start();

Include 'env.php';

$servername = $DB_HOST;
$username = $DB_USER;
$password = $DB_PASSWORD;
$databasename = $DB_NAAM;
$message = "";

$conn = new mysqli($servername, $username, $password, $databasename);

function get_url()
{

    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') $url = "https://";   
        else $url = "http://";   


        $url.= $_SERVER['HTTP_HOST'];   
       

        $url.= $_SERVER['REQUEST_URI']; 
        return $url;
}

function alert($text = "", $warning = "primary", $url = "index.php")
{

    header("location: ".$url);
    $_SESSION['alertMess'] = $text;
    $_SESSION['alertCol'] = $warning;
}


?>