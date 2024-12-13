<?php

session_start();
include("dbh2.inc.php");

if(isset($_POST["reset_process"])) {
    $query = "DELETE FROM filters
        WHERE
            GID = :GID
            ";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":GID", $_SESSION["GID"]);
    $stmt->execute();
}

if(isset($_POST["reset_shift"])) {
    $query = "DELETE FROM filters
        WHERE
            GID = :GID
            ";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":GID", $_SESSION["GID"]);
    $stmt->execute();
}

