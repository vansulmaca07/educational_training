<?php

session_start();
include('dbh2.inc.php');

if($_SERVER["REQUEST_METHOD"] === "POST") {

    //Check Email

    if(isset($_POST["email_temp_update"])) {
        $email = $_POST["email_temp_update"];
    }
    else {
        //continue..
    }
    
    $temporary_GID = $_POST["GID_temp_hidden"];

    //Check Name

    if(isset($_POST["name_temp_update"])) {
        $name_ = $_POST["name_temp_update"];
    } 
    else { 
        $name_ = $_POST["name_temp_hidden"];
    }

    //Check Department
    if(isset($_POST["department_temp_update"])) {
        $department = $_POST["department_temp_update"];
    } 
    else { 
        $department = $_POST["department_temp_hidden"];
    }

    //Check Group
    if(isset($_POST["group_temp_update"])) {
        $group_ = $_POST["group_temp_update"];
    } 
    else { 
        $group_ = $_POST["group_temp_hidden"];
    }

    //Check Shift
    if(isset($_POST["shift_temp_update"])) {
        $shift = $_POST["shift_temp_update"];
    } 
    else { 
        $shift = $_POST["shift_temp_hidden"];
    }

    //Check Building
    if(isset($_POST["building_temp_update"])) {
        $building = $_POST["building_temp_update"];
    } 
    else { 
        $building = $_POST["building_temp_hidden"];
    }

    //Check Employee Status
    if(isset($_POST["employee_status_temp_update"])) {
        $employee_status = $_POST["employee_status_temp_update"];
    }
    else {
        $employee_status = $_POST["employee_status_temp_hidden"];
    }

    //Check userlevel
    if(isset($_POST["userlevel_temp_update"])) {
        $userlevel = $_POST["userlevel_temp_update"];
    }
    else {
        $userlevel = $_POST["userlevel_temp_hidden"];
    }

    //Check Account Activation
  /*  if(isset($_POST["account_activation_temp_update"])) {
        $account_activation = $_POST["account_activation_temp_update"];
    }
    else {
        $account_activation = $_POST["account_activation_temp_hidden"];   
    } */

    

    //Update temporary employee in the Database
    
    try {
        $query = "UPDATE users
            SET
                shift_id = :shift_id,
                department_id = :department_id,
                group_id = :group_id,
                building_id = :building_id,
                name_ = :name_,
                employee_status_id = :employee_status_id,
                userlevel = :userlevel
                
            WHERE
                GID = :GID   
                ";
    
        $stmt = $pdo->prepare($query); 
        $stmt->bindParam(":GID", $temporary_GID);
        $stmt->bindParam(":shift_id",$shift);
        $stmt->bindParam(":department_id",$department);
        $stmt->bindParam(":group_id",$group_);
        $stmt->bindParam(":building_id",$building);
        $stmt->bindParam(":name_",$name_);
        $stmt->bindParam(":employee_status_id",$employee_status);
        $stmt->bindParam(":userlevel",$userlevel);
       // $stmt->bindParam(":account_activation", $account_activation); 
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

        header("Location: ../idregistration.php?success_update=$temporary_GID");
        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }   

}