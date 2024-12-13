<?php

session_start();
include('dbh2.inc.php');

date_default_timezone_set("Japan");


$training_id = $_SESSION["document_number"];
$date_now = date("Y-m-d H:i:s");

if(isset($_POST["action"])) {

    $query = "SELECT date_id, affiliation, GIDh, users.name_, status_name, department_name, shift.shift_id, shift.shift_description, start_time_a, start_time_b,
                    start_time_c, start_time_d, start_time_regular FROM attendance
        INNER JOIN
            users ON users.GID = attendance.GIDh
        INNER JOIN
            department ON department.department_id = users.department_id
        INNER JOIN
            shift ON shift.shift_id = users.shift_id
        INNER JOIN 
            status_ref ON attendance.sign_progress = status_ref.status_id
        INNER JOIN
            training_form ON training_form.training_id = attendance.training_id
        WHERE 
            attendance.training_id = :training_id
    ";

    if(isset($_POST["sign_progress"]))
    {   
       $sign_progress_trimmed = array_map('trim',$_POST["sign_progress"]);
       $sign_progress_filter = implode("','",$sign_progress_trimmed);
       $query .= "AND status_ref.status_name IN('".$sign_progress_filter."')";
    }

    if(isset($_POST["shift"]))
    {   
       $shift_trimmed = array_map('trim',$_POST["shift"]);
       $shift_filter = implode("','",$shift_trimmed);
       $query .= "AND shift.shift_id IN('".$shift_filter."')";
    }

    //department:department, GID_search:GID_search, name_search:name_search
    if(isset($_POST["department"])) {
        $department_trimmed = array_map('trim', $_POST["department"]);
        $department_filter = implode("','", $department_trimmed);
        $query .= "AND department.department_id IN('".$department_filter."')";

    }

    if(isset($_POST["GID_search"])) {
        $GID_search = $_POST['GID_search'];
        $query .= "AND users.GID LIKE ('%$GID_search%')
        ";
    }

    if(isset($_POST["name_search"])) {
        $name_search = $_POST["name_search"];
        $query .= "AND users.name_ LIKE ('%$name_search%')
        ";
    }

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":training_id", $training_id);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $total_row = $stmt->rowCount();
    $output = '';
    if($total_row > 0)
    {
        foreach($result as $row)
        {   
            $output .= 
                "<tr ";

            
            $shift_id = $row["shift_id"];
            
            if($shift_id === "1") {
                if($row["start_time_a"] > $date_now) {
                    $output .= "style='display:none;'";
                }
                else if($row["start_time_a"] === NULL){
                    $output .= "style='display:none;'";
                }
                else{
                }
            }

            else if($shift_id === "2") {
                if($row["start_time_b"] > $date_now) {
                    $output .= "style='display:none;'";
                }
                else if($row["start_time_b"] === NULL) {
                    $output .= "style='display:none;'";
                }
                else{
                }
            }

            else if($shift_id === "3") {
                if($row["start_time_c"] > $date_now) {
                    $output .= "style='display:none;'";
                }
                else if($row["start_time_c"] === NULL) {
                    $output .= "style='display:none;'";
                }
                else{
                }
               
            }

            else if($shift_id === "4") {
                if($row["start_time_d"] > $date_now) {
                    $output .= "style='display:none;'";
                }
                else if($row["start_time_d"] === NULL) {
                    $output .= "style='display:none;'";
                }
                else{
                } 
            }

            else if($shift_id === "5") {
                if($row["start_time_regular"] > $date_now) {
                    $output .= "style='display:none;'";
                }
                else if($row["start_time_regular"] === NULL ) {
                    $output .= "style='display:none;'";
                }
                else{
                } 
            }

            
                           
            $output .=   "  >                
                    <td class ='text-center' style= 'width:15%;'>" . $row["department_name"] .  "</td>
                    <td class ='text-center' style= 'width:15%;'>" . $row["shift_description"] . "</td>
                    <td class ='text-center' style= 'width:15%;'>" . $row["GIDh"] . "</td>
                    <td class ='text-center' style= 'width:20%;'>" . $row["name_"] . "</td>
                    <td class ='text-center' style= 'width:15%;'>" . $row["status_name"] . "</td>
                    <td class ='text-center' style= 'width:18.5%;'>" . $row["date_id"] .  "</td>
                </tr>";
        }
    }

    else {
        $output = '<h3>データが見つかりません</h3>';
    }

    echo $output;
   
}