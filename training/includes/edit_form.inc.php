<?php

session_start();

//include("dbh.inc.php");
include("dbh2.inc.php");

echo $_POST["training_id"];


if($_SERVER["REQUEST_METHOD"] === "POST") {

    $training_id = $_POST["training_id"];

    $query_main = "SELECT training_id, training_name, process_prefix, process_suffix,
        start_time_regular, end_time_regular, location_regular, instructor_regular, count_, date_created,
        category_quality, category_environment, category_safety_and_hygiene, category_others, category_others_manual, purpose, contents, usage_id, audience, area, confirmation_by, confirmation_date, department_name, name_, start_time_regular,
        checker_comment_regular, checker_people_regular, checker_date_regular, modified_date, status_id, creation_department, start_time_a, end_time_a, location_a
    FROM training_form

    INNER JOIN department on training_form.creation_department = department.department_id
    INNER JOIN users on training_form.creator = users.GID
    where training_id = :training_id";


    $stmt_main = $pdo->prepare($query_main);

    $stmt_main->bindParam(":training_id", $training_id);
    $stmt_main->execute();
                            
    $result = $stmt_main->fetchAll();
                           
    foreach($result as $row) {
    
    $_SESSION["creation_department"] = $row["creation_department"];
    $_SESSION["training_id"] = $row["training_id"];
    $_SESSION["training_name"] = $row["training_name"];
    $_SESSION["process_prefix"] = $row["process_prefix"]; 
    $_SESSION["process_suffix"] = $row["process_suffix"];
    $_SESSION["start_time_regular"] = $row["start_time_regular"];
    $_SESSION["end_time_regular"] = $row["end_time_regular"];
    $_SESSION["location_regular"] = $row["location_regular"];
    $_SESSION["instructor_regular"] = $row["instructor_regular"];
    $_SESSION["start_time_a"] = $row["start_time_a"];
    $_SESSION["end_time_a"] = $row["end_time_a"];
    $_SESSION["location_a"] = $row["location_a"];
    $_SESSION["instructor_a"] = $row["instructor_a"];
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
    $_SESSION["confirmation_by"] = $row["confirmation_by"];
    $_SESSION["confirmation_date"] = $row["confirmation_date"];
    $_SESSION["count_"] = $row["count_"];
    $_SESSION["date_created"] = $row["date_created"];
    $_SESSION["training_creator"] = $row["name_"];
    $_SESSION["start_time_regular"] = $row["start_time_regular"];
    $_SESSION["checker_people_regular"] = $row["checker_people_regular"];
    $_SESSION["checker_comment_regular"] = $row["checker_comment_regular"];
    $_SESSION["checker_date_regular"] = $row["checker_date_regular"];
    $_SESSION["modified_date"] = $row["modified"];
    $_SESSION["status_id"] = $row["status_id"]; 

    }

    $stmt_main->closeCursor(); 

    $query = "SELECT category.category_id, category_name FROM category
    
    INNER JOIN category_ref on
        category_ref.category_id = category.category_id
        
    WHERE training_id = '$training_id'";

    $stmt = $pdo->prepare($query);

    $stmt->execute();

    $result_cat = $stmt->fetchAll();

    $category = array ();

    foreach ($result_cat as $categories) {
        $category[] = $categories["category_id"];
    }
    
    $_SESSION["category"] = $category;

    

    header("location: ../editform.php");

    

    echo $training_id;
    exit();

    } 