<?php

session_start();
date_default_timezone_set("Japan");
$date_now = date("Y-m-d H:i:s");



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["auto_focus"] = 1;
    
    if($_POST["rfid"] !== "") {
        $rfid = $_POST["rfid"];
    }

    else {
        $output = "<div class='alert alert-danger alert-dismissible fade show pt-2 pb-2' style='bottom: 45px;' role='alert'>
                        RFIDが登録されていません!
                        <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                        
        echo $output;

        exit();
    }
    $training_id = $_SESSION["document_number"];

    //Check if the training record is open for all

    try {
        require_once "dbh2.inc.php";

        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);

        $query_check_open = "SELECT * FROM training_form
        WHERE
            training_id = :training_id
        ";

        $stmt_check_open = $pdo->prepare($query_check_open);
        $stmt_check_open->bindParam(":training_id", $training_id);
        $stmt_check_open->execute();

        $result_check_open = $stmt_check_open->fetchAll();

        $open_training = "";
        foreach($result_check_open as $row) {
            $open_training = $row["open_training"];
        }
    }

    catch (PDOException $e) {
        die("Query failed: ID card not in database" . $e->getMessage());
    }
   

    //OPEN TRAINING
    
    if($open_training === "1") {

        if(isset($rfid)) {

            try {
                require_once "dbh2.inc.php";
        
                $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);
        
                //Check if RFID is Registered
        
                $query = "SELECT * from users 
                    where RFID = :rfid
                    ";
            
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(":rfid", $rfid);                       
                $stmt->execute();
                $result_query_rfid = $stmt->fetchAll();
                $count_row_rfid = $stmt->rowCount();
        
                if($count_row_rfid < 1) {
                    
                    $output = "<div class='alert alert-danger alert-dismissible fade show pt-2 pb-2' style='bottom: 45px;' role='alert'>
                                    RFIDが登録されていません!
                                <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>";
        
                    echo $output;

                    exit();
                }
        
                else { 
                }
        
                $GID_exist = "";
                $shift_id = "";
                $department_id = "";
                $name_ = "";

                foreach($result_query_rfid as $user_data) {
                    $GID_exist = $user_data["GID"];
                    $_SESSION["checker_GID"] = $GID_exist;
                    $shift_id = $user_data["shift_id"];
                    $department_id = $user_data["department_id"]; 
                    $name_ = $user_data["name_"];
                }
            
                $stmt->closeCursor();

                //Check for Duplicates

                $query_check_duplicates = 
                    "SELECT * FROM attendance
                        WHERE
                            training_id = :training_id
                        AND
                            GIDh = :GID
                ";

                $stmt_check_duplicates=$pdo->prepare($query_check_duplicates);
                $stmt_check_duplicates->bindParam(":training_id", $training_id);
                $stmt_check_duplicates->bindParam(":GID", $GID_exist);
                $stmt_check_duplicates->execute();
                
                $result_duplicate = $stmt_check_duplicates->fetchAll();
                $duplicate = $stmt_check_duplicates->rowCount();

                if($duplicate > 0) {
                    
                    $output = "<div class='alert alert-danger alert-dismissible fade show pt-2 pb-2' style='bottom: 45px;' role='alert'>
                                    DUPLICATE ATTENDANCE!
                                <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>";
        
                    echo $output;

                    exit();
                }

                else {
                    //contine
                }

        
                //UPDATE ATTENDANCE
                
                $query_complete = "INSERT INTO attendance
                    (
                    training_id, 
                    name_, 
                    sign_progress, 
                    GIDh, 
                    date_id, 
                    affiliation, 
                    judgement,
                    attendance
                    )

                    VALUES
                    (
                        :training_id,
                        :name_,
                        '2',
                        :GID,
                        now(),  
                        :department_id,
                        '1',
                        '1'
                    )
                    ";
        
                $stmt_complete = $pdo->prepare($query_complete);
                $stmt_complete->bindParam(":training_id", $training_id);
                $stmt_complete->bindParam(":name_", $name_);
                $stmt_complete->bindParam(":GID", $GID_exist);
                $stmt_complete->bindParam(":department_id", $department_id);
                $stmt_complete->execute();


                //SET status to Waiting for Interviewees
                
                $query_all_complete = 
                    "UPDATE training_form
                        SET 
                            status_id = '3'
                        WHERE 
                            training_id = :training_id
                    "; 
                        
                $stmt_all_complete = $pdo->prepare($query_all_complete);
                $stmt_all_complete->bindParam(":training_id", $training_id);
                $stmt_all_complete->execute();
                $stmt_all_complete->closeCursor();
                    
                 
            
                $pdo = null;
                $stmt = null;
                $stmt_attendance_check = null;
                $stmt_complete = null;
        
                $output = "<div class='alert alert-success alert-dismissible fade show pt-2 pb-2' style='bottom: 45px;' role='alert'>";

                $output .= $GID_exist;

                $output .="の出席完了!
                        <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                        
                echo $output;
                
                

                die();
        
            } catch (PDOException $e) {
                die("Query failed: ID card not in database" . $e->getMessage());
            }
        
            }
        
            else {
                print_r("Invalid ID");
                header("Location: ../attendance.php");
            }

    }

    //REGULAR TRAINING

    else {

        if(isset($rfid)) {

            try {
                require_once "dbh2.inc.php";
        
                $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);
        
                //Check if RFID is Registered
        
                $query = "SELECT * from users 
                    where RFID = :rfid
                    ";
            
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(":rfid", $rfid);                       
                $stmt->execute();
                $result_query_rfid = $stmt->fetchAll();
                $count_row_rfid = $stmt->rowCount();
        
                if($count_row_rfid < 1) {
                    
                    $output = "<div class='alert alert-danger alert-dismissible fade show pt-2 pb-2' style='bottom: 45px;' role='alert'>
                                    RFIDが登録されていません!
                                    <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>";
                        
                    echo $output;

                    exit();

                }
        
                else { 
                }
        
                $GID_exist = "";
                $shift_id = "";
                
                foreach($result_query_rfid as $user_data) {
                    $GID_exist = $user_data["GID"];
                    $_SESSION["checker_GID"] = $GID_exist;
                    $shift_id = $user_data["shift_id"];
                }
            
                $stmt->closeCursor();
        
                //Check if user is in attendance list
        
                $query_attendance_check = "SELECT * FROM attendance 
                    WHERE 
                        GIDh = :GID_check
                    AND
                        training_id = :training_id
                    ";
                
                $stmt_attendance_check = $pdo->prepare($query_attendance_check);
                $stmt_attendance_check->bindParam(":GID_check", $GID_exist);
                $stmt_attendance_check->bindParam(":training_id", $training_id);
                $stmt_attendance_check->execute();
        
                $count_attendance_check = $stmt_attendance_check->rowCount();
                if($count_attendance_check < 1) {
                    
                    $output = "<div class='alert alert-danger alert-dismissible fade show pt-2 pb-2' style='bottom: 45px;' role='alert'>
                                    ユーザーがリストにありません!
                                    <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>";
                        
                    echo $output;

                    exit();


                }
                else {
                }
        
                //Check if the training have already started or not
        
                $query_check_date = "SELECT start_time_a, start_time_b, start_time_c, start_time_d, start_time_regular FROM training_form
                    WHERE
                        training_id = :training_id
                    
                    ";
        
                if($shift_id === "1") {
                    $query_check_date .= "AND start_time_a < :date_now
                        ";
                }
        
                else if($shift_id ==="2") {
                    $query_check_date .= "AND start_time_b < :date_now
                        ";
                }
        
                else if($shift_id ==="3") {
                    $query_check_date .= "AND start_time_c < :date_now
                        ";
                }
        
                else if($shift_id ==="4") {
                    $query_check_date .= "AND start_time_d < :date_now
                        ";
                }
        
                else if($shift_id ==="5") {
                    $query_check_date .= "AND start_time_regular < :date_now
                        ";
                }
             
                $stmt_query_check_date = $pdo->prepare($query_check_date);
                $stmt_query_check_date->bindParam(":date_now",$date_now);
                $stmt_query_check_date->bindParam(":training_id",$training_id);
                $stmt_query_check_date->execute();
        
                $count_check_date = $stmt_query_check_date->rowCount();
                if($count_check_date < 1) {

                    $output = "<div class='alert alert-danger alert-dismissible fade show pt-2 pb-2' style='bottom: 45px;' role='alert'>
                                    ユーザーがリストにありません!
                                    <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>";
                        
                    echo $output;

                    exit();
                }
        
                //UPDATE ATTENDANCE
        
                $query_complete = "UPDATE attendance
                    SET
                        sign_progress = '2',
                        date_id = now()
                    WHERE 
                        GIDh = :GID_sign
                    AND 
                        training_id = :training_id
                    ";
        
                $stmt_complete = $pdo->prepare($query_complete);
                $stmt_complete->bindParam(":training_id", $training_id);
                $stmt_complete->bindParam(":GID_sign", $GID_exist);
                $stmt_complete->execute();
                
                //Check if the attendance is complete
                
                $query_attendance_complete = "SELECT * FROM attendance
                        WHERE
                            training_id = :training_id
                        AND
                            attendance = '1'
                    ";
        
                $stmt_attendance_complete = $pdo->prepare($query_attendance_complete);
                $stmt_attendance_complete->bindParam(":training_id",$training_id);
                $stmt_attendance_complete->execute();
                $result_attendance_complete=$stmt_attendance_complete->fetchAll();
                $attendance_check = array();
        
                foreach ($result_attendance_complete as $attendance) {
                    $attendance_check[] = $attendance["sign_progress"];
                }
        
                if (arrayContainsOnlyZero($attendance_check) === true) {
                    
                    $query_status_check = "SELECT status_id 
                        FROM 
                            training_form
                        WHERE 
                            training_id = :training_id";
        
                    $stmt_status_check = $pdo->prepare($query_status_check);
                    $stmt_status_check->bindParam(":training_id", $training_id);
                    $stmt_status_check->execute();
        
                    $result_status_check=$stmt_status_check->fetchAll();
                    $status_id = "";
                    foreach($result_status_check as $row) {
                        $status_id = $row["status_id"];
                    }
        
                    if($status_id === '1') {
                        $query_all_complete = "UPDATE training_form
                            SET 
                                status_id = '3'
                            WHERE 
                                training_id = :training_id
                        "; 
                        
                        $stmt_all_complete = $pdo->prepare($query_all_complete);
                        $stmt_all_complete->bindParam(":training_id", $training_id);
                        $stmt_all_complete->execute();
                        $stmt_all_complete->closeCursor();
                    }
                } 
            
                $pdo = null;
                $stmt = null;
                $stmt_attendance_check = null;
                $stmt_complete = null;

                
                $output = "<div class='alert alert-success alert-dismissible fade show pt-2 pb-2' style='bottom: 45px;' role='alert'>";

                $output .= $GID_exist;

                $output .="の出席完了!
                        <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                        
                echo $output;
        
                //header("Location: ../attendance.php?success=$GID_exist");
        
                die();
        
            } catch (PDOException $e) {
                die("Query failed: ID card not in database" . $e->getMessage());
            }
        
            }
        
            else {
                print_r("Invalid ID");
                header("Location: ../attendance.php");
            }

    }
}
else {
    header("Location: ../attendance.php");
}


function arrayContainsOnlyZero($array) {
    // Filter the array
    $filteredArray = array_filter($array, function($value) {
        return $value !== '2';
    });
    
    // Return boolean if only zero or not. True means all items are 0
    return empty($filteredArray);
}

