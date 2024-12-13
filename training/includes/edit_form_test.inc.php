<?php

if(isset($_GET["training_id"])) {

    $training_id = $_GET["training_id"];
    $query_main = "SELECT 
            training_id, 
            training_name, 
            process_prefix, 
            process_suffix,
            start_time_regular, 
            end_time_regular, 
            location_regular, 
            instructor_regular, 
            count_, 
            date_created,
            category_others, 
            category_others_manual, 
            purpose, 
            contents, 
            usage_id, 
            audience, 
            area, 
            term,
            confirmation_by, 
            confirmation_date, 
            department_name, 
            name_, 
            modified_date, 
            status_id, 
            creation_department, 
            start_time_a, 
            end_time_a, 
            location_a,
            instructor_a,
            start_time_b, 
            end_time_b, 
            location_b,
            instructor_b,
            start_time_c, 
            end_time_c, 
            location_c,
            instructor_c,
            start_time_d, 
            end_time_d, 
            location_d,
            instructor_d,
            checker_comment_regular,  
            checker_date_regular,
            checker_comment_a,  
            checker_date_a,
            checker_comment_b,  
            checker_date_b,
            checker_comment_c,  
            checker_date_c,
            checker_comment_d,  
            checker_date_d,
            modified_by,
            modified_date,
            name_,
            judgement,
            users.department_id,
            open_training

    FROM training_form

    INNER JOIN 
        department ON training_form.creation_department = department.department_id
    INNER JOIN
        users ON training_form.creator = users.GID
    WHERE 
        training_id = :training_id";

    $stmt_main = $pdo->prepare($query_main);
    $stmt_main->bindParam(":training_id", $training_id);
    $stmt_main->execute();
                            
    $result = $stmt_main->fetchAll();
                           
    foreach($result as $row) {
    
    $training_id = $row["training_id"];
    $training_name = $row["training_name"];
    $process_prefix = $row["process_prefix"];
    $process_suffix = $row["process_suffix"];
    $start_time_regular = $row["start_time_regular"];
    $end_time_regular = $row["end_time_regular"];
    $location_regular = $row["location_regular"];
    $instructor_regular = $row["instructor_regular"];
    $count_ = $row["count_"];
    $date_created = $row["date_created"];
    $category_others = $row["category_others"];
    $category_others_manual = $row["category_others_manual"];
    $purpose = $row["purpose"];
    $contents = $row["contents"];
    $usage_ = $row["usage_id"];
    $audience = $row["audience"];
    $area = $row["area"];
    $term = $row["term"];
    $confirmation_by = $row["confirmation_by"];
    $confirmation_date = $row["confirmation_date"];
    $department_name = $row["department_name"];
    $training_creator = $row["name_"];
    $modified_date = $row["modified_date"];
    $status_id = $row["status_id"];
    $creation_department = $row["department_id"];
    $start_time_a = $row["start_time_a"];
    $end_time_a = $row["end_time_a"];
    $location_a = $row["location_a"];
    $instructor_a = $row["instructor_a"];
    $start_time_b = $row["start_time_b"];
    $end_time_b = $row["end_time_b"];
    $location_b = $row["location_b"];
    $instructor_b = $row["instructor_b"];
    $start_time_c = $row["start_time_c"];
    $end_time_c = $row["end_time_c"];
    $location_c = $row["location_c"];
    $instructor_c = $row["instructor_c"];
    $start_time_d = $row["start_time_d"];
    $end_time_d = $row["end_time_d"];
    $location_d = $row["location_d"];
    $instructor_d = $row["instructor_d"];
    $checker_comment_regular = $row["checker_comment_regular"];
    $checker_date_regular = $row["checker_date_regular"];
    $checker_comment_a = $row["checker_comment_a"];
    $checker_date_a = $row["checker_date_a"];
    $checker_comment_b = $row["checker_comment_b"];
    $checker_date_b = $row["checker_date_b"];
    $checker_comment_c = $row["checker_comment_c"];
    $checker_date_c = $row["checker_date_c"];
    $checker_comment_d = $row["checker_comment_d"];
    $checker_date_d = $row["checker_date_d"];
    $modified_date = $row["modified_date"];
    $modified_by = $row["modified_by"];
    $judgement = $row["judgement"];
    $open_training = $row["open_training"];

    }

    $stmt_main->closeCursor(); 

    //set judgement on session variable

    $_SESSION["judgement"] = $judgement;

    // get the name of who modified
    
    $query_modified = "SELECT name_, GID FROM users
        WHERE
            GID = :modified_by
            ";
    $stmt_modified = $pdo->prepare($query_modified);
    $stmt_modified->bindParam(":modified_by", $modified_by);
    $stmt_modified->execute();

    $result_modified_by = $stmt_modified->fetchAll();
    
    $modified_by_name = "";
    foreach($result_modified_by as $modified) {
        $modified_by_name = $modified["name_"];
    }

    $stmt_modified->closeCursor();

    //previous comments 

    $query_previous_comments = "SELECT * FROM training_form
        WHERE 
            creator = :creator
        ORDER BY
            date_created
        DESC LIMIT 1,1
        ";

    $stmt_previous_comments = $pdo->prepare($query_previous_comments);
    $stmt_previous_comments->bindParam(":creator", $_SESSION["GID"]);
    $stmt_previous_comments->execute();
    $result_previous_comments = $stmt_previous_comments->fetchAll();

    foreach($result_previous_comments as $prev_comments) {

        $checker_comment_previous_regular = $prev_comments["checker_comment_regular"];
        if($checker_comment_regular === null) {
            if($checker_comment_previous_regular === null)
            $checker_comment_regular = "上記の人にインタビューを実施し、理解できたことを確認できました。";
            else {
            $checker_comment_regular = $checker_comment_previous_regular;
            }
        }

        $checker_comment_previous_a = $prev_comments["checker_comment_a"];
        if($checker_comment_a === null) {
            if($checker_comment_previous_a === null)
            $checker_comment_a = "上記の人にインタビューを実施し、理解できたことを確認できました。";
            else {
            $checker_comment_a = $checker_comment_previous_a;
            }
        }

        $checker_comment_previous_b = $prev_comments["checker_comment_b"];
        if($checker_comment_b === null) {
            if($checker_comment_previous_b === null)
            $checker_comment_b = "上記の人にインタビューを実施し、理解できたことを確認できました。";
            else {
            $checker_comment_b = $checker_comment_previous_b;
            }
        }

        $checker_comment_previous_c = $prev_comments["checker_comment_c"];
        if($checker_comment_c === null) {
            if($checker_comment_previous_c === null)
            $checker_comment_c = "上記の人にインタビューを実施し、理解できたことを確認できました。";
            else {
            $checker_comment_c = $checker_comment_previous_c;
            }
        }

        $checker_comment_previous_d = $prev_comments["checker_comment_d"];
        if($checker_comment_d === null) {
            if($checker_comment_previous_d === null)
            $checker_comment_d = "上記の人にインタビューを実施し、理解できたことを確認できました。";
            else {
            $checker_comment_d = $checker_comment_previous_d;
            }
        }        
    }


    $stmt_previous_comments->closeCursor();
    //CATEGORY

    $query = "SELECT category.category_id, category_name FROM category
    
    INNER JOIN category_ref on
        category_ref.category_id = category.category_id
        
    WHERE training_id = :training_id";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":training_id", $training_id);
    $stmt->execute();
    $result_cat = $stmt->fetchAll();

    $category_array = array ();

    foreach ($result_cat as $categories) {
        $category_array[] = $categories["category_id"];
    }

    $stmt->closeCursor();
} 