<?php

session_start();
include("dbh2.inc.php");



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $training_id = $_POST["training_id_delete"];

    try {
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);

       
        $query = "DELETE FROM attendance /**Delete Attendance**/
            WHERE 
                training_id = :training_id; 
        
        UPDATE file_storage /**Delete File Storage**/
            SET 
                active_status = 2
            WHERE
                training_id = :training_id;

        DELETE FROM category /**Delete Category**/
            WHERE training_id = :training_id;

        DELETE FROM training_form /**Delete Training Form**/
            WHERE training_id = :training_id;
        ";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":training_id", $training_id);
        
        $stmt->execute();

        $pdo = null;
        $stmt = null;

        header("Location: ../progress_test.php?success_delete=$training_id");

        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
    
}