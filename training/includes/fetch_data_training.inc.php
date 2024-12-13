<?php
session_start();
include('dbh2.inc.php');

date_default_timezone_set("Japan");

$GID_session = $_SESSION["GID"];
$shift_id = $_SESSION["shift_id"];
$date_now = date("Y-m-d H:i:s");

if(isset($_POST["action"])) {

    $query = "SELECT training_form.training_id, training_name, GID, contents, sign_progress 
        FROM 
            attendance
        INNER JOIN 
            training_form ON attendance.training_id = training_form.training_id
        WHERE 
            attendance.GIDh  = :GID
            ";

    switch($shift_id) {
        case("1"):
            $query .= "AND start_time_a < '$date_now'";
        case("2"):
            $query .= "AND start_time_b < '$date_now'";
        case("3"):
            $query .= "AND start_time_c < '$date_now'";
        case("4"):
            $query .= "AND start_time_d < '$date_now'";
        case("5"):
            $query .= "AND start_time_regular < '$date_now'";
    }

    if(isset($_POST["sign_progress"]))
    {   
       $sign_progress_trimmed = array_map('trim',$_POST["sign_progress"]);
       $sign_progress_filter = implode("','",$sign_progress_trimmed);
       $query .= "AND sign_progress IN('".$sign_progress_filter."')";
    }

    $query .="ORDER by training_form.training_id DESC";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":GID", $GID_session);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $total_row = $stmt->rowCount();
    $output = '';
    if($total_row > 0)
    {
        foreach($result as $row)
        {   

            $query_files =  "SELECT * FROM file_storage
                WHERE 
                    training_id = :training_id
                AND
                    active_status = 1
                ";
        
            $stmt2 = $pdo->prepare($query_files);
            $stmt2->bindParam(":training_id",$row["training_id"]);
            $stmt2->execute();
            $result2 = $stmt2->fetchAll();
            $file_name = '';
            $file_path = '';

            $output .= 
             "<tr>
            <td style='width:10.25%;'>" . $row["training_id"] .  "</td>
            <td style='width:25.3%;'>" . $row["training_name"] .  "</td>
            <td style='width:25.5%;'>
                <div style ='height: 100px; overflow:auto; display:flex; justify-content:center; align-items:center;''>
            
            " . $row["contents"] .  "
                </div>
            </td>
            <td style='width:20.3% ;word-break: break-all;'>
                <div style= 'height: 100px; overflow: auto;'>
            
            ";

            foreach($result2 as $row_file) {
                    $file_path = "includes/uploads/" . $row_file["file_name"] . "." . $row_file["file_ext"];
                
                    $file_name = $row_file["file_name"] . "." . $row_file["file_ext"];
    
                    $output .= "  <a href='download.php?file_id=$row_file[file_id]'>$file_name</a><br>";
                    } 
                
            if ($row["sign_progress"]==="1") {
            
            $output .= "
                </div>
                    </td>
                    <td style='vertical-align:middle; text-align:center;'>
                        <input type='text' hidden name= 'GIDfetch' value = '$GID_session'>
                        <button type='submit' class='btn btn-success btn-confirmation' value= '$row[training_id]'  data-bs-toggle='modal' data-bs-target='#training-confirmation'><span>確認&nbsp;&nbsp;<i class='bi bi-check-circle'></i></span></button>                 
                    </td>         
                </tr>"
                ;
            }
            else {
            $output .= "
                </td>
                <td style='text-align:center;'>
                    完了
                </td>
                </tr>
            ";
            }
        }
    }

    else {
        $output = '<h3>No Data Found </h3>';
    }

    echo $output;

}