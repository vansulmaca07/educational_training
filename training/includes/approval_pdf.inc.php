<?php

session_start();

include("dbh.inc.php");

if ($_SERVER["REQUEST_METHOD"] == "POST")

    $training_id = $_POST["training_id_pdf"];
    
    $sql = "SELECT training_id, training_name, process_prefix, process_suffix,
    start_time_regular, end_time_regular, location_regular, instructor_regular,
    category, purpose, contents, usage_id, audience, area, department_name FROM training_form
    
    INNER JOIN 
        department ON training_form.creation_department = department.department_id 
    where 
        training_id = '$training_id';";
                            
    $result = $conn->query($sql);
                            
    if (!$result) {
    die("Invalid Query: " . $connection->error);
    }

    while($row = $result->fetch_assoc()) {
    
    $_SESSION["creation_department"] = $row["department_name"];
    $_SESSION["training_id"] = $row["training_id"];
    $_SESSION["training_name"] = $row["training_name"];
    $_SESSION["process_prefix"] = $row["process_prefix"]; 
    $_SESSION["process_suffix"] = $row["process_suffix"];
    $_SESSION["start_time_regular"] = $row["start_time_regular"];
    $_SESSION["end_time_regular"] = $row["end_time_regular"];
    $_SESSION["location_regular"] = $row["location_regular"];
    $_SESSION["instructor_regular"] = $row["instructor_regular"];
    $_SESSION["category"] = $row["category"];
    $_SESSION["purpose"] = $row["purpose"];
    $_SESSION["contents"] = $row["contents"];
    $_SESSION["usage_id"] = $row["usage_id"];
    $_SESSION["audience"] = $row["audience"];
    $_SESSION["area"] = $row["area"];
    
    header("location: ../pdf_preview.php");

    exit();
    }