<?php

session_start();
include("dbh2.inc.php");

$training_id = $_SESSION["training_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    $judgement = $_POST["judgement_applicable"];

    try {
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);

        $query = "UPDATE training_form
            SET 
                judgement = :judgement
            WHERE
                training_id = :training_id      
        ";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":judgement", $judgement);
        $stmt->bindParam(":training_id", $training_id);
        
        $stmt->execute();

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
    
}
    
   
