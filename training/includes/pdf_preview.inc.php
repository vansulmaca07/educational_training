<?php

session_start();

include("dbh.inc.php");

if ($_SERVER["REQUEST_METHOD"] == "POST")

    
    $sql = "SELECT training_id, training_name, process_prefix, process_suffix,
    start_time_regular, end_time_regular, location_regular, instructor_regular,
    category_quality, category_environment, category_safety_and_hygiene, category_others, category_others_manual, purpose, contents, usage_id, audience, area, department_name FROM training_form
    
    INNER JOIN department on training_form.creation_department = department.department_id 
    where training_id = '$training_id';";
                            
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
    $_SESSION["category_quality"] = $row["category_quality"];
    $_SESSION["category_environment"] = $row["category_environment"];
    $_SESSION["category_safety_and_hygiene"] = $row["category_safety_and_hygiene"];
    $_SESSION["category_others"] = $row["category_others"];
    $_SESSION["category_others_manual"] = $row["category_others_manual"];
    $_SESSION["purpose"] = $row["purpose"];
    $_SESSION["contents"] = $row["contents"];
    $_SESSION["usage_id"] = $row["usage_id"];
    $_SESSION["audience"] = $row["audience"];
    $_SESSION["area"] = $row["area"];
    
    header("location: ../pdf_preview.php");

    exit();
    }