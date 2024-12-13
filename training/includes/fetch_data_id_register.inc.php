<?php

session_start();
include('dbh2.inc.php');

$group_ = $_SESSION["group_id"]; 

if(isset($_POST["action"])) {

    $query = "SELECT GID, name_, RFID, department_name, shift_description, group_id, users.building_id, id_registration, building_name, temporary_employee,
    employee_status_name, users.employee_status_id, users.bar_code, users.account_activation
        FROM 
            users
        INNER JOIN 
            department ON users.department_id = department.department_id
        INNER JOIN 
            shift ON users.shift_id = shift.shift_id
        INNER JOIN
            buildings ON users.building_id = buildings.building_id
        INNER JOIN 
            employee_status ON employee_status.employee_status_id = users.employee_status_id
        INNER JOIN
            employee_resignation ON employee_resignation.employee_resignation_id = users.employee_resignation_id
        WHERE
            employee_resignation.employee_resignation_name != '退職済'
        AND
            employee_resignation.employee_resignation_name != '部署異'
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

    if(isset($_POST["employee_status"]))
    {
       $employee_status_trimmed = array_map('trim',($_POST["employee_status"]));
       $employee_status_filter = implode("','",$employee_status_trimmed); 
       $query .= "AND users.employee_status_id IN('".$employee_status_filter."')";
    }

    if(isset($_POST["GID_search"]))
    {   
        $GID_search = $_POST['GID_search'];
        $query .= "AND GID LIKE ('%$GID_search%')
        ";
    }

    if(isset($_POST["name_search"]))
    {   
        $name_search = $_POST['name_search'];
        $query .= "AND name_ LIKE ('%$name_search%')
        ";
    }

    if(isset($_POST["id_registration"]))
    {   
        $id_registration_trimmed = array_map('trim',($_POST["id_registration"]));
        $id_registration_filter = implode("','",$id_registration_trimmed);
        $query .= "AND users.id_registration IN('".$id_registration_filter."')";                
    }

    if($_SESSION["userlevel"] === "2") {
        $query .= "AND 
                    group_id = '$group_'
                ";
    }

    //set overall control for id card and bar code registration on administrator

    else if($_SESSION["userlevel"] === "3") {

        $query = "SELECT GID, name_, RFID, department_name, shift_description, group_id, users.building_id, id_registration, building_name, temporary_employee,
            employee_status_name, users.employee_status_id, users.bar_code, users.account_activation
        FROM 
            users
        INNER JOIN 
            department ON users.department_id = department.department_id
        INNER JOIN
            buildings ON buildings.building_id = users.building_id
        INNER JOIN 
            shift ON users.shift_id = shift.shift_id
        INNER JOIN 
            employee_status ON employee_status.employee_status_id = users.employee_status_id
        INNER JOIN
            employee_resignation ON employee_resignation.employee_resignation_id = users.employee_resignation_id
        WHERE
            employee_resignation.employee_resignation_name != '退職済'
        AND
            employee_resignation.employee_resignation_name != '部署異'
        ";

    }

    $query .= "ORDER BY id_registration ASC, shift.shift_description ASC";
    $stmt = $pdo->prepare($query);
    //$stmt->bindParam(":group_",$group_);
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
            <td style = 'vertical-align:middle; width: 5%; text-align:center;'><input type='checkbox' value = '$row[GID]' id='$row[GID]' "; 
            
            if($row["account_activation"] === 1) {
                $output .= "checked";
            }

            $output .= "";
            $output .= "
            
            class='form-check-input GID-account' style='font-size:16px;'>
            <br><button type='button' id='reset-password-main' value='$row[GID]' class='reset-password-main btn btn-outline-danger reset_password' data-bs-toggle='modal' data-bs-target='#reset_password_modal'
                    style='padding: .1rem .1rem;
                    font-size: .875rem;
                    line-height: .5;
                    border-radius: .2rem;'
            
                    ><i class=' fa-solid fa-arrows-rotate'></i></button></td>
            " ; 

            /*
                <br><button type='button' id='reset-password-main' value='$row[GID]' class='reset-password-main btn btn-outline-danger reset_password' data-bs-toggle='modal' data-bs-target='#reset_password_modal'
                    style='padding: .1rem .1rem;
                    font-size: .875rem;
                    line-height: .5;
                    border-radius: .2rem;'
            
                    ><i class=' fa-solid fa-arrows-rotate'></i></button>
            */
            //Administrator Access to change userlevel

            if($_SESSION["userlevel"] === "1") {

                if($row["temporary_employee"] === 1) {

                    $output .= "
                    <td style='vertical-align: middle; width: 4.2%;'>
                        <div class='col form-inline'>
                        <button  value='$row[GID]' style='' class='btn btn-sm btn-info delete_tmp_GID update-temporary-employee-btn' id='' data-bs-toggle='modal' data-bs-target='#update-employee-registration'><i class='bi bi-person-fill-gear'></i></button>
                        </div>  
                    </td>
                    <td style='vertical-align: middle; width: 12.3%;'>
                        <span>$row[GID]</span>
                    </td>";
                    
                    }
    
                else {
                    $output .= "
                    <td style='vertical-align: middle; width: 4.2%;'>
                        <button  value='$row[GID]' style='' class='btn btn-sm  btn-info delete_tmp_GID update-temporary-employee-btn' id='' data-bs-toggle='modal' data-bs-target='#update-employee-registration'><i class='bi bi-person-fill-gear'></i></button>
                    </td>
                    <td style='vertical-align: middle; width: 12%;'>
                        <div class='col form-inline'>
                            <span>$row[GID]</span>
                        </div>    
                    </td>";
                }

            }
            
            else { // for non-administrator level 

                if($row["temporary_employee"] === 1) {

                    $output .= "
                    <td style='vertical-align: middle; width: 7%;'>
                            <button  value='$row[GID]' style='' class='btn btn-sm  btn-info delete_tmp_GID update-temporary-employee-btn' id='' data-bs-toggle='modal' data-bs-target='#update-employee-registration'><i class='bi bi-person-fill-gear'></i></button>
                    </td>
                    <td style='vertical-align: middle; width: 10.2%;'>
                        <span>$row[GID]</span>
                    </td>";
                    }
    
                else {
                    $output .= " <td style='vertical-align: middle; width: 17.2%;'>" . $row["GID"] . " </td>";
                }
            }
            $output .="
            <td style='vertical-align: middle; width: 12.1%;'>" . $row["name_"] .  "</td>
            <td style='vertical-align: middle; width: 6.3%;'>" . $row["shift_description"] .  "</td>
            <td style='vertical-align: middle; width: 12.2%;'>" . $row["department_name"] .  "</td>
            <td style='vertical-align: middle; width: 8.1%;'>" . $row["building_name"] .  "</td>
            <td style='vertical-align: middle; width: 12.6%;'>" . $row["employee_status_name"] .  "</td>";
            
            if ($row["id_registration"] === '1') {

            $output .= 
            "<td style='vertical-align: middle; width:11.3%;'> 
                <div class='form-inline'>
                    <button class='btn btn-primary id-register' name='id_register' value='$row[GID]'  type='button' style='vertical-align: middle;' data-bs-toggle='modal' data-bs-target='#id-card-modal'>登録</button>
                </div>
            </td>";
            }

            else {
            
            $output .= "<td style='vertical-align: middle; width:11.3%;'>
                            完了&nbsp;&nbsp;&nbsp; <button class='btn btn-info id-register' name='bar_code_register' value='$row[GID]'  
                            type='button' style='vertical-align: middle;' data-bs-toggle='modal' data-bs-target='#id-card-modal'>
                            <i class='fa-solid fa-arrows-rotate'></i></button>
                        </td>      
            ";
                }
            
            $output .= "<td style='vertical-align:middle; width:10%;'>
                            <div class='form-inline'>
                                $row[bar_code]
                            </div>   
                        </td>
                        <td style='vertical-align:middle; '>
                            <div class='form-inline'>
                                <button class='btn btn-info bar-code-register' name='bar_code_register' value='$row[GID]'  type='button' style='vertical-align: middle;' data-bs-toggle='modal' data-bs-target='#bar-code-modal'>
                                <i class='bi bi-pencil-square'></i></button>
                            </div>
                        </td>
                    </tr>";
            
        }
    }

    else {
        $output = '<h3>No Data Found </h3>';
    }

    echo $output;
   
}