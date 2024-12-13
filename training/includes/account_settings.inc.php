<?php

session_start();

$training_id = $_SESSION["training_id"];
include("dbh2.inc.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $GID = $_POST["GID_user_account"];
    $account_activation = $_POST["account_activation"];

    $query = "UPDATE users
        SET
            account_activation = :account_activation
        WHERE
            GID = :GID
    ";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":account_activation", $account_activation);
    $stmt->bindParam(":GID", $GID);
    $stmt->execute();

    exit();
}