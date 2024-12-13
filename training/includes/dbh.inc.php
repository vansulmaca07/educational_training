<?php

$servername = "localhost";
//$dbusername = "root";
$dbusername = "sfadmin";
//$dbpassword = "";

$dbpassword = "kka9970440";

$dbname = "trainingdb";

$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
    
}