<?php

session_start();

include('dbh2.inc.php');

if($_SERVER["REQUEST_METHOD"] === "POST") {

    //Set Default Settings for Department

    if(isset($_POST["default_department"])) {

        $default_department_trimmed = array_map('trim',$_POST["default_department"]);
        $_SESSION["department_main_filter"] = $default_department_trimmed;
        $default_department_array = json_encode($default_department_trimmed);
        $GID = $_SESSION["GID"];

        $query = 
            "INSERT INTO progress_filters
                (GID, department)
            VALUES
                (
                :GID,
                :department
                )

            ON DUPLICATE KEY UPDATE
                department = :department
            ";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":GID", $GID);
        $stmt->bindParam(":department", $default_department_array);
        $stmt->execute();

    }

    else {
        $session_array = array();
        $session_array[] = $_SESSION["department"];
        $default_department_trimmed = array_map('trim',$session_array);
        $_SESSION["department_main_filter"] = $default_department_trimmed;
        $default_department_array = json_encode($default_department_trimmed);
        $GID = $_SESSION["GID"];

        $query = 
            "INSERT INTO progress_filters
                (GID, department)
            VALUES
                (
                :GID,
                :department
                )

            ON DUPLICATE KEY UPDATE
                department = :department
            ";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":GID", $GID);
        $stmt->bindParam(":department", $default_department_array);
        $stmt->execute(); 

    }

    //Set Default Settings for GROUP

    if(isset($_POST["default_group"])) {

        $default_group_trimmed = array_map('trim',$_POST["default_group"]);
        $_SESSION["group_main_filter"] = $default_group_trimmed;
        $default_group_array = json_encode($default_group_trimmed);
        $GID = $_SESSION["GID"];

        $query = 
            "UPDATE progress_filters
            SET
                group_ = :group_
            WHERE
                GID = :GID
            ";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":GID", $GID);
        $stmt->bindParam(":group_", $default_group_array);
        $stmt->execute();

    }

    else {
        $session_array = array();
        $session_array[] = $_SESSION["group_id"];
        $default_group_trimmed = array_map('trim',$session_array);
        $_SESSION["group_main_filter"] = $default_group_trimmed;
        $default_group_array = json_encode($default_group_trimmed);
        $GID = $_SESSION["GID"];

        $query = 
            "UPDATE progress_filters
            SET
                group_ = :group_
            WHERE
                GID = :GID
            ";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":GID", $GID);
        $stmt->bindParam(":group_", $default_group_array);
        $stmt->execute(); 

    }

    //SET Default Settings for Approver

    if(isset($_POST["default_approver"])) {
        
        $default_approver_trimmed = array_map('trim',$_POST["default_approver"]);
        $default_approver_array = json_encode($default_approver_trimmed);
        

        $query = "UPDATE progress_filters
            SET
                approver = :default_approver
            WHERE
                GID = :GID
                ";
        
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":GID", $GID);
        $stmt->bindParam(":default_approver", $default_approver_array);
        $stmt->execute();        
    }

    else {
        $GID = $_SESSION["GID"];
        $session_array = [];
        $session_array[] = $GID;
        $default_approver_array = json_encode($session_array);

        $query = "UPDATE progress_filters
            SET
                approver = :default_approver
            WHERE
                GID = :GID
                ";
        
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":default_approver", $default_approver_array);
        $stmt->bindParam(":GID", $GID);
        $stmt->execute();  

    }

    
    header("Location: ../change_password.php?success=default_department_changed"); 

}