<?php

session_start();
include("dbh2.inc.php");

$training_id = $_SESSION["training_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $GID_delete = $_POST["GID_delete"];
    
    try {

        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);

        $query = "DELETE FROM attendance
        WHERE 
            GIDh = :GIDh
        AND 
            training_id = :training_id
        ";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":GIDh", $GID_delete);
        $stmt->bindParam(":training_id", $training_id);
        
        $stmt->execute();

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
    
}