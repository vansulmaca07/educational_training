<?php

session_start ();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $_SESSION["document_number"] = $_POST["document_number"];

    header("location: ../attendance.php");
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "GET") {
    $_SESSION["document_number"] = $_GET["training_id"];
    header("location: ../attendance.php");
    exit();
}

