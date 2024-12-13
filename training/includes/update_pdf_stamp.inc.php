<?php

include("dbh2.inc.php");

if($_SERVER["REQUEST_METHOD"] === "POST") {

    $training_id = $_POST["training_id"];

    //edit approval date
    if(isset($_POST["edit_approval_date"])) {   

        $approval_date = $_POST["edit_approval_date"];

        $query = "UPDATE training_form
            SET
                approval_date = :approval_date
            WHERE
                training_id = :training_id
                ";
        
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":training_id", $training_id);
        $stmt->bindParam(":approval_date", $approval_date);
        $stmt->execute();

        echo $approval_date;

    }

    //edit stamp
    if(isset($_POST["action"])) {
        $input_creator = $_POST["creator"];
        $input_approver = $_POST["approver"];

        $query = "UPDATE training_form
            SET 
                pdf_creator = :input_creator,
                pdf_approver = :input_approver
            WHERE
                training_id = :training_id 
        ";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":training_id",$training_id);
        $stmt->bindParam(":input_creator",$input_creator);
        $stmt->bindParam(":input_approver",$input_approver);

        $stmt->execute();

    }



}





