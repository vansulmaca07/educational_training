<?php

session_start();
include('dbh2.inc.php');

if($_SERVER["REQUEST_METHOD"] === "POST") {

    if(isset($_POST["email_temp"])) {
        $email = $_POST["email_temp"];
    }
    
    else {
        //continue..
    }

    $name_ = $_POST["name_temp"];
    $department = $_POST["department_temp"];
    $shift = $_POST["shift_temp"];
    $building = $_POST["building_temp"];
    $employee_status = $_POST["employee_status_temp"];
    $group_ = $_POST["group_temp"];
    $temporary_GID = "";
    $userlevel = "3";
    $id_registration = "1";
    $employee_resignation = "1";
    $account_activation = "2";
    $position_id = "13"; //set position id (13) temporary employee
    $temporary_employee = 1;

    if(isset($_POST["GID_temp"]) && $_POST["GID_option_temp"] === "1") {

        //Check if GID is already taken 
        $GID_temp = $_POST["GID_temp"];

        $query = "SELECT * FROM users 
            WHERE 
                GID = :GID
            ";

        $stmt_check = $pdo->prepare($query);
        $stmt_check->bindParam(":GID", $GID_temp);

        $stmt_check->execute();
        $result = $stmt_check->fetchAll();
        $row_count = $stmt_check->rowCount();

        if($row_count > 0) {
            header("Location: ../idregistration.php?error=duplicate_GID");
            exit();
        }

        else {
            $temporary_GID = $GID_temp;
        }
        //CONTINUE
    }

    //IF GID_temp is not set
    else {

        //Check the maximum temporary number
        $query_check = "SELECT GID FROM users
        WHERE 
            GID LIKE '%TMP%'
        ORDER BY
            GID DESC
        LIMIT 1
        ";

        $stmt_check = $pdo->prepare($query_check);
        $stmt_check->execute();
        $result = $stmt_check->fetchAll();
        $row_count = $stmt_check->rowCount();
        $temporary_GID_max = ""; 

        if($row_count === 1) {
            foreach($result as $row) {
                $temporary_GID_max = $row["GID"];
            }

        $suffix_count_max = preg_replace("/[^0-9]/", "", $temporary_GID_max);
        $suffix_count = $suffix_count_max +1;
        $suffix_count = sprintf("%04d", $suffix_count);
        strval($suffix_count);
        $temporary_GID = "TMP" . $suffix_count;
        }
        else {
            $temporary_GID = "TMP0001";
        }

    }

    //Add temporary employee in the Database
    
    try {
        $query = "INSERT INTO users ( 
                GID,
                shift_id,
                department_id,
                group_id,
                building_id,
                userlevel,
                name_,
                id_registration,
                employee_status_id,
                employee_resignation_id,
                account_activation,
                position_id,
                temporary_employee)
    
            VALUES (
                :GID,
                :shift_id,
                :department_id,
                :group_id,
                :building_id,
                :userlevel,
                :name_,
                :id_registration,
                :employee_status_id,
                :employee_resignation_id,
                :account_activation,
                :position_id,
                :temporary_employee
                )

        ";
    
        $stmt = $pdo->prepare($query); 
        $stmt->bindParam(":GID", $temporary_GID);
        $stmt->bindParam(":shift_id",$shift);
        $stmt->bindParam(":department_id",$department);
        $stmt->bindParam(":group_id",$group_);
        $stmt->bindParam(":building_id",$building);
        $stmt->bindParam(":userlevel",$userlevel);
        $stmt->bindParam(":name_",$name_);
        $stmt->bindParam(":id_registration",$id_registration);
        $stmt->bindParam(":employee_status_id",$employee_status);
        $stmt->bindParam(":employee_resignation_id",$employee_resignation);
        $stmt->bindParam(":account_activation",$account_activation);
        $stmt->bindParam(":position_id",$position_id);
        $stmt->bindParam(":temporary_employee",$temporary_employee);
    
        $stmt->execute();
        $stmt = null;

        //Add Email

        if(isset($email)) {
            $query_email = "UPDATE users
                SET
                    email = :email
                WHERE
                    GID = :GID
                ";
            
            $stmt_email = $pdo->prepare($query_email);
            $stmt_email->bindParam(":email", $email);
            $stmt_email->bindParam(":GID", $temporary_GID);
            $stmt_email->execute();   
        }

        header("Location: ../idregistration.php?tmp_gid=$temporary_GID");
        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }   

}