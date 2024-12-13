<?php

session_start();

include("dbh.inc.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $_SESSION["training_id"] = $_POST["training_id"];
    
    header("location: ../pdf_preview.php");

    exit();
    }
