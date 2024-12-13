<?php

session_start();

require_once "dbh2.inc.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $training_id = $_SESSION["training_id"];
    $process_prefix = $_POST["process_prefix"];
    $process_suffix = $_POST["process_suffix"];
    $creationdepartment = $_SESSION["department"];
    $trainingname = ($_POST["educationID"]);
    $trainingloc = ($_POST["trainingLoc"]);
    $term = $_POST["term"];
    $confirmation_date = $_POST["confirmation_date"];

    //date team regular
    if($_POST["datetime_regular_start"] !== '') {
        $start_time_regular = ($_POST["datetime_regular_start"]);
    }
    else {
        $start_time_regular = null;
    }
    if($_POST["datetime_regular_end"] !== '') {
        $end_time_regular = ($_POST["datetime_regular_end"]);
    }
        else {
        $end_time_regular = null;
    }
    $location_regular = "";
    if(isset($_POST["location_regular"])) {
        $location_regular = $_POST["location_regular"];
    }
    $instructor_regular = "";
    if(isset($_POST["instructor_regular"]))
    {
        $instructor_regular = ($_POST["instructor_regular"]);
    }

    //date team A
     if($_POST["datetime_a_start"] !== '') {
        $start_time_a = ($_POST["datetime_a_start"]);
    }
    else {
        $start_time_a = null;
    }
    if($_POST["datetime_a_end"] !== '') {
        $end_time_a = ($_POST["datetime_a_end"]);
    }
        else {
        $end_time_a = null;
    }
    $location_a = "";
    if(isset($_POST["location_a"])) {
        $location_a = $_POST["location_a"];
    }
    $instructor_a = "";
    if(isset($_POST["instructor_a"]))
    {
        $instructor_a = ($_POST["instructor_a"]);
    }
    //date team B
    if($_POST["datetime_b_start"] !== '') {
        $start_time_b = ($_POST["datetime_b_start"]);
    }
    else {
        $start_time_b = null;
    }
    if($_POST["datetime_b_end"] !== '') {
        $end_time_b = ($_POST["datetime_b_end"]);
    }
        else {
        $end_time_b = null;
    }
    $location_b = "";
    if(isset($_POST["location_b"])) {
        $location_b = $_POST["location_b"];
    }
    $instructor_b = "";
    if(isset($_POST["instructor_b"]))
    {
        $instructor_b = ($_POST["instructor_b"]);
    }
    
    //date team C
    if($_POST["datetime_c_start"] !== '') {
        $start_time_c = ($_POST["datetime_c_start"]);
    }
    else {
        $start_time_c = null;
    }
    if($_POST["datetime_c_end"] !== '') {
        $end_time_c = ($_POST["datetime_c_end"]);
    }
        else {
        $end_time_c = null;
    }
    $location_c = "";
    if(isset($_POST["location_c"])) {
        $location_c = $_POST["location_c"];
    }
    $instructor_c = "";
    if(isset($_POST["instructor_c"]))
    {
        $instructor_c = ($_POST["instructor_c"]);
    }
    //date team D
    
    if($_POST["datetime_d_start"] !== '') {
        $start_time_d = ($_POST["datetime_d_start"]);
    }
    else {
        $start_time_d = null;
    }

    if($_POST["datetime_d_end"] !== '') {
        $end_time_d = ($_POST["datetime_d_end"]);
    }
        else {
        $end_time_d = null;
    }
    $location_d = "";
    if(isset($_POST["location_d"])) {
        $location_d = $_POST["location_d"];
    }
    $instructor_d = "";
    if(isset($_POST["instructor_d"]))
    {
        $instructor_d = ($_POST["instructor_d"]);
    }    

    //
   
    if(isset($_POST["category_quality"])) {
    $category_quality = ($_POST["category_quality"]); }
 
    if(isset($_POST["category_environment"])) {
    $category_environment = ($_POST["category_environment"]);}
    
    if(isset($_POST["category_safety_and_hygiene"])) {
    $category_safety_and_hygiene = $_POST["category_safety_and_hygiene"];}
 
    if(isset($_POST["category_others"])) {
    $category_others = $_POST["category_others"];}

    $category_others_manual='';
    if(isset($_POST["category_others_manual"])) {
    $category_others_manual = $_POST["category_others_manual"];}

    $purpose = ($_POST["purposeID"]);
    $audience = ($_POST["audienceID"]);
    $contents = ($_POST["contentsID"]);
    $usageid = ($_POST["usageID"]); 
    $statusid = '1';
    $creator = $_SESSION["GID"];
    $count_value = $_POST["count_value_input"];
    
    //Checker Regular
    if(isset($_POST["checker_comment_regular"])) {
        $checker_comment_regular =$_POST["checker_comment_regular"];
    }
    
    $confirmation_by = ($_POST["confirmation_by"]);

    if($_POST["checker_date_regular"] !== '') {
        $checker_date_regular = ($_POST["checker_date_regular"]);
    }
   
    //Checker A

    if(isset($_POST["checker_comment_a"])) {
        $checker_comment_a =$_POST["checker_comment_a"];
    }

    if($_POST["checker_date_a"] !== '') {
        $checker_date_a = ($_POST["checker_date_a"]);
    }
    
    //Checker B

    if(isset($_POST["checker_comment_b"])) {
        $checker_comment_b =$_POST["checker_comment_b"];
    }

    if($_POST["checker_date_b"] !== '') {
        $checker_date_b = ($_POST["checker_date_b"]);
    }

    
    //Checker C

    if(isset($_POST["checker_comment_c"])) {
        $checker_comment_c =$_POST["checker_comment_c"];
    }

    if($_POST["checker_date_c"] !== '') {
        $checker_date_c = ($_POST["checker_date_c"]);
    }

    //Checker D

    if(isset($_POST["checker_comment_d"])) {
        $checker_comment_d =$_POST["checker_comment_d"];
    }

    if($_POST["checker_date_d"] !== '') {
        $checker_date_d = ($_POST["checker_date_d"]);
    }


    $training_id_temp = $process_prefix . $process_suffix;
   
    // Check for duplicate training id

    $query_training_id_checker = "SELECT training_id FROM training_form";
    $stmt_checker = $pdo->prepare($query_training_id_checker);
    $stmt_checker->execute();
    $result_training_id = $stmt_checker->fetchAll();

    $training_id_list = array();

    foreach($result_training_id as $result_training_id_list) {
        $training_id_list[] = $result_training_id_list["training_id"];
    }

    $training_id_list_new = array_diff($training_id_list, [$training_id]);

    switch($training_id_temp) {
        case((in_array($training_id_temp, $training_id_list_new))): 
            header("location: ../editform_test.php?training_id=$training_id&error=training_id_duplicate");
            break;   
    
        case((!in_array($training_id_temp, $training_id_list_new))):
            //if (!in_array($training_id_temp, $training_id_list_new)) { 

        try {
            
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);
            $query ="UPDATE training_form          
                SET 
                    training_name = :training_name,
                    area = :area,
                    term = :term,
                    start_time_regular = :start_time_regular,
                    end_time_regular = :end_time_regular,
                    location_regular = :location_regular,
                    instructor_regular = :instructor_regular,
                    start_time_a = :start_time_a,
                    end_time_a = :end_time_a,
                    location_a = :location_a,
                    instructor_a = :instructor_a,
                    start_time_b = :start_time_b,
                    end_time_b = :end_time_b,
                    location_b = :location_b,
                    instructor_b = :instructor_b,
                    start_time_c = :start_time_c,
                    end_time_c = :end_time_c,
                    location_c = :location_c,
                    instructor_c = :instructor_c,
                    start_time_d = :start_time_d,
                    end_time_d = :end_time_d,
                    location_d = :location_d,
                    instructor_d = :instructor_d,
                    category_quality = :category_quality,
                    category_environment = :category_environment,
                    category_safety_and_hygiene = :category_safety_and_hygiene,
                    category_others = :category_others,
                    category_others_manual = category_others_manual,
                    purpose = :purpose,
                    audience = :audience, 
                    usage_id = :usage_id,
                    contents = :contents,
                    process_suffix = :process_suffix,
                    count_ = :count_value,
                    checker_comment_regular = :checker_comment_regular,
                    checker_date_regular = :checker_date_regular,
                    checker_comment_a = :checker_comment_a,
                    checker_date_a = :checker_date_a,
                    checker_comment_b = :checker_comment_b,
                    checker_date_b = :checker_date_b,
                    checker_comment_c = :checker_comment_c,
                    checker_date_c = :checker_date_c,
                    checker_comment_d = :checker_comment_d,
                    checker_date_d = :checker_date_d,
                    confirmation_by = :confirmation_by,
                    modified_date = now(),
                    modified_by = :user_,
                    confirmation_date = :confirmation_date
                
                WHERE
                    training_id = :training_id;
                
                UPDATE attendance
                
                SET
                    training_id = concat(:process_prefix, :process_suffix)
                
                WHERE
                    training_id = :training_id;   
                ";

            $stmt = $pdo->prepare($query);

            $stmt->bindParam(":training_id", $training_id);
            $stmt->bindParam(":process_prefix", $process_prefix);
            $stmt->bindParam(":process_suffix", $process_suffix);
            $stmt->bindParam(":training_name", $trainingname);
            $stmt->bindParam(":term", $term);
            $stmt->bindParam(":area", $trainingloc);
            $stmt->bindParam(":user_", $_SESSION["GID"]);
            $stmt->bindParam(":confirmation_date", $confirmation_date);

            //$stmt->bindParam(":start_time_regular", $start_time_regular);
            //$stmt->bindParam(":end_time_regular", $end_time_regular);
            //$stmt->bindParam(":location_regular",  $location_regular);
            //$stmt->bindParam(":instructor_regular", $instructor_regular);
            //
            if($start_time_regular === null) {
                $stmt->bindParam(":start_time_regular", $start_time_regular, PDO::PARAM_NULL); 
            } else{
                $stmt->bindParam(":start_time_regular", $start_time_regular);
            } 
        
            if($end_time_regular === null) {
                $stmt->bindParam(":end_time_regular", $end_time_regular, PDO::PARAM_NULL); }
            else {
                $stmt->bindParam(":end_time_regular", $end_time_regular);
            }
            
            $stmt->bindParam(":location_regular", $location_regular);
            $stmt->bindParam(":instructor_regular", $instructor_regular);
            //
         
            if($start_time_a === null) {
                $stmt->bindParam(":start_time_a", $start_time_a, PDO::PARAM_NULL); 
            } else{
                $stmt->bindParam(":start_time_a", $start_time_a);
            } 
        
            if($end_time_a === null) {
                $stmt->bindParam(":end_time_a", $end_time_a, PDO::PARAM_NULL); }
            else {
                $stmt->bindParam(":end_time_a", $end_time_a);
            }
            
            $stmt->bindParam(":location_a", $location_a);
            $stmt->bindParam(":instructor_a", $instructor_a);

            if($start_time_b === null) {
                $stmt->bindParam(":start_time_b", $start_time_b, PDO::PARAM_NULL); 
            } else{
                $stmt->bindParam(":start_time_b", $start_time_b);
            } 
        
            if($end_time_b === null) {
                $stmt->bindParam(":end_time_b", $end_time_b, PDO::PARAM_NULL); }
            else {
                $stmt->bindParam(":end_time_b", $end_time_b);
            }

            $stmt->bindParam(":location_b", $location_b);
            $stmt->bindParam(":instructor_b", $instructor_b);

            if($start_time_c === null) {
                $stmt->bindParam(":start_time_c", $start_time_c, PDO::PARAM_NULL); 
            } else{
                $stmt->bindParam(":start_time_c", $start_time_c);
            } 
        
            if($end_time_c === null) {
                $stmt->bindParam(":end_time_c", $end_time_c, PDO::PARAM_NULL); }
            else {
                $stmt->bindParam(":end_time_c", $end_time_c);
            }

            $stmt->bindParam(":location_c", $location_c);
            $stmt->bindParam(":instructor_c", $instructor_c);

            if($start_time_d === null) {
                $stmt->bindParam(":start_time_d", $start_time_d, PDO::PARAM_NULL); 
            } else{
                $stmt->bindParam(":start_time_d", $start_time_d);
            } 
        
            if($end_time_d === null) {
                $stmt->bindParam(":end_time_d", $end_time_d, PDO::PARAM_NULL); }
            else {
                $stmt->bindParam(":end_time_d", $end_time_d);
            }

            $stmt->bindParam(":location_d", $location_d);
            $stmt->bindParam(":instructor_d", $instructor_d); 
            $stmt->bindParam(":category_quality", $category_quality);
            $stmt->bindParam(":category_environment", $category_environment);
            $stmt->bindParam(":category_safety_and_hygiene", $category_safety_and_hygiene);
            $stmt->bindParam(":category_others", $category_others);
            $stmt->bindParam(":category_others_manual", $category_others_manual);
            $stmt->bindParam(":purpose", $purpose);
            $stmt->bindParam(":audience", $audience);
            $stmt->bindParam(":contents", $contents);
            $stmt->bindParam(":usage_id", $usageid);
            $stmt->bindParam(":count_value", $count_value);
            $stmt->bindParam(":confirmation_by", $confirmation_by);
            $stmt->bindParam(":checker_comment_regular", $checker_comment_regular);    
            $stmt->bindParam(":checker_date_regular", $checker_date_regular);
            $stmt->bindParam(":checker_comment_a", $checker_comment_a);    
            $stmt->bindParam(":checker_date_a", $checker_date_a);
            $stmt->bindParam(":checker_comment_b", $checker_comment_b);    
            $stmt->bindParam(":checker_date_b", $checker_date_b);
            $stmt->bindParam(":checker_comment_c", $checker_comment_c);    
            $stmt->bindParam(":checker_date_c", $checker_date_c);
            $stmt->bindParam(":checker_comment_d", $checker_comment_d);    
            $stmt->bindParam(":checker_date_d", $checker_date_d);
                   
            $stmt->execute();
            $stmt->closeCursor();

            //attendance table

            $training_id_new = $process_prefix . $process_suffix;

            $GIDname = ($_POST["GIDname"]);
            $attendance = ($_POST["attendance"]);

            //Set Judgement if ONLY judgement checkbox is checked

            if(isset($_POST["judgement"])) {
                
                $judgement = $_POST["judgement"];
           
                $query_judgement = "UPDATE attendance 
                            SET 
                                judgement = :judgement
                            WHERE 
                                GIDh = :GID
                            AND
                                training_id = :training_id
                ";

                $stmt_judgement = $pdo->prepare($query_judgement);
                
                foreach ($GIDname as $key => $value) {
                
                $stmt_judgement->bindParam(":training_id", $training_id_new);
                $stmt_judgement->bindParam(":GID", $GIDname[$key]);
                $stmt_judgement->bindParam(":judgement", $judgement[$key]);
                $stmt_judgement->execute();

                }
                
            }

            //Update attendance status

            $query2= "UPDATE attendance 
                SET 
                    attendance = :attendance
                WHERE 
                    GIDh = :GID
                AND
                    training_id = :training_id
                 ";

            $stmt2 = $pdo->prepare($query2);

            foreach ($GIDname as $key => $value) {

                $stmt2->bindParam(":GID", $GIDname[$key]);     
                $stmt2->bindParam(":attendance", $attendance[$key]);
                $stmt2->bindParam(":training_id", $training_id_new);
                $stmt2->execute();
                
            } 

            $stmt2->closeCursor(); 
            
            //checker comments

            $query_03 = "SELECT * FROM training_form where training_id = '$training_id_new'";
            
            $stmt3 = $pdo->prepare($query_03);
            $stmt3->execute();

            $result = $stmt3->fetchAll();

            $status_id='';
            $confirmation_date_regular_check = '';
            $confirmation_comment_regular_check = '';
            foreach ($result as $result_status_id) {
                $status_id = $result_status_id["status_id"];
                $confirmation_date_regular_check = $result_status_id["checker_date_regular"];
                $confirmation_comment_regular_check = $result_status_id["checker_comment_regular"];
                //$confirmation_people_regular_check = $result_status_id["checker_people_regular"];
            }

            $stmt3->closeCursor();



            /******* */

            $query5 = "DELETE FROM category where training_id = '$training_id'
            ";
            $stmt5 = $pdo->prepare($query5);
            $stmt5->execute();

            $new_category = array();
            $new_category = ($_POST["category"]);

            $training_id_new = $process_prefix . $process_suffix;

            foreach ($new_category as $category_id) {
                $query5 = "INSERT INTO category (category_id, category_others_name, training_id)
                      VALUES(
                        :category_id,
                        :category_others_name,
                        :training_id
                      )
                      ";
                
                $stmt5=$pdo->prepare($query5);
                $stmt5->bindParam(":category_id", $category_id);
                $stmt5->bindParam(":category_others_name", $category_others_manual);
                $stmt5->bindParam(":training_id", $training_id_new);

                $stmt5->execute();
            }

               //get category names for pdf file name;

               $category_full = "";
                
               foreach($new_category as $category_id) {

                   $query_cat_name = "SELECT category_name FROM category_ref
                   WHERE
                       category_id = :category_id
                   ";

                   $stmt_cat_name = $pdo->prepare($query_cat_name);
                   $stmt_cat_name->bindParam(":category_id", $category_id);
                   $stmt_cat_name->execute();

                   $result = $stmt_cat_name->fetchAll();
               
                   foreach($result as $row) {
                       $category_full .= $row["category_name"];
                   }

               }

               //get pdf_file_date

                $pdf_file_date = "";
                $query_file_name = "SELECT pdf_file_date FROM training_form
                WHERE
                    training_id = :training_id
                ";

                $stmt_get_file_name = $pdo->prepare($query_file_name);
                $stmt_get_file_name->bindParam(":training_id", $training_id_new);
                $stmt_get_file_name->execute();
               
                $result_pdf_file_name = $stmt_get_file_name->fetchAll();

                foreach($result_pdf_file_name as $row) {
                    $pdf_file_date = $row["pdf_file_date"];
                }

                $pdf_file_name = $training_id . "_" . $pdf_file_date . "_" . $trainingname;

               //update pdf_file_name

                $query_pdf_file_name = "UPDATE training_form
                    SET
                       pdf_file_name = :pdf_file_name
                    WHERE
                       training_id = :training_id
               ";

               $stmt_file_name = $pdo->prepare($query_pdf_file_name);
               $stmt_file_name->bindParam(":pdf_file_name", $pdf_file_name);
               $stmt_file_name->bindParam(":training_id", $training_id);
               $stmt_file_name->execute();


            /*******INTERVIEWS *********/ 
            
            //Regular
            if(isset($_POST["participants_regular"])) {

                $checker_people_interviewee = ($_POST["participants_regular"]);
                $checker_people_regular = '';
                foreach($checker_people_interviewee as $interviewee_regular) {
            
                $query_interviewee = "UPDATE attendance 
                    SET interviewee = 2
                    WHERE training_id = :training_id
                    AND GIDh = :interviewee_regular";
    
                    $stmt_interviewee_regular = $pdo->prepare($query_interviewee);
                    $stmt_interviewee_regular->bindParam(":interviewee_regular", $interviewee_regular);
                    $stmt_interviewee_regular->bindParam(":training_id", $training_id_new);
                  
                    $stmt_interviewee_regular->execute();
                }
                    
            }

            //Team A

            if(isset($_POST["participants_a"])) {

                $checker_people_interviewee = ($_POST["participants_a"]);
                //$checker_people_a = '';
                foreach($checker_people_interviewee as $interviewee_a) {
            
                $query_interviewee = "UPDATE attendance 
                    SET interviewee = 2
                    WHERE training_id = :training_id
                    AND GIDh = :interviewee_a";
    
                    $stmt_interviewee_a = $pdo->prepare($query_interviewee);
                    $stmt_interviewee_a->bindParam(":interviewee_a", $interviewee_a);
                    $stmt_interviewee_a->bindParam(":training_id", $training_id_new);
                    $stmt_interviewee_a->execute();
                }
                    
            }

             //Team B

             if(isset($_POST["participants_b"])) {

                $checker_people_interviewee = ($_POST["participants_b"]);
                //$checker_people_a = '';
                foreach($checker_people_interviewee as $interviewee_b) {
            
                $query_interviewee = "UPDATE attendance 
                    SET interviewee = 2
                    WHERE training_id = :training_id
                    AND GIDh = :interviewee_b";
    
                    $stmt_interviewee_b = $pdo->prepare($query_interviewee);
                    $stmt_interviewee_b->bindParam(":interviewee_b", $interviewee_b);
                    $stmt_interviewee_b->bindParam(":training_id", $training_id_new);
                    $stmt_interviewee_b->execute();
                }
                    
            }

              //Team C

              if(isset($_POST["participants_c"])) {

                $checker_people_interviewee = ($_POST["participants_c"]);
                //$checker_people_a = '';
                foreach($checker_people_interviewee as $interviewee_c) {
            
                $query_interviewee = "UPDATE attendance 
                    SET interviewee = 2
                    WHERE training_id = :training_id
                    AND GIDh = :interviewee_c";
    
                    $stmt_interviewee_c = $pdo->prepare($query_interviewee);
                    $stmt_interviewee_c->bindParam(":interviewee_c", $interviewee_c);
                    $stmt_interviewee_c->bindParam(":training_id", $training_id_new);
                    $stmt_interviewee_c->execute();
                }
                    
            }

            //Team D

              if(isset($_POST["participants_d"])) {

                $checker_people_interviewee = ($_POST["participants_d"]);
                //$checker_people_a = '';
                foreach($checker_people_interviewee as $interviewee_d) {
            
                $query_interviewee = "UPDATE attendance 
                    SET interviewee = 2
                    WHERE training_id = :training_id
                    AND GIDh = :interviewee_d";
    
                    $stmt_interviewee_d = $pdo->prepare($query_interviewee);
                    $stmt_interviewee_d->bindParam(":interviewee_d", $interviewee_d);
                    $stmt_interviewee_d->bindParam(":training_id", $training_id_new);
                    $stmt_interviewee_d->execute();
                }
                    
            }

            //Check if Attendance is already complete

            $query_check_attendance = "SELECT * FROM attendance
            WHERE
                training_id = :training_id
            AND
                attendance = '1'
            ";
    
            $stmt_check_attendance = $pdo->prepare($query_check_attendance);
            $stmt_check_attendance->bindParam(":training_id",$training_id_new);
            $stmt_check_attendance->execute();
            $result_check_attendance = $stmt_check_attendance->fetchAll();
    
            $attendance_check = array();
    
            foreach ($result_check_attendance as $attendance) {
                $attendance_check[] = $attendance["sign_progress"];
            }
            
            if (arrayContainsOnlyZero($attendance_check) === true) {
    
                $query_status_check = "SELECT status_id FROM training_form
                    WHERE training_id = :training_id";
    
                $stmt_status_check = $pdo->prepare($query_status_check);
                $stmt_status_check->bindParam(":training_id", $training_id_new);
                $stmt_status_check->execute();
    
                $result_status_check=$stmt_status_check->fetchAll();
                $status_id = "";
                foreach($result_status_check as $row) {
                    $status_id = $row["status_id"];
                }
    
                if($status_id === '1') {
    
                    $query_update_status = 
                        "UPDATE 
                            training_form
                        SET 
                            status_id = '3'
                        WHERE 
                            training_id = :training_id    
                        "; 
                    
                    $stmt_update_status = $pdo->prepare($query_update_status);
                    $stmt_update_status->bindParam(":training_id", $training_id_new);
                    $stmt_update_status->execute();
                    $stmt_update_status->closeCursor();
    
                }
                     
            } 

            /****CHANGE STATUS From Waiting for Confirmation to Approval ******/
            /*if ($status_id === '3') {
                
                $query_change_stat = "UPDATE training_form
                        SET status_id = '4'
                        where training_id = '$training_id'";
                    
                $stmt4 = $pdo->prepare($query_change_stat);
    
                $stmt4->execute();
            } */
            
            $query_change_stat = "UPDATE training_form
                        SET status_id = '4'
                        where training_id = :training_id";
                    
            $stmt4 = $pdo->prepare($query_change_stat);
            $stmt4->bindParam(":training_id", $training_id);

            switch ($status_id) {
                case($location_regular !== "" && $interviewee_regular === ""):
                    break;
                case($location_a !== "" && $interviewee_a === ""):
                    break;
                case($location_b !== "" && $interviewee_b === ""):
                    break;
                case($location_c !== "" && $interviewee_c === ""):
                    break;
                case($location_d !== "" && $interviewee_d === ""):
                    break;
                case($status_id === '3'):
                    $stmt4->execute();
            }

            

            



              /*****CHANGE the training_id in FILE STORAGE */

              $query_change_training_id = "UPDATE file_storage
              SET 
                  training_id = :training_id_new
              WHERE
                  training_id = :training_id
                ";

            $stmt_change_training_id = $pdo->prepare($query_change_training_id);
            $stmt_change_training_id->bindParam(":training_id_new", $training_id_new);
            $stmt_change_training_id->bindParam(":training_id", $training_id);
            $stmt_change_training_id->execute();

          
            
            /***********UPLOAD FILE ***************/

            if(isset($_FILES["file"])) {
            

                $allowed = array('jpg','jpeg','png','pdf','xlsx','docs','xls','docx','ppt','pptx','csv', 'doc', 'mp4', 'mp3');
                $file_name_checking = $_FILES['file']['name'];
                $file_size_checking = $_FILES['file']['size'];

                //file size total check: 
                $total_size = 0;
                foreach($file_size_checking as $file_size) {
                    $total_size = $total_size + $file_size;
                }

                $file_name_check_actual_ext = array();

                foreach ($file_name_checking as $extension_files) {
                    $extension_actual = explode('.', $extension_files);
                    $file_actual_Ext = strtolower(end($extension_actual));
                    $file_name_check_actual_ext[] = $file_actual_Ext;   
                }

                define('KB', 1024);
                define('MB', 1048576);
                define('GB', 1073741824);
                define('TB', 1099511627776);

                $file_name_check_ext = '';
                $file_name_check_ext = !array_diff($file_name_check_actual_ext, $allowed);

                $_SESSION["test_file"] = $_FILES['file']['name'];

                if($file_name_check_ext === true) {
                    if($total_size < 8388608) {

                        foreach ($_FILES['file']['tmp_name'] as $key => $value) {
                            $file_name = $_FILES['file']['name'][$key];
                            $file_tmp_name = $_FILES['file']['tmp_name'][$key];
                            $file_size = $_FILES['file']['size'][$key];
                            $file_error = $_FILES['file']['error'][$key];
                            $file_type = $_FILES['file']['type'][$key];
                            $file_ext = explode('.', $file_name);
                            $file_name_original = pathinfo($file_name, PATHINFO_FILENAME);
                            $file_actual_Ext = strtolower(end($file_ext));
                            $file_name_new = $file_name_original . "." . $file_actual_Ext; 
                            $file_name_new_destination = $file_name_new . "_" . uniqid(rand(),true);                        
                            $file_destination = 'uploads/'.$file_name_new; 
                            
                            //$file_destination_storage = "D:/smartFactory/DataStore/TrainingMaterials/" . $file_name_new; 
                            //$file_destination_storage = "../try/";
                            //"D:\smartFactory\DataStore\TrainingMaterials\Try"; THIS FILE EXIST!!!!!!!!
                            // file path

                            $date_year = date("Y");
                            $date_month = date("m");
                            $date_day = date("d");

                            $query_files = "SELECT * FROM file_storage_main";
                            $stmt_files = $pdo->prepare($query_files);
                            $stmt_files->execute();
                            $result_files = $stmt_files->fetchAll();

                            $main_directory;

                            foreach ($result_files as $fetch_main_dir) {
                                $main_directory = $fetch_main_dir["main_storage_directory"];
                            }

                            $file_path_year = $main_directory . $date_year;
                            $file_path_month = $main_directory . $date_year . "/" . $date_month;
                            $file_path_day = $main_directory . $date_year . "/" . $date_month . "/" . $date_day;
                            $file_path_process = $main_directory . $date_year . "/" . $date_month . "/" . $date_day . "/" . $process_prefix . "/";
                            $file_path = $date_year . "/" . $date_month . "/" . $date_day . "/" . $process_prefix . "/";

                            switch ($file_path_year) {
                                case(!file_exists($file_path_year)):
                                    mkdir($file_path_year);
                            }

                            switch ($file_path_month) {
                                case(!file_exists($file_path_month)):
                                    mkdir($file_path_month);
                            }

                            switch ($file_path_day) {
                                case(!file_exists($file_path_day)):
                                    mkdir($file_path_day);
                            } 

                            switch ($file_path_process) {
                                case(!file_exists($file_path_process)):
                                    mkdir($file_path_process);
                            } 

                            //file path end
                            //$file_destination_storage = "D:/smartFactory/DataStore/TrainingMaterials/2024/" . $file_name_new;
                            $file_destination_storage = $file_path_process . $file_name_new;
                            $file_destination_01 = $_SERVER["DOCUMENT_ROOT"] . "/Training/includes/uploads/" . $file_name_new;
                            
                            //$file_destination_storage= $_SERVER["DOCUMENT_ROOT"] . "/Training/includes/uploads/copy/" .$file_name_new ;
                            //$file_destination_storage = 'uploads/copy/'.$file_name_new . "_copy";
                            //move_uploaded_file($file_tmp_name, $file_destination);
                            //copy($file_destination, $file_destination_storage);

                            move_uploaded_file($file_tmp_name, $file_destination);
                            
                            copy($file_destination_01, $file_destination_storage);

                            $query4 = "INSERT INTO file_storage (
                                file_name,
                                file_size,
                                file_type,
                                file_ext,
                                training_id,
                                uploaded_by,
                                file_path
                                )
                                VALUES (
                                    :file_name, 
                                    :file_size, 
                                    :file_type,
                                    :file_ext,
                                    :training_id,
                                    :uploaded_by,
                                    :file_path
                                ) 
                            ";

                            $stmt4=$pdo->prepare($query4);
                            $stmt4->bindParam(":file_name", $file_name_original);
                            $stmt4->bindParam(":file_size", $file_size);
                            $stmt4->bindParam(":file_type", $file_type);
                            $stmt4->bindParam(":file_ext", $file_actual_Ext);
                            $stmt4->bindParam(":training_id", $training_id_new);
                            $stmt4->bindParam(":uploaded_by", $creator);
                            $stmt4->bindParam(":file_path", $file_path);
                            //$stmt4->bindParam(":file_unique_name", $file_name_new);

                            $stmt4->execute();

                            unlink($file_destination_01);

                        }
                    } 
                    else {      
                        $file_size_get = "error=large_file";
                    }
                } 
                else {     

                    
                    if(isset($_FILES['file']) ){  


                        foreach($_FILES['file']['tmp_name'] as $key => $tmp_name ){
                        
                              if(!empty($_FILES['file']['tmp_name'][$key])){
                        
                                $file_type_get = "error=file_type";
                            }
                        }
                    
                    }
                  
                } 

            }


            $stmt = null;            
            $pdo = null;
           
            $_SESSION["training_id"] = $process_prefix . $process_suffix;

            /*echo "location regular" . $location_regular;
            echo "interviewee regular" .  $interviewee_regular;
            echo "location_a" .  $location_a;
            echo "interviewee a" .  $interviewee_a;
            echo "location_b" .  $location_b;
            echo "interviewee b" .  $interviewee_b;
            echo "location_c" .  $location_c;
            echo "interviewee c" .  $interviewee_c;
            echo "location_d" .  $location_d;
            echo "interviewee d" .  $interviewee_d;*/
           
            


            //header("Location: update_edit.inc.php");
            header("location: ../editform_test.php?training_id=$training_id_new&success=updated&$file_type_get&$file_size_get");

            //echo $total_size;
            die();

        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        
        }
        
    //}

    //else {
      //  echo "Training ID already exist!";
        //header(("location: ../editform_test.php?training_id=$training_id_new?error=training_id_duplicate"));
    //}
    }

}
else {
    header("Location: ../update_edit.inc.php");
}



function arrayContainsOnlyZero($array) {
    // Filter the array
    $filteredArray = array_filter($array, function($value) {
        return $value !== '2';
    });
    
    // Return boolean if only zero or not. True means all items are 0
    return empty($filteredArray);
}
    
