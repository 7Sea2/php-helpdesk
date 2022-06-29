<?php

Include 'env.php';

$servername = $DB_HOST;
$username = $DB_USER;
$password = $DB_PASSWORD;
$databasename = $DB_NAAM;
$message = "";

$conn = new mysqli($servername, $username, $password, $databasename);

?>