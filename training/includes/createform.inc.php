<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

            //check if open training
            
            $open_training;

            if(isset($_POST["open-training"])) {
                $open_training = "1";
            }

            else { 
                $open_training = "";
            }

            $file_size_get = '';
            $file_type_get = '';

            $process_prefix = ($_POST["process_prefix"]);
            $creation_department = $_SESSION["department"];
            $training_name = ($_POST["training_name"]);
            $training_area = ($_POST["training_area"]);

            //PDF file date

            $year = date("Y");
            $month = date("m");
            $date = date("d");

            $pdf_file_date = $year . $month . $date;
            //date regular

            /*$start_time_regular = ($_POST["datetime_regular_start"]);
            $end_time_regular = ($_POST["datetime_regular_end"]);
            $instructor_regular = ($_POST["instructor_regular"]);
            $location_regular = ($_POST["location_regular"]);*/

            //date regular
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
            /***************/
            $term = $_POST["term"];
            $purpose = ($_POST["purpose"]);
            $audience = ($_POST["audience"]);
            $contents = ($_POST["contents"]);
            $usageid = ($_POST["usage_"]);
            //$usageid = preg_replace('#\s+#',', ',trim($usageid));
            $statusid = '1';
            $creator = $_SESSION["GID"];
            $confirmation_by = ($_POST["confirmation_by"]);
            $confirmation_date = ($_POST["confirmation_date"]); 
            $count_value = ($_POST["count_value"]);
              
            $category_others = '';
            if(isset($_POST["category_others"])) {
            $category_others = $_POST["category_others"];}

            $category_others_manual = '';
            if(isset($_POST["category_others_manual"])) {
            $category_others_manual = $_POST["category_others_manual"];}

            $categories = ($_POST["category"]);

            //attendance table

            $checked_array = ($_POST["GIDcheck"]);
            $GIDname = ($_POST["GIDname"]);
            $firstname = ($_POST["name_"]);
            $department_attendee = ($_POST["department_name"]);

            //
            try {
                require_once "dbh2.inc.php";

                //Create Form query

                $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);

                $query ="INSERT INTO training_form (
                    creator,
                    process_prefix,
                    creation_department,
                    training_name,
                    area,
                    term,
                    start_time_regular,
                    end_time_regular,
                    location_regular,
                    instructor_regular,
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
                    purpose,
                    audience,
                    contents,
                    usage_id,
                    status_id,
                    confirmation_by,
                    confirmation_date,
                    count_,
                    category_others_manual,
                    pdf_file_date,
                    open_training
                    )

                VALUES (
                    :creator,
                    :process_prefix,
                    :creationdepartment,
                    :trainingname,
                    :area,
                    :term,
                    :start_time_regular,
                    :end_time_regular,
                    :location_regular,
                    :instructor_regular,
                    :start_time_a,
                    :end_time_a,
                    :location_a,
                    :instructor_a,
                    :start_time_b,
                    :end_time_b,
                    :location_b,
                    :instructor_b,
                    :start_time_c,
                    :end_time_c,
                    :location_c,
                    :instructor_c,
                    :start_time_d,
                    :end_time_d,
                    :location_d,
                    :instructor_d, 
                    :purpose,
                    :audience,
                    :contents,
                    :usageid, 
                    :statusid,
                    :confirmation_by,
                    :confirmation_date,
                    :count_value,
                    :category_others_manual,
                    :pdf_file_date,
                    :open_training
                );";
                
                $stmt = $pdo->prepare($query);

                $stmt->bindParam(":creator", $creator);
                $stmt->bindParam(":process_prefix", $process_prefix);
                $stmt->bindParam(":creationdepartment", $creation_department);
                $stmt->bindParam(":trainingname", $training_name);
                $stmt->bindParam(":area", $training_area);
                $stmt->bindParam(":term", $term);
                $stmt->bindParam(":pdf_file_date", $pdf_file_date);
                $stmt->bindParam(":open_training", $open_training);
                /*$stmt->bindParam(":start_time_regular", $start_time_regular);
                $stmt->bindParam(":end_time_regular", $end_time_regular);*/
               

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

                $stmt->bindParam(":location_regular",  $location_regular);
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
                $stmt->bindParam(":purpose", $purpose);
                $stmt->bindParam(":audience", $audience);
                $stmt->bindParam(":contents", $contents);
                $stmt->bindParam(":usageid", $usageid);  
                $stmt->bindParam(":statusid", $statusid);
                $stmt->bindParam(":confirmation_by", $confirmation_by); 
                $stmt->bindParam(":confirmation_date", $confirmation_date);
                $stmt->bindParam(":count_value", $count_value);
                $stmt->bindParam(":category_others_manual", $category_others_manual);

                $stmt->execute(); 

                $query1a ="SELECT * FROM training_form 
                    ORDER BY 
                        date_created 
                    DESC LIMIT 1";

                $stmt1a = $pdo->prepare($query1a);
                $stmt1a->execute();
                $result = $stmt1a->fetchAll();
                foreach($result as $row)
                {
                    $training_id=$row["training_id"];
                }
                
                /*$query2 = "INSERT INTO attendance (GIDh,name_,training_id,affiliation,sign_progress,judgement) 
                VALUES (:GID,:firstname,:training_id,:department_name,:sign_progress,:judgement);";

                $stmt2 = $pdo->prepare($query2);

                $sign_progress = "1";
                $judgement = "1";
                
                foreach ($GIDname as $key => $value) {

                    if(in_array($GIDname[$key], $checked_array)){
                    $stmt2->bindParam(":GID", $GIDname[$key]);
                    $stmt2->bindParam(":firstname", $firstname[$key]);
                    $stmt2->bindParam(":training_id", $training_id);
                    $stmt2->bindParam(":sign_progress",$sign_progress); 
                    $stmt2->bindParam(":department_name", $department_attendee[$key]);
                    $stmt2->bindParam(":judgement", $judgement);                         
                    $stmt2->execute();
                    }      
                } */

                if($open_training === "1") {



                }

                else {

                    //attendance table

                    foreach ($checked_array as $GID_checked) {
                        
                        $query_users_selected = "SELECT * FROM users
                        where 
                            GID = :GID
                        ";

                        $stmt_users_selected = $pdo->prepare($query_users_selected);
                        $stmt_users_selected->bindParam(":GID", $GID_checked);
                        $stmt_users_selected->execute();    

                        $users_selected_result = $stmt_users_selected->fetchAll();

                        foreach($users_selected_result as $GID_data) {

                            $query_attendance = "INSERT INTO attendance (
                                GIDh,
                                name_,
                                training_id,
                                affiliation,
                                sign_progress,
                                judgement
                                )

                                VALUES (
                                :GID,
                                :name_,
                                :training_id,
                                :department_id,
                                :sign_progress,
                                :judgement
                                )

                            ";

                            $sign_progress = "1";
                            $judgement = "1";

                            $stmt2 = $pdo->prepare($query_attendance);
                            $stmt2->bindParam(":GID", $GID_data["GID"]);
                            $stmt2->bindParam(":name_", $GID_data["name_"]);
                            $stmt2->bindParam(":training_id", $training_id);
                            $stmt2->bindParam(":department_id", $GID_data["department_id"]);
                            $stmt2->bindParam(":sign_progress", $sign_progress);
                            $stmt2->bindParam(":judgement", $judgement);
                            $stmt2->execute();
                        }
                    }


                }

                
                /*
                
                $query3= "UPDATE attendance 
                INNER JOIN 
                    users ON attendance.GIDh = users.GID
                SET 
                    attendance.RFID = users.RFID
                ";

                $stmt3 = $pdo->prepare($query3);
                $stmt3->execute();

               */

                //Upload File 

                $allowed = array('jpg','jpeg','png','pdf','xlsx','docs','xls','docx','ppt','pptx','csv', 'doc', 'mp4', 'mp3');
                $file_name_checking = $_FILES['file']['name'];
                $file_size_checking = $_FILES['file']['size'];

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

                if($file_name_check_ext === true) {
                    if(max($file_size_checking) < 20971520) {

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
                            $stmt4->bindParam(":training_id", $training_id);
                            $stmt4->bindParam(":uploaded_by", $creator);
                            $stmt4->bindParam(":file_path", $file_path);
                            //$stmt4->bindParam(":file_unique_name", $file_name_new);

                            $stmt4->execute();

                            unlink($file_destination_01);

                        }
                    } 
                    else {      
                        $file_size_get = "?error=large_file";
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

                //copy material
                
                if(isset($_POST["file_id"])) {
                    $copied_materials = $_POST["file_id"];
                    
                    foreach($copied_materials as $reference_file) {
                        $query ="INSERT into file_storage 
                        (
                            training_id,
                            file_name, 
                            file_ext, 
                            file_size, 
                            file_type, 
                            uploaded_by, 
                            file_path, 
                            file_path_main_directory)
                        SELECT
                            :training_id,
                            file_name, 
                            file_ext, 
                            file_size, 
                            file_type, 
                            uploaded_by, 
                            file_path, 
                            file_path_main_directory from file_storage
                        where file_id = :file_id"; 

                        $stmt = $pdo->prepare($query);
                        $stmt->bindParam(":training_id", $training_id);
                        $stmt->bindParam(":file_id", $reference_file);

                        $stmt->execute();

                    } 

                }

                //UPLOAD FILE END 
                //CATEGORY TABLE 

              

                foreach ($categories as $category_id) {
                    $query5 = "INSERT INTO category (category_id, category_others_name, training_id)
                          VALUES(
                            :category_id,
                            :category_others_name,
                            :training_id
                          )";
                    
                    $stmt5=$pdo->prepare($query5);
                    $stmt5->bindParam(":category_id", $category_id);
                    $stmt5->bindParam(":category_others_name", $category_others_manual);
                    $stmt5->bindParam(":training_id", $training_id);

                    $stmt5->execute();
                }

                //get category names for pdf file name;

                $category_full = "";
                
                foreach($categories as $category_id) {

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

                //get pdf_file_name

                $pdf_file_name = $training_id . "_" . $pdf_file_date . "_" . $training_name;

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


                //var file_name_try = training_id.concat("_",date_file_name,"_",training_name,"(",cat_q,cat_en,cat_sh,cat_o,cat_name,")"); 

                $pdo = null;
                $stmt = null;
                $stmt1a = null;
                $stmt2= null;
                $stmt3= null;
                $stmt4= null;
                header("Location: ../progress_test.php?success_created=$training_id&$file_type_get");

                
                die();

            } catch (PDOException $e) {
                die("Query failed: " . $e->getMessage());

            }
      
}

   

else {
    header("Location: ../progress.php");
}

