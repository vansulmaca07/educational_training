<?php
session_start();



include_once "dbh2.inc.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $training_id = $_POST["training_id_approve"];
    $approver = $_POST["pdf_approver"];
    $approver_GID = $_POST["approver_GID"];

    $query = "UPDATE training_form
        SET 
            approval = '2',
            approval_date = now(),
            status_id = '2',
            pdf_approver = :pdf_approver,
            approver_GID = :approver_GID

        WHERE training_id = :training_id;

    ";

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":pdf_approver", $approver);
    $stmt->bindParam(":approver_GID", $approver_GID);
    $stmt->bindParam(":training_id", $training_id);

    $stmt->execute();

    $pdo =null;
    $stmt =null;

    header("Location: ../pdf_preview.php?training_id=$training_id");

}