<?php

$dsn = "mysql:host=localhost;dbname=trainingdb";
//$dbusername = "root";
$dbusername = "sfadmin";
$dbpassword = "kka9970440";
//$dbpassword = "";

try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword); //code...
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection Failed: " . $e->getMessage(); //throw $th;
}

