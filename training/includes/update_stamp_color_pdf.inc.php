<?php

include("dbh2.inc.php");

if($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $creator_stamp = $_POST["creator_stamp"];
    $approver_stamp = $_POST["approver_stamp"];
    $training_id = $_POST["training_id_stamp"];

   $query = "UPDATE training_form
        SET
            creator_stamp_color = :creator_stamp,
            approver_stamp_color = :approver_stamp
        WHERE
            training_id = :training_id
        ";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":creator_stamp", $creator_stamp);
    $stmt->bindParam(":approver_stamp", $approver_stamp);
    $stmt->bindParam(":training_id", $training_id);
    $stmt->execute(); 

    echo $creator_stamp;

}

else {
    echo "ERROR";
}