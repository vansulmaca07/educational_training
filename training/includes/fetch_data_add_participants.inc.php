<?php

session_start();
include('dbh2.inc.php');

$group_ = $_SESSION["group_id"]; 
$training_id = $_SESSION["training_id"];
if(!isset($_SESSION["checked_participants"])) {
    $_SESSION["checked_participants"] = [];
}

if(isset($_POST["action"])) {

    //Retain Checked checkbox

    if($_POST["action"] === "check") {
        $_SESSION["checked_participants"][] = $_POST["GID_new_participant"];
    }

    else if ($_POST["action"] === "uncheck") {
        $_SESSION["checked_participants"] = array_diff($_SESSION["checked_participants"], $_POST["GID_new_participant"]);
    }

    //Select All Checkbox

    $query = "SELECT GID, name_, department_name, shift_description, group_id, buildings.building_id, building_name, users.position_id, position
    FROM users

    INNER JOIN 
        department ON users.department_id = department.department_id
    INNER JOIN
         shift ON users.shift_id = shift.shift_id
    INNER JOIN 
        employee_resignation ON users.employee_resignation_id = employee_resignation.employee_resignation_id
    INNER JOIN 
        buildings ON buildings.building_id = users.building_id
    INNER JOIN
        position ON position.position_id = users.position_id
    WHERE
        employee_resignation.employee_resignation_name != '退職済'
    AND
        employee_resignation.employee_resignation_name != '部署異'
    AND
        employee_resignation.employee_resignation_name != '処理中..._退職'
    ";

    if(isset($_POST["shift_add"]))
    {   
       $shift_trimmed = array_map('trim',$_POST["shift_add"]);
       $shift_filter = implode("','",$shift_trimmed);
       $query .= "AND shift.shift_description IN('".$shift_filter."')";
    }

    if(isset($_POST["process_add"]))
    {
       $process_trimmed = array_map('trim',$_POST["process_add"]);
       $process_filter = implode("','",$process_trimmed); 
       $query .= "AND department.department_name IN('".$process_filter."')";
    }

    if(isset($_POST["position_add"]))
    {
       $position_trimmed = array_map('trim',$_POST["position_add"]);
       $position_filter = implode("','",$position_trimmed); 
       $query .= "AND users.position_id IN('".$position_filter."')";
    }

    if(isset($_POST["building_add"]))
    {
       $building_trimmed = array_map('trim',($_POST["building_add"]));
       $building_filter = implode("','",$building_trimmed); 
       $query .= "AND users.building_id IN('".$building_filter."')";
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
   
    $query .= "EXCEPT
        SELECT GIDh, attendance.name_, department_name, shift_description, group_id, building_name, buildings.building_id, users.position_id, position
	        FROM attendance
        INNER JOIN 
            users ON users.GID = attendance.GIDh
        INNER JOIN 
            department ON users.department_id = department.department_id
        INNER JOIN 
            shift on users.shift_id = shift.shift_id
        INNER JOIN 
            buildings on buildings.building_id = users.building_id
        INNER JOIN
            position ON position.position_id = users.position_id
        WHERE 
            training_id = :training_id
    ";

    $query .= "ORDER BY shift_description ASC";

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
            <td style='width:10%; padding:0;' ><input type='checkbox' class='GIDcheck form-check-input' name='GIDcheck_add[]'  
            ";
            if(in_array($row["GID"], $_SESSION["checked_participants"])) {
                $output .= "checked";
            } 
            $output .=
            "
            value= '$row[GID]' onchange ='count()'></td>
            <td style='width:15%; padding:0; font-size:15px;' ><input type='text' hidden class='GIDname'  name='GIDname_add[]' value= '$row[GID]'>" . $row["GID"] .  "</td>
            <td style='width:15%; padding:0; font-size:15px;' ><input type='text' hidden class='name_'  name='name_add[]' value= '$row[name_]'> " . $row["name_"] .  "</td>\
            <td style='width:15%; padding:0; font-size:15px;' ><input type='text' hidden class='shift_description' hidden name='shift_description_add[]' value= '$row[shift_description]'> " . $row["shift_description"] .  "</td>
            <td style='width:15%; padding:0; font-size:15px;' ><input type='text' hidden class='' hidden name='position_add[]' value= '$row[position_id]'> " . $row["position"] .  "</td>
            <td style='width:15%; padding:0; font-size:15px;' ><input type='text' hidden class='department_name'  name='department_name_add[]' value= '$row[department_name]'>" . $row["department_name"] .  "</td>
            <td style='width:15%; padding:0; font-size:15px;' ><input type='text' hidden class='building' hidden name='building_add[]' value= '$row[building_id]'>" . $row["building_name"] .  "</td>
            </tr>";
        }
    }

    else {
        $output = '<h3>No Data Found </h3>';
    }
          
 

    echo $output;
   
}