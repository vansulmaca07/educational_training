<?php

session_start();
include('dbh2.inc.php');

$group_ = $_SESSION["group_id"];
$training_id = $_SESSION["training_id"]; 
$creation_department = $_SESSION["creation_department"];
$current_department = $_SESSION["department"];
$judgement = $_SESSION["judgement"];
$class = "";
$delete_class = "";
$attendance_disabled = "";



if($creation_department !== $current_department) {
   // $class = "disabled";
   // $delete_class = "disabled";
   // $attendance_disabled = "disabled";
}

$input_status = "";
    switch(true) {
        case($_SESSION["userlevel"] === "1"):
            //continue
            break;
        case($_SESSION["userlevel"] === "4"):
            //continue
            break;
        case($creation_department !== $current_department):
            $class = "disabled";
            $delete_class = "disabled";
            $attendance_disabled = "disabled";
            break;
        default:
            //continue
    }

if($judgement === 2) {
    $class = "disabled";
}

if(isset($_POST["action"])) {

    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);

/*  $query = "SELECT GID, name_, RFID, affiliation, shift_description, group_, building, judgement
    FROM attendance
    INNER JOIN department on users.department_id = department.department_id
    INNER JOIN shift on users.shift_id = shift.shift_id
    WHERE users.group_ ='$group_'"; */

    $query = "SELECT GIDh, attendance.name_, shift_description, group_id, users.building_id, building_name, judgement, affiliation, department_name, attendance, sign_progress
        FROM 
            attendance
        INNER JOIN 
            users ON attendance.GIDh = users.GID
        INNER JOIN 
            shift ON users.shift_id = shift.shift_id
        INNER JOIN 
            department ON department.department_id = users.department_id
        INNER JOIN
            buildings ON buildings.building_id = users.building_id
        WHERE 
            attendance.training_id = :training_id
    ";

    if(isset($_POST["shift"]))
    {   
       $shift_trimmed = array_map('trim',$_POST["shift"]);
       $shift_filter = implode("','",$shift_trimmed);
       $query .= "AND shift.shift_description IN('".$shift_filter."')";
    }  

    if(isset($_POST["process"]))
    {
       $process_trimmed = array_map('trim',$_POST["process"]);
       $process_filter = implode("','",$process_trimmed); 
       $query .= "AND department.department_name IN('".$process_filter."')";
    }

    if(isset($_POST["building"]))
    {
       $building_trimmed = array_map('trim',($_POST["building"]));
       $building_filter = implode("','",$building_trimmed); 
       $query .= "AND users.building_id IN('".$building_filter."')";
    } 

    if(isset($_POST["sign_progress"]))
    {
       $sign_progress_trimmed = array_map('trim',($_POST["sign_progress"]));
       $sign_progress_filter = implode("','",$sign_progress_trimmed); 
       $query .= "AND attendance.sign_progress IN('".$sign_progress_filter."')";
    }

    if(isset($_POST["GID_search_main"]))
    {   
        $GID_search_main = $_POST['GID_search_main'];
        $query .= "AND GIDh LIKE ('%$GID_search_main%')
        ";
    }

    if(isset($_POST["GID_name_main"]))
    {   
        $GID_name_main = $_POST['GID_name_main'];
        $query .= "AND attendance.name_ LIKE ('%$GID_name_main%')
        ";
    }
    
    $query .= "ORDER BY shift.shift_description ASC";

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
            $output .= "
 
            <tr>
            <td style='width:11.2%;'>
            <input type='text' hidden name='GIDname[]' value= '$row[GIDh]'>" . $row["GIDh"] .  "</td>
            <td style='width:15.3%;' ><input type='text' hidden  value= '$row[name_]'> " . $row["name_"] .  "</td>
            <td style='width:9.3%;' ><input type='text' hidden  value= '$row[shift_description]'> " . $row["shift_description"] .  "</td>
            <td style='width:13.3%;' ><input type='text' hidden  value= '$row[affiliation]'>" . $row["department_name"] .  "</td>
            <td style='width:11.2%;' ><input type='text' hidden  value= '$row[building_id]'>" . $row["building_name"] .  "</td>
            <td style='width:9.8%;' >";

            if ($row["judgement"] === '1') {
            
                $output .=    "<select id='judgement' name=judgement[] class='judgement' $class>
                        <option value='1' selected>
                        合</option>
                        <option value='2'>
                        否</option>
                    </select>
                      
                </td>
                ";
                }
            
            else if ($row["judgement"] === '2') {
            
                $output .=    "<select id='judgement' name = judgement[] class = 'judgement' $class>
                        <option value='1'>
                        合</option>
                        <option value='2' selected>
                        否</option>
                    </select>
                      
                </td>
                ";
                }

            if($row["attendance"] === '1') {
                $output .= "<td style='width: 11.8%;'>
                                <select id='attendance' name = attendance[] class = 'attendance' $attendance_disabled>
                                    <option value='1' selected>
                                        済</option>
                                    <option value='2' >
                                        未受講</option>
                                </select>
                            </td> ";
            }

            else if($row["attendance"] === '2') {

                $output .= "<td style='width: 11.7%;'>
                                <select id='attendance' name = attendance[] class = 'attendance' $attendance_disabled>
                                    <option value='1'>
                                        済</option>
                                    <option value='2' selected>
                                        未受講</option>
                                </select>
                            </td> ";

            } 
            
            if($row["sign_progress"] === "1") {
                $sign_progress = "進行中"; 
            }

            else if ($row["sign_progress"] === "2") {
                $sign_progress = "完了";
                $sign_progress .= "&nbsp;&nbsp;<button type='button' id='reset-signature' value='$row[GIDh]' class='reset-signature btn btn-outline-danger' data-bs-toggle='modal' data-bs-target='#reset_signature_modal'
                style='padding: .1rem .1rem;
                font-size: .875rem;
                line-height: .5;
                border-radius: .2rem;'
                $delete_class
                ><i class=' fa-solid fa-arrows-rotate'></i></button>";
            }
            
            $output .= "
                         <td style='width:9%;'>$sign_progress</td>
                        <td><button type ='button' value='$row[GIDh]' class ='btn btn-danger delete_trainee'
                        data-bs-toggle='modal' $delete_class data-bs-target='#delete_trainee_modal'>削除<i class='bi bi-x-circle'></i></button></td>
                    </tr>
                    ";
        };
    }

    else {
        $output = '<h3>No Data Found </h3>';
    }

    echo $output;   
}
