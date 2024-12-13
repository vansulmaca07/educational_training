<?php

session_start();
include("dbh2.inc.php");

$training_id = $_SESSION["training_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $file_id_delete = $_POST["file_id"];
    
    try {
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);

        $query = "UPDATE file_storage
            SET active_status = 2
            WHERE file_id = :file_id
        ";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":file_id", $file_id_delete);
        //$stmt->bindParam(":training_id", $training_id);
        
        $stmt->execute();

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
    
}