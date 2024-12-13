<?php
session_start();
include('dbh2.inc.php');

date_default_timezone_set("Japan");
$date_now = date("Y-m-d H:i:s");


if($_SERVER["REQUEST_METHOD"] === "POST") {

    $GID = $_POST["GID_check"];
    $_SESSION["GID_attendance"] = $GID;


    $query_shift_id = "SELECT shift_id FROM users
        WHERE GID = :GID
    ";

    $stmt_shift = $pdo->prepare($query_shift_id);
    $stmt_shift->bindParam(":GID", $GID);
    $stmt_shift->execute();
    $shift_id = "";
    $result_shift = $stmt_shift->fetchAll();

    foreach($result_shift as $row) {
        $shift_id = $row["shift_id"];
    }

    $query = "SELECT shift_id, start_time_a, start_time_b, start_time_c, start_time_d, start_time_regular, training_name, attendance.training_id FROM attendance
        INNER JOIN
            users ON attendance.GIDh = users.GID
        INNER JOIN
            training_form ON training_form.training_id = attendance.training_id
        WHERE 
            attendance.GIDh = :GID
        AND
            sign_progress = '1' 
        ";

    //Check if the training is already finished

    /*switch($shift_id) {
        
        case"1":
            $query .= "AND start_time_a < :date_now 
            ";
            break;
        case"2":
            $query .= "AND start_time_b < :date_now 
            ";
            break;
        case"3":
            $query .= "AND start_time_c < :date_now 
            ";
            break;
        case"4":
            $query .= "AND start_time_d < :date_now 
            ";
            break;
        case"5":
            $query .= "AND start_time_regular < :date_now 
            ";
            break;

    } */

    if($shift_id === "1") {
        $query .= "AND start_time_a < :date_now 
            ";
    }
    else if($shift_id === "2") {
        $query .= "AND start_time_b < :date_now 
            ";
    }
    else if ($shift_id ==="3") {
        $query .= "AND start_time_c < :date_now 
            ";
    }
    else if ($shift_id ==="4") {
        $query .= "AND start_time_d < :date_now 
            ";
    }else if ($shift_id ==="5") {
        $query .= "AND start_time_regular < :date_now 
            ";
    }

        
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":GID", $GID);
    $stmt->bindParam(":date_now", $date_now);
    $stmt->execute();

    $result = $stmt->fetchAll();

    $output ="";

    if($stmt->rowCount() >= 1) {
        foreach($result as $row) {

        $output .= "<tr>
                        <td style='width:26%;' >
                        <form action = 'includes/document_number.inc.php' method = 'POST'>
                        <input hidden type='text' value = '$row[training_id]' name='document_number'>
                        <button class='btn btn-link' type='submit'>$row[training_id]</button></td>
                        </form>
                        <td style='width:74%;'>$row[training_name]</td>
                       
                    </tr>";
        }
        
        echo $output;
    }
   

    else {
        $output = '<h3>No Data Found </h3>';
    }


}
   
