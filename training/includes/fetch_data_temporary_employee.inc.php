<?php
session_start();
include("dbh2.inc.php");

if($_SERVER["REQUEST_METHOD"] === "POST") {

    if(isset($_POST["GID_temp_edit"])) {

        $GID = $_POST["GID_temp_edit"];

        $query = "SELECT * FROM users
            WHERE
                GID = :GID
            ";
        
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":GID", $GID);
        $stmt->execute();
        $result = $stmt->fetchAll();

        
        
        $output = array();
        foreach($result as $user_info) {
            $output[] = $user_info["GID"];
            $output[] = $user_info["name_"];
            $output[] = $user_info["shift_id"];
            $output[] = $user_info["building_id"];
            $output[] = $user_info["employee_status_id"];
            $output[] = $user_info["group_id"];
            $output[] = $user_info["department_id"];
            $output[] = $user_info["email"];
            $output[] = $user_info["userlevel"];
            $output[] = $user_info["account_activation"];
            $output[] = $user_info["temporary_employee"];
            //$output[] = $user_info["position_id"];
        }
 
        $output = json_encode($output);
        echo $output;
    }

 
}
