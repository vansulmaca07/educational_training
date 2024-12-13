<?php

session_start();
include('dbh2.inc.php');

$group_ = $_SESSION["group_id"];
$department = $_SESSION["department"]; 

if(isset($_POST["training_id"])) {

    $training_id = $_POST["training_id"];

    $query = 
        "SELECT * FROM attendance
            INNER JOIN
                users ON users.GID = attendance.GIDh
            WHERE
                training_id = :training_id
            AND
                sign_progress = '1'
        ";
    
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":training_id", $training_id);
    $stmt->execute();
    
    $result = $stmt->fetchAll();

    $output = "";

    foreach($result as $row) {

        if($row["email"] !== "" Or NULL) {

            $output .="

            <tr>
                <td>$row[GID]</td>
                <td>$row[name_]</td>
                <td>$row[email]</td>
            </tr>
        
            ";
        }

        else {
            
        }
      
    }

    echo $output;


}