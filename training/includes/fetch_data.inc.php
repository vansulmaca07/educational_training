<?php

session_start();
include('dbh2.inc.php');

$group_ = $_SESSION["group_id"]; 

//Save filter temporarily for participants selected

if(!isset($_SESSION["participants_selected"])) {
    $_SESSION["participants_selected"] = array();
}

if(isset($_POST["action"])) {
    $query = "SELECT GID, name_, RFID, department_name, shift_description, users.group_id, users.building_id, building_name, employee_status_name,
                    users.position_id, position, position_level, group_name FROM users
    INNER JOIN 
        department ON users.department_id = department.department_id
    INNER JOIN 
        shift ON users.shift_id = shift.shift_id
    INNER JOIN 
        employee_status ON employee_status.employee_status_id = users.employee_status_id
    INNER JOIN 
        buildings ON buildings.building_id = users.building_id
    INNER JOIN
        employee_resignation ON employee_resignation.employee_resignation_id = users.employee_resignation_id
    INNER JOIN
        position ON position.position_id = users.position_id
    INNER JOIN
        group_ ON group_.group_id = users.group_id
    AND
        employee_resignation.employee_resignation_name != '退職済'
    AND
        employee_resignation.employee_resignation_name != '部署異'
    AND
        employee_resignation.employee_resignation_name != '処理中..._退職'
    "; 

    //FILTER FOR SHIFT
    if(isset($_POST["shift"]))
    {   
        $shift_trimmed = array_map('trim',$_POST["shift"]);
        $shift_filter = implode("','",$shift_trimmed);
        $query .= "AND shift.shift_description IN('".$shift_filter."')";

        //Store filter data in database
        
        //Convert process array into JSON data
        $shift_array = json_encode($shift_trimmed);
        
        $query_shift_filter = 
            "INSERT INTO filters(GID, shift)
                SELECT :GID, :shift
                ON DUPLICATE KEY UPDATE
                    GID = :GID,
                    shift = :shift    
            ";
        
        $stmt_shift_filter = $pdo->prepare($query_shift_filter);
        $stmt_shift_filter->bindParam(":GID", $_SESSION["GID"]);
        $stmt_shift_filter->bindParam(":shift", $shift_array);
        $stmt_shift_filter->execute(); 
    }

    else {
        $query_shift_filter = "UPDATE filters
            SET 
                shift = :shift
            WHERE
                GID = :GID
            ";
        $stmt_shift_filter = $pdo->prepare($query_shift_filter);
        $stmt_shift_filter->bindParam(":GID", $_SESSION["GID"]);
        $shift = null;
        $stmt_shift_filter->bindParam(":shift", $shift, PDO::PARAM_NULL); 
        $stmt_shift_filter->execute();
    }

    //FILTER for Group

    if(isset($_POST["group_"]))
    {
        $group_trimmed = array_map('trim',$_POST["group_"]);
        $group_filter = implode("','",$group_trimmed); 
        $query .= "AND group_.group_name IN('".$group_filter."')";

        //Store filter data in database
        
        //Convert process array into JSON data
        $group_array = json_encode($group_trimmed);
        
        $query_group_filter = 
            "INSERT INTO filters(GID, group_)
                SELECT :GID, :group_
                ON DUPLICATE KEY UPDATE
                    GID = :GID,
                    group_ = :group_    
            ";
        
        $stmt_group_filter = $pdo->prepare($query_group_filter);
        $stmt_group_filter->bindParam(":GID", $_SESSION["GID"]);
        $stmt_group_filter->bindParam(":group_", $group_array);
        $stmt_group_filter->execute(); 
        
    }

    else {
        $query_group_filter = "UPDATE filters
            SET 
                group_ = :group_
            WHERE
                GID = :GID
            ";
        $stmt_group_filter = $pdo->prepare($query_group_filter);
        $stmt_group_filter->bindParam(":GID", $_SESSION["GID"]);
        $department = null;
        $stmt_group_filter->bindParam(":group_", $group_, PDO::PARAM_NULL); 
        $stmt_group_filter->execute();
    }

    //FILTER FOR 工程

    if(isset($_POST["process"]))
    {
        $process_trimmed = array_map('trim',$_POST["process"]);
        $process_filter = implode("','",$process_trimmed); 
        $query .= "AND department.department_name IN('".$process_filter."')";

        //Store filter data in database
        
        //Convert process array into JSON data
        $process_array = json_encode($process_trimmed);
        
        $query_process_filter = 
            "INSERT INTO filters(GID, department)
                SELECT :GID, :department
                ON DUPLICATE KEY UPDATE
                    GID = :GID,
                    department = :department    
            ";
        
        $stmt_process_filter = $pdo->prepare($query_process_filter);
        $stmt_process_filter->bindParam(":GID", $_SESSION["GID"]);
        $stmt_process_filter->bindParam(":department", $process_array);
        $stmt_process_filter->execute(); 
        
    }

    else {
        $query_process_filter = "UPDATE filters
            SET 
                department = :department
            WHERE
                GID = :GID
            ";
        $stmt_process_filter = $pdo->prepare($query_process_filter);
        $stmt_process_filter->bindParam(":GID", $_SESSION["GID"]);
        $department = null;
        $stmt_process_filter->bindParam(":department", $department, PDO::PARAM_NULL); 
        $stmt_process_filter->execute();
    }

    //FILTER FOR BUILDING

    if(isset($_POST["building"]))
    {
        $building_trimmed = array_map('trim',($_POST["building"]));
        $building_filter = implode("','",$building_trimmed); 
        $query .= "AND users.building_id IN('".$building_filter."')";

        //Store filter data in database
        
        //Convert process array into JSON data
        $building_array = json_encode($building_trimmed);
        
        $query_building_filter = 
            "INSERT INTO filters(GID, shift)
                SELECT :GID, :building
                ON DUPLICATE KEY UPDATE
                    GID = :GID,
                    building = :building    
            ";
        
        $stmt_building_filter = $pdo->prepare($query_building_filter);
        $stmt_building_filter->bindParam(":GID", $_SESSION["GID"]);
        $stmt_building_filter->bindParam(":building", $building_array);
        $stmt_building_filter->execute(); 
    }

    else {
        $query_building_filter = "UPDATE filters
            SET 
                building = :building
            WHERE
                GID = :GID
            ";
        $stmt_building_filter = $pdo->prepare($query_building_filter);
        $stmt_building_filter->bindParam(":GID", $_SESSION["GID"]);
        $building = null;
        $stmt_building_filter->bindParam(":building", $building, PDO::PARAM_NULL); 
        $stmt_building_filter->execute();
    }

    //FILTER FOR POSITION

    if(isset($_POST["position"]))
    {
        $position_trimmed = array_map('trim',($_POST["position"]));
        $position_filter = implode("','",$position_trimmed); 
       // $query .= "AND position.position_level IN('".$position_filter."')";
        $query .= "AND position.position_id IN('".$position_filter."')";
        //Store filter data in database
        
        //Convert process array into JSON data
        $position_array = json_encode($position_trimmed);
        
        $query_position_filter = 
            "INSERT INTO filters(GID, position)
                SELECT :GID, :position
                ON DUPLICATE KEY UPDATE
                    GID = :GID,
                    position = :position    
            ";
        
        $stmt_position_filter = $pdo->prepare($query_position_filter);
        $stmt_position_filter->bindParam(":GID", $_SESSION["GID"]);
        $stmt_position_filter->bindParam(":position", $position_array);
        $stmt_position_filter->execute(); 
    }

    else {

        $query_position_filter = "UPDATE filters
            SET 
                position = :position
            WHERE
                GID = :GID
            ";
        $stmt_position_filter = $pdo->prepare($query_position_filter);
        $stmt_position_filter->bindParam(":GID", $_SESSION["GID"]);
        $position = null;
        $stmt_position_filter->bindParam(":position", $position, PDO::PARAM_NULL); 
        $stmt_position_filter->execute();

    }

    //FILTER FOR EMPLOYEE STATUS

    if(isset($_POST["employee_status"]))
    {
        $employee_status_trimmed = array_map('trim',($_POST["employee_status"]));
        $employee_status_filter = implode("','",$employee_status_trimmed); 
        $query .= "AND employee_status.employee_status_name IN('".$employee_status_filter."')";

        //Store filter data in database
        
        //Convert process array into JSON data
        $employee_status_array = json_encode($employee_status_trimmed);
        
        $query_employee_status_filter = 
            "INSERT INTO filters(GID, employee_status)
                SELECT :GID, :employee_status
                ON DUPLICATE KEY UPDATE
                    GID = :GID,
                    employee_status = :employee_status    
            ";
        
        $stmt_employee_status_filter = $pdo->prepare($query_employee_status_filter);
        $stmt_employee_status_filter->bindParam(":GID", $_SESSION["GID"]);
        $stmt_employee_status_filter->bindParam(":employee_status", $employee_status_array);
        $stmt_employee_status_filter->execute(); 
    }

    else {

        $query_employee_status_filter = "UPDATE filters
            SET 
                employee_status = :employee_status
            WHERE
                GID = :GID
            ";
        $stmt_employee_status_filter = $pdo->prepare($query_employee_status_filter);
        $stmt_employee_status_filter->bindParam(":GID", $_SESSION["GID"]);
        $employee_status = null;
        $stmt_employee_status_filter->bindParam(":employee_status", $employee_status, PDO::PARAM_NULL); 
        $stmt_employee_status_filter->execute();

    }

    if(isset($_POST["GID_search"]))
    {   
        $GID_search = $_POST['GID_search'];
        $query .= "AND GID LIKE ('%$GID_search%')
        ";
    }

    if(isset($_POST["GID_name"]))
    {   
        $GID_name = $_POST['GID_name'];
        $query .= "AND name_ LIKE ('%$GID_name%')
        ";
    }

    if(isset($_POST["participants"])) {
        $participants_trimmed = array_map('trim', $_POST["participants"]);
        $participants_filter = implode("','", $participants_trimmed);
        //$_SESSION["participants_selected"] = $participants_trimmed;

        foreach($participants_trimmed as $participants) {
            if(!in_array($participants, $_SESSION["participants_selected"])) {
            array_push($_SESSION["participants_selected"],
            "$participants");
            }
        }

    }

    $query .= "ORDER BY shift.shift_description ASC";
    $stmt = $pdo->prepare($query);
   // $stmt->bindParam(":group_",$group_);
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
            <td style='width:5%; padding:0;' ><input type='checkbox' name='GIDcheck[]' class='form-check-input common_selector participants' style='accent-color: green;  font-size:20px;' value= '$row[GID]' onchange ='count()'
            ";

            if(isset($_SESSION["participants_selected"])) {
                if(in_array("$row[GID]",$_SESSION["participants_selected"])) {
                    $output .= "checked";
                } 
            }

            $output .= "
            ></td>
            <td style='width:11.2%; padding:0; font-size:15px;' ><input type='text' hidden value= '$row[GID]'>" . $row["GID"] .  "</td>
            <td style='width:18%; padding:0; font-size:15px;' ><input type='text' hidden  value= '$row[name_]'> " . $row["name_"] .  "</td>
            <td style='width:6.4%; padding:0; font-size:15px;' ><input type='text' hidden  value= '$row[shift_description]'> " . $row["shift_description"] .  "</td>
            <td style='width:11.2%; padding:0; font-size:15px;' ><input type='text' hidden  value= '$row[group_name]'> " . $row["group_name"] .  "</td>
            <td style='width:15%; padding:0; font-size:15px;' ><input type='text' hidden  value= '$row[department_name]'>" . $row["department_name"] .  "</td>
            <td style='width:8.2%; padding:0; font-size:15px;' ><input type='text' hidden  value= '$row[building_id]'>" . $row["building_name"] .  "</td>
            <td style='width:10.1%; padding:0; font-size:15px;' >" . $row["position"] . "</td>
            <td style=' padding:0; font-size:15px;' ><input type='text' hidden name='building[]' value= '$row[employee_status_name]'>" . $row["employee_status_name"] .  "</td>
            </tr>";
               
        }
    }

    else {
        $output = '<h3>No Data Found </h3>';
    }

    echo $output;
   
}

if(isset($_POST["participants_subtract"])) {
    $participants_subtract_trimmed = array_map('trim', $_POST["participants_subtract"]);
    $participants_subtract_filter = implode("','", $participants_subtract_trimmed);

    $subtracted_array = array_diff($_SESSION["participants_selected"], $participants_subtract_trimmed);
    $_SESSION["participants_selected"] = $subtracted_array;
}

