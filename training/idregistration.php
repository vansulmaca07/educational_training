<?php

    include_once 'navigation_test.php';
    
    $group_ = $_SESSION["group_id"];

    if(isset($_SESSION["participants_selected"])) {
        unset($_SESSION["participants_selected"]);
    }
?>

<style>
    
.btn-GID-search {
    
    width: 100% !important;
    font-size: 14px !important;
    color: white;
    border: rgba(4, 73, 129, 0.808) !important;  
    text-align: center !important;
    font-style: bold !important;
    
}

.btn-name-search {
    width: 100% !important;
    font-size: 14px !important;
    color: white;
    border: rgba(4, 73, 129, 0.808) !important;  
    text-align: center !important;
    font-style: bold !important;

}

/**shift icon **/
.shift.bootstrap-select .dropdown-menu { 
    width: 220px !important; 
    max-height:250px; 
    overflow-y:visible;
}

.shift.bootstrap-select .dropdown-toggle /*dropdown,*/
/*.bootstrap-select .dropdown-menu li a options*/

{
  background-color: rgba(4, 73, 129, 0.808) !important; 
  width: 100% !important;
  font-size: 14px !important;
  color: white;
  border: rgba(4, 73, 129, 0.808) !important;  
  text-align: center !important;
  font-style: bold !important;
}

.none-shift.bootstrap-select .dropdown-toggle::after {
  border: none;
  font: normal normal normal 14px/1;
  font-style: bold;
  font-family: "bootstrap-icons";
  content: "\F22C"; /* the desired FontAwesome icon */
  vertical-align: 0; /* to center vertically */
}

.selected-shift.bootstrap-select .dropdown-toggle::after {
  border: none;
  font: normal normal normal 14px/1;
  font-style: bold;
  font-family: "bootstrap-icons";
  content: "\F3E0"; /* the desired FontAwesome icon */
  vertical-align: 0; /* to center vertically */

}

/**Process**/

.process.bootstrap-select .dropdown-menu { 
    width: 220px !important;
 
    /*max-height: 220px;*/
    /*overflow-y:visible;*/
}

.process.bootstrap-select .dropdown-toggle /*dropdown,*/
/*.bootstrap-select .dropdown-menu li a options*/

{
  background-color: rgba(4, 73, 129, 0.808) !important; 
  width: 100% !important;
  font-size: 14px !important;
  color: white;
  border: rgba(4, 73, 129, 0.808) !important;  
  text-align: center !important;
  font-style: bold !important;
}

.none-process.bootstrap-select .dropdown-toggle::after {
  border: none;
  font: normal normal normal 14px/1;
  font-style: bold;
  font-family: "bootstrap-icons";
  content: "\F22C"; /* the desired FontAwesome icon */
  vertical-align: 0; /* to center vertically */
}

.selected-process.bootstrap-select .dropdown-toggle::after {
  border: none;
  font: normal normal normal 14px/1;
  font-style: bold;
  font-family: "bootstrap-icons";
  content: "\F3E0"; /* the desired FontAwesome icon */
  vertical-align: 0; /* to center vertically */
}

/***Building *****/

.building.bootstrap-select .dropdown-menu { 
    width: 220px !important; 
}

.building.bootstrap-select .dropdown-toggle /*dropdown,*/
/*.bootstrap-select .dropdown-menu li a options*/

{
  background-color: rgba(4, 73, 129, 0.808) !important; 
  width: 100% !important;
  font-size: 14px !important;
  color: white;
  border: rgba(4, 73, 129, 0.808) !important;  
  text-align: center !important;
  font-style: bold !important;
}

.none-building.bootstrap-select .dropdown-toggle::after {
  border: none;
  font: normal normal normal 14px/1;
  font-style: bold;
  font-family: "bootstrap-icons";
  content: "\F22C"; /* the desired FontAwesome icon */
  vertical-align: 0; /* to center vertically */
}

.selected-building.bootstrap-select .dropdown-toggle::after {
  border: none;
  font: normal normal normal 14px/1;
  font-style: bold;
  font-family: "bootstrap-icons";
  content: "\F3E0"; /* the desired FontAwesome icon */
  vertical-align: 0; /* to center vertically */
}

/***Employee Status*****/

.employee-status.bootstrap-select .dropdown-menu { 
    width: auto !important; 
    max-height: 300px;
   /* overflow-y:visible;
    overflow-y: scroll; */
}

.employee-status.bootstrap-select .dropdown-toggle /*dropdown,*/
/*.bootstrap-select .dropdown-menu li a options*/

{
  background-color: rgba(4, 73, 129, 0.808) !important; 
  width: 100% !important;
  font-size: 14px !important;
  color: white;
  border: rgba(4, 73, 129, 0.808) !important;  
  text-align: center !important;
  font-style: bold !important;
}

.none-employee-status.bootstrap-select .dropdown-toggle::after {
  border: none;
  font: normal normal normal 14px/1;
  font-style: bold;
  font-family: "bootstrap-icons";
  content: "\F22C"; /* the desired FontAwesome icon */
  vertical-align: 0; /* to center vertically */
}

.selected-employee-status.bootstrap-select .dropdown-toggle::after {
  border: none;
  font: normal normal normal 14px/1;
  font-style: bold;
  font-family: "bootstrap-icons";
  content: "\F3E0"; /* the desired FontAwesome icon */
  vertical-align: 0; /* to center vertically */
}

/***ID Card Registration*****/

.id-registration.bootstrap-select .dropdown-menu { 
    width: auto !important; 
    max-height: 300px;
   /* overflow-y:visible;
    overflow-y: scroll; */
}

.id-registration.bootstrap-select .dropdown-toggle /*dropdown,*/
/*.bootstrap-select .dropdown-menu li a options*/

{
  background-color: rgba(4, 73, 129, 0.808) !important; 
  width: 100% !important;
  font-size: 14px !important;
  color: white;
  border: rgba(4, 73, 129, 0.808) !important;  
  text-align: center !important;
  font-style: bold !important;
}

.none-id-registration.bootstrap-select .dropdown-toggle::after {
  border: none;
  font: normal normal normal 14px/1;
  font-style: bold;
  font-family: "bootstrap-icons";
  content: "\F22C"; /* the desired FontAwesome icon */
  vertical-align: 0; /* to center vertically */
}

.selected-id-registration.bootstrap-select .dropdown-toggle::after {
  border: none;
  font: normal normal normal 14px/1;
  font-style: bold;
  font-family: "bootstrap-icons";
  content: "\F3E0"; /* the desired FontAwesome icon */
  vertical-align: 0; /* to center vertically */
}


</style>
                    

                    <div class="all-header"  style="position:relative; margin-bottom:15px;">
                        <div class="new-form-header" style="width: 200px; float: right; position: absolute;">
                            <a class="btn btn-danger" id="reset-filter" >リセット&nbsp;&nbsp;<i class="fa-solid fa-filter-circle-xmark"></i></a>
                        </div>
                        <div id="creationdepartment" class="header-1">
                            <h4><b>IDカード登録</b></h4>       
                        </div> 
                    </div>
                    <hr>
                    <div class="new-form-header" id="duplicate-error" style="position:absolute; z-index:4;">   
                                    
                        <?php
                            if(isset($_GET["tmp_gid"])) { 
                                echo "
                                    <div class='alert alert-success alert-dismissible fade show pt-2 pb-2' style='bottom: 45px;' role='alert'>
                                        臨時従業員[$_GET[tmp_gid]]が追加されました。
                                            <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>       
                                    ";
                            }

                            if(isset($_GET["error"])) {
                                echo "
                                <div class='alert alert-danger alert-dismissible fade show pt-2 pb-2' style='bottom: 45px;' role='alert'>
                                    DUPLICATE GID!
                                        <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>       
                                ";

                            }
                            if(isset($_GET["success_update"])) {
                                echo "
                                <div class='alert alert-success alert-dismissible fade show pt-2 pb-2' style='bottom: 45px;' role='alert'>
                                    UPDATE[$_GET[success_update]]SUCCESSFUL!
                                    <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>       
                                ";
                            }
                        ?>
                    </div>
                 
                        <div class="id-registration-t-container mt-3" style="height:75%;">
                            <table id="IDregTable" class="table table-hover table-bordered rounded-3 overflow-visible IDregT" style="height:100%;">
                                <thead class="theadstyle">
                                    <tr id="firstrow" style="width: 100%;">
                                        <th style="width:5%; vertical-align:middle; text-align:center;">&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-circle-user fs-6 me-2"></i> 
                                        </th>
                                        <th style="width:17%; vertical-align:middle;">
                                            <div class="dropdown p-0">
                                                <button class="btn btn-GID-search" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">GID<i class="bi bi-caret-down float-right" id="GID_search_icon" style="float: right;"></i></button>
                                                <ul class="dropdown-menu p-2" style="width: 300px;" aria-labelledby="dropdownMenuButton1">
                                                    <li><input type="search" name="GID_search" id="GID_search" class="dropdown-item" 
                                                        value = "" placeholder="Search GID">
                                                    </li>
                                                </ul>
                                            </div>
                                        </th>
                                        <th class="m-0 p-0" style="width:12.3%; vertical-align:middle;">
                                            <div class="dropdown p-0">
                                                <button class="btn btn-name-search" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">名前<i class="bi bi-caret-down float-right" id="name_search_icon" style="float: right;"></i></button>
                                                <ul class="dropdown-menu p-2" style="width: 300px;" aria-labelledby="dropdownMenuButton1">
                                                    <li><input type="search" name="name_search" id="name_search" class="dropdown-item" 
                                                        value = "" placeholder="Search 名前">
                                                    </li>
                                                </ul>
                                            </div>
                                        </th>
                                        <th style="width:6.2%; vertical-align:middle;height:40px; vertical-align:middle; margin:0; padding: 0;">
                                            <div class="shift-select-container p-0 m-0" style="">
                                                <select data-selected-text-format="static" title="班" class="shift selectpicker form-control m-0 p-0" data-size = "6" data-live-search = "true" style=""
                                                    multiple id="input-shift-select" data-actions-box="true" aria-label="size 3 select example">
                                                <?php
                                                    if($_SESSION["userlevel"] === "2" OR $_SESSION["userlevel"] === "4") {

                                                    $query = "SELECT distinct(shift_description) FROM users
                                                        INNER JOIN 
                                                            shift ON users.shift_id = shift.shift_id
                                                        WHERE 
                                                            group_id = :group_id
                                                        ORDER BY 
                                                            shift.shift_description ASC;";

                                                    $stmt = $pdo->prepare($query);
                                                        $stmt->bindParam(":group_id",$group_);
                                                    }
                                                    
                                                    else if($_SESSION["userlevel"] ==="1") {
                                                        $query = "SELECT distinct(shift_description) FROM users
                                                            INNER JOIN 
                                                                shift ON users.shift_id = shift.shift_id
                                                            ORDER BY 
                                                                shift.shift_description ASC;";
                                                        $stmt = $pdo->prepare($query);
                                                    }

                                                    $stmt->execute();
                                                    $result = $stmt->fetchAll();
                                                    foreach($result as $row)
                                                        {
                                                            echo "<option name='checkbox_shift[]' value='$row[shift_description]' class='common_selector shift'
                                                            >$row[shift_description]</option>
                                                            ";    
                                                        }
                                                ?>
                                                </select>
                                            </div>
                                                <!--<a href="" role="button" id="drowdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color:white">班<i id="shift_icon" style="float:right;" class="bi bi-caret-down"></i></a>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <?php

                                                        if($_SESSION["userlevel"] === "2" OR $_SESSION["userlevel"] === "4") {

                                                            $query = "SELECT distinct(shift_description) FROM users
                                                                INNER JOIN 
                                                                    shift ON users.shift_id = shift.shift_id
                                                                WHERE 
                                                                    group_id = :group_id
                                                                ORDER BY 
                                                                    shift.shift_description ASC;";
                                                            $stmt = $pdo->prepare($query);
                                                            $stmt->bindParam(":group_id",$group_);
                                                        }
                                                        
                                                        else if($_SESSION["userlevel"] ==="1") {
                                                            $query = "SELECT distinct(shift_description) FROM users
                                                                INNER JOIN 
                                                                    shift ON users.shift_id = shift.shift_id
                                                                ORDER BY 
                                                                    shift.shift_description ASC;";
                                                            $stmt = $pdo->prepare($query);
                                                        }

                                                        $stmt->execute();
                                                        $result = $stmt->fetchAll();
                                                        foreach($result as $row)
                                                            {
                                                    ?>
                                                        <div class="list-group-item checkbox">
                                                            <label><input name="checkbox_shift[]" type="checkbox" class="common_selector shift" value="
                                                                <?php echo $row["shift_description"];
                                                                ?>
                                                                "> <?php echo $row["shift_description"];
                                                                ?>
                                                            </label>
                                                        </div>
                                                            <?php
                                                            }
                                                            ?>        
                                                </ul>  -->
                                        </th>
                                        <th class="m-0 p-0" style="width:12.2%; vertical-align:middle; height:40px;">
                                            <div class="shift-process-container p-0" style="width:100%;">
                                                <select data-selected-text-format="static" title="工程" class="process selectpicker form-control" data-size = "6" data-live-search = "true" style=""
                                                    multiple id="input-process-select" data-actions-box="true" aria-label="size 3 select example">
                                                <?php
                                                     if($_SESSION["userlevel"] === "2" OR $_SESSION["userlevel"] === "4") {
                                                        $query = "SELECT DISTINCT(department_name) 
                                                        FROM 
                                                            users
                                                        INNER JOIN 
                                                            department ON users.department_id = department.department_id
                                                        WHERE 
                                                            group_id = :group_id
                                                            ;";
                                                        $stmt = $pdo->prepare($query);
                                                        $stmt->bindParam(":group_id",$group_);

                                                    }

                                                    else if($_SESSION["userlevel"] === "1") {
                                                        $query = "SELECT DISTINCT(department_name) 
                                                        FROM 
                                                            users
                                                        INNER JOIN 
                                                            department ON users.department_id = department.department_id
                                                        ";
                                                        $stmt = $pdo->prepare($query);
                                                    }
                                                    
                                                    $stmt->execute();
                                                    $result = $stmt->fetchAll();
                                                    foreach($result as $row)
                                                        {
                                                            echo "<option name='checkbox_process[]' value='$row[department_name]' class='common_selector process'
                                                            >$row[department_name]</option>
                                                            ";    
                                                        }
                                                ?>
                                                </select>
                                            </div>
                                           
                                        </th> 
                                        <!--process-->
                                        <th class="m-0 p-0" style="width:8%; vertical-align:middle;">
                                            <div class="building-container p-0" style="width:100%;">
                                                <select data-selected-text-format="static" title="号棟" class="building selectpicker form-control" data-size = "6" data-live-search = "true" style=""
                                                    multiple id="input-building-select" data-actions-box="true" aria-label="size 3 select example">
                                                <?php
                                                    if($_SESSION["userlevel"] === "2" OR $_SESSION["userlevel"] === "4") {
                                                        $query = "SELECT DISTINCT(users.building_id),building_name FROM users
                                                        INNER JOIN
                                                            buildings ON buildings.building_id = users.building_id
                                                        WHERE 
                                                            group_id = :group_
                                                        ORDER by
                                                            users.building_id ASC
                                                        ;";
                                                        $stmt = $pdo->prepare($query);
                                                        $stmt->bindParam(":group_", $group_);
                                                    }

                                                    else if ($_SESSION["userlevel"] === "1") {
                                                        $query = "SELECT DISTINCT(users.building_id),building_name FROM users
                                                        INNER JOIN
                                                            buildings on buildings.building_id = users.building_id
                                                        ORDER by
                                                            users.building_id ASC
                                                        ;";
                                                        $stmt = $pdo->prepare($query);
                                                      
                                                    }
                                                    
                                                    $stmt->execute();
                                                    $result = $stmt->fetchAll();
                                                    foreach($result as $row)
                                                        {
                                                            echo "<option name='checkbox_building[]' value='$row[building_id]' class='common_selector building'
                                                            >$row[building_name]</option>
                                                            ";    
                                                    }
                                                ?>
                                                </select>
                                            </div> 
                                            
                                            <!--<a href="" role="button" id="drowdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color:white">号棟<i id="building_icon" style="float:right;" class="bi bi-caret-down"></i></a>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <?php

                                                        if($_SESSION["userlevel"] === "2" OR $_SESSION["userlevel"] === "4") {
                                                            $query = "SELECT DISTINCT(users.building_id),building_name FROM users
                                                            INNER JOIN
                                                                buildings ON buildings.building_id = users.building_id
                                                            WHERE 
                                                                group_id = :group_
                                                            ORDER by
                                                                users.building_id ASC
                                                            ;";
                                                            $stmt = $pdo->prepare($query);
                                                            $stmt->bindParam(":group_", $group_);
                                                        }

                                                        else if ($_SESSION["userlevel"] === "1") {
                                                            $query = "SELECT DISTINCT(users.building_id),building_name FROM users
                                                            INNER JOIN
                                                                buildings on buildings.building_id = users.building_id
                                                            ORDER by
                                                                users.building_id ASC
                                                            ;";
                                                            $stmt = $pdo->prepare($query);
                                                          
                                                        }
                                                        
                                                        $stmt->execute();
                                                        $result = $stmt->fetchAll();
                                                        foreach($result as $row)
                                                            {
                                                    ?>
                                                        <div class="list-group-item checkbox">
                                                            <label><input name="checkbox_building[]" type="checkbox" class="common_selector building" value="
                                                                <?php echo $row["building_id"];
                                                                ?>
                                                                "> <?php echo $row["building_name"];?>
                                                            </label>
                                                        </div>
                                                            <?php
                                                            }
                                                            ?>
                                                </ul>  --> 
                                        </th>
                                        <th class="m-0 p-0" style="width:11%; vertical-align:middle;height:40px; vertical-align:middle;">
                                            <div class="employee-status-select-container p-0" style="width:100%;">
                                                <select data-selected-text-format="static" title="ステータス" class="employee-status selectpicker form-control" data-size = "6" data-live-search = "true" style=""
                                                    multiple id="input-employee-status-select" data-actions-box="true">

                                                    <?php 
                                                        if($_SESSION["userlevel"] === "2" OR $_SESSION["userlevel"] === "4") {
                                                            $query = "SELECT distinct(users.employee_status_id),employee_status_name  FROM users
                                                            INNER JOIN
                                                                employee_status ON employee_status.employee_status_id = users.employee_status_id
                                                            WHERE 
                                                                group_id = :group_
                                                            ";
                                                            $stmt = $pdo->prepare($query);
                                                            $stmt->bindParam(":group_", $group_);
                                                        }
                                                        
                                                        else if ($_SESSION["userlevel"] === "1") {
                                                            $query ="SELECT distinct(users.employee_status_id),employee_status_name  FROM users
                                                            INNER JOIN
                                                                employee_status ON employee_status.employee_status_id = users.employee_status_id
                                                            ";
                                                            $stmt = $pdo->prepare($query);
                                                        }
                                                        
                                                        $stmt->execute();
                                                        $result = $stmt->fetchAll();
                                                        foreach($result as $row)
                                                            {
                                                                echo "<option name='checkbox_employee_status[]' value='$row[employee_status_id]' class='common_selector employee_status'";
                                                                echo ">$row[employee_status_name]</option>";
                                                            }

                                                    ?>
                                                </select>
                                            </div>
                                        </th> 
                                        
                                        <!--ID registration status-->
                                            
                                        <th class="m-0 p-0" style="width:11%; vertical-align:middle;">
                                            <div class="id-card-registration-status-select-container p-0" style="width:100%;">
                                                <select data-selected-text-format="static" title="ID登録状況" class="id-registration selectpicker form-control" data-size = "6" data-live-search = "true" style=""
                                                    multiple id="input-id-registration-select" data-actions-box="true">
                                                    <option value="2" name="checkbox_id_registration[]" class="common_selector id_registration">登録完了</option>
                                                    <option value="1" name="checkbox_id_registration[]" class="common_selector id_registration">不完全な登録</option>
                                                </select>
                                            </div>  
                                        </th> 

                                        <!-- Bar Code Registered -->

                                        <th style="width:18%; vertical-align:middle;">バーコード          
                                        </th> 
                                    </tr>  
                                </thead>
                                <tbody id="post_list">

                                </tbody>
                            </table>
                        </div>

                        <!-- Button For Adding a Temporary Employee　-->

                        <div style="width:100%; height: 5%;"  class="mt-4">
                            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#new-employee-registration" style="float:left; width:200px;">
                                臨時従業員の追加&nbsp;<i class="bi bi-person-fill-add"></i>
                            </button>
                        </div>
  
                        <!-- Modal For Adding Temporary Employee -->

                        <div class="modal fade overflow-visible" id="new-employee-registration" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" 
                        style="" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog overflow-visible modal-dialog-centered">
                                <div class="modal-content overflow-visible">
                                    <div class="modal-header overflow-visible">
                                        <h5 class="modal-title" id="staticBackdropLabel">臨時従業員登録</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body overflow-visible" style="overflow:visible;">
                                        情報を入力してください。
                                        <hr>                               
                                        <div class="submit-form-div overflow-visible">
                                            <form action="includes/temporary_employee_registration.inc.php" method="POST">
                                            <table id="temporary-employee-table" class="table table-hover table-bordered table-sm rounded-3 overflow-visible temporary-employee-t" style="width:100%; table-layout:fixed;">
                                                <tbody style="width: 100%;">
                                                    <tr style="width: 100%;">
                                                        <td style="width:20%;">
                                                            &nbsp;&nbsp;GID：
                                                        </td>
                                                        <td style="width: 20%;">
                                                            <select style="font-color: black;" id="GID_option_temp"  name="GID_option_temp"
                                                                class="selectpicker w-100" data-max-options="1" data-size="2" title="GID">
                                                                <option value="1">YES</option>
                                                                <option value="2">NO</option>
                                                            </select>
                                                        </td>
                                                        <td style="width:60%;">
                                                            <input type='text' disabled class='register_input w-100' placeholder='GIDが使用可能な場合は入力して' value='' id="GID_temp" name="GID_temp">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:20%;">
                                                            &nbsp;&nbsp;名前：
                                                        </td>
                                                        <td style="width:80%;">
                                                            <input type='text' class='register_input w-100' placeholder='名前を入力してください' required value='' id="name_temp" name="name_temp">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:20%;">
                                                            &nbsp;&nbsp;EMAIL：
                                                        </td>
                                                        <td style="width:80%;">
                                                            <input type='text' class='register_input w-100' placeholder='任意' value='' id="email_temp" name="email_temp">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    <td style="width:20%;">
                                                            &nbsp;&nbsp;G係：
                                                        </td>
                                                        <td style="width:80%;">
                                                            <select id="group_temp" name="group_temp"
                                                                class="selectpicker w-100" required data-size="4" title="所属G係">
                                                                    <?php
                                                                        $query = "SELECT * FROM group_
                                                                            ORDER BY
                                                                                group_name                    
                                                                            ";
                                                                        
                                                                        $stmt = $pdo->prepare($query);
                                                
                                                                        $stmt->execute();

                                                                        $result = $stmt->fetchAll();

                                                                        foreach($result as $row) {
                                                                            echo "
                                                                                <option value='$row[group_id]'";
                                                                            if($row["group_id"] === $_SESSION["group_id"]) {
                                                                            echo "selected";
                                                                            }
                                                                            echo ">$row[group_name]</option>
                                                                            ";
                                                                        }

                                                                    ?>
                                                            </select>
                                                        </td>

                                                    </tr>
                                                    <tr style = "width: 100%;">
                                                        <td style="width:20%;">
                                                            &nbsp;&nbsp;工程：
                                                        </td>
                                                        <td style="width:80%;">
                                                            <select style="font-color: black;" id="department_temp" name="department_temp"
                                                                class="selectpicker w-100" data-max-options="1" required data-size="4" title="工程選択">
                                                                    <?php
                                                                        $query = "SELECT * FROM department                                                                           
                                                                            ";
                                                                        
                                                                        $stmt = $pdo->prepare($query);
                                                                        //$stmt->bindParam(":group_", $group_);
                                                                        $stmt->execute();

                                                                        $result = $stmt->fetchAll();

                                                                        foreach($result as $row) {
                                                                            echo "
                                                                                <option value='$row[department_id]'
                                                                            ";
                                                                            if($row["department_id"] === $_SESSION["department"]) {
                                                                                echo "selected";
                                                                            }

                                                                            echo"
                                                                                >$row[department_name]</option>
                                                                            ";
                                                                        }

                                                                    ?>
                                                            </select>
                                                        </td>
                                                        
                                                        
                                                    </tr>                                      
                                                    <tr>
                                                        <td style="width: 20%;">
                                                            &nbsp;&nbsp;号棟：
                                                        </td>
                                                        <td style="width:30%; overflow: visible;">
                                                        <select style="font-color: black;" id="building_temp" name = "building_temp"required
                                                        class="selectpicker w-100 overflow-visible" data-max-options="1" data-live-search = "true" data-size="3" title="号棟選択">
                                                            <?php
                                                                $query = "SELECT DISTINCT(building_id),building_name FROM buildings
                                                                    ";
                                                                
                                                                $stmt = $pdo->prepare($query);
                                                               // $stmt->bindParam(":group_", $group_);
                                                                $stmt->execute();

                                                                $result = $stmt->fetchAll();

                                                                foreach($result as $row) {
                                                                    echo "
                                                                        <option value='$row[building_id]'>$row[building_name]</option>
                                                                    ";
                                                                }
                
                                                            ?>
                                                        </select>
                                                        </td>
                                                        <td style="width: 20%;">
                                                            &nbsp;&nbsp;班：
                                                        </td>
                                                        <td style="width:30%;">
                                                            <select style="font-color: black;" id="shift_temp" required name="shift_temp"
                                                                class="selectpicker w-100 overflow-visible" data-max-options="1" data-live-search = "true" data-size="3" title="班選択">
                                                                <?php
                                                                    $query = "SELECT DISTINCT(shift_id),shift_description FROM shift
                                                                        ";
                                                                    
                                                                    $stmt = $pdo->prepare($query);
                                                                    $stmt->execute();

                                                                    $result = $stmt->fetchAll();

                                                                    foreach($result as $row) {
                                                                        echo "
                                                                            <option value='$row[shift_id]'>$row[shift_description]</option>
                                                                        ";
                                                                    }
                    
                                                                ?>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 35%;">
                                                            &nbsp;&nbsp;従業員ステータス:
                                                        </td>
                                                        <td style="width: 65%;">
                                                            <select style="font-color: black;" id="employee_status_temp" name="employee_status_temp" required
                                                                class="selectpicker w-100" data-max-options="1" data-live-search = "true" data-size="5" title="従業員ステータスを選択してください">
                                                                    <?php
                                                                        $query = "SELECT DISTINCT(employee_status_id),employee_status_name FROM employee_status
                                                                            ";
                                                                        
                                                                        $stmt = $pdo->prepare($query);
                                                                        $stmt->execute();

                                                                        $result = $stmt->fetchAll();

                                                                        foreach($result as $row) {
                                                                            echo "
                                                                                <option value='$row[employee_status_id]'
                                                                            ";

                                                                            if($row["employee_status_name"] === '玉村在籍') {
                                                                                echo "
                                                                                    selected
                                                                                ";
                                                                            }

                                                                            echo "
                                                                                >$row[employee_status_name]</option>
                                                                            ";
                                                                           
                                                                        }
                        
                                                                    ?>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            
                                                       
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" id ="add-temporary-employee-btn" disabled class="btn btn-primary btn-complete-tmp-register" data-bs-dismiss="modal">送信</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal For Updating Temporary Employee -->

                        <div class="modal fade" id="update-employee-registration" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" 
                        style="" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="">臨時従業員登録</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="">
                                        情報を入力してください。<button disabled type= "button" id="delete-tmp-employee-btn" style="float:right;" data-bs-target="#delete_tmp_modal" data-bs-toggle="modal" data-bs-dismiss="modal" class="btn btn-danger delete-tmp-employee-btn">DELETE</button>
                                        <hr>                               
                                        <div class="submit-form-div">
                                            <form action="includes/update_employee_registration.inc.php" method="POST">
                                            <table id="update-temporary-employee-table" class="table table-hover table-bordered table-sm rounded-3 overflow-visible temporary-employee-t" style="width:100%; table-layout:fixed;">
                                                <tbody id = "update-temporary-employee-table">
                                                    <tr>
                                                        
                                                        <td style="width:20%;">
                                                            &nbsp;&nbsp;GID： 
                                                        </td>
                                                        <td style="width: 20%;">
                                                            <select style="font-color: black;" disabled id="GID_option_temp_update"  name="GID_option_temp_update"
                                                                class="selectpicker w-100" data-max-options="1" data-size="2" title="GID">
                                                                <option selected value="1">YES</option>
                                                                <option value="2">NO</option>
                                                            </select>
                                                            <input type="text" val="" hidden id="GID_temp_hidden" name="GID_temp_hidden">
                                                        </td>
                                                        <td style="width:60%;">
                                                            <input type='text' class='register_input w-100' disabled placeholder='GIDが使用可能な場合は入力して' value='' id="GID_temp_update" name="GID_temp_update">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:20%;">
                                                            &nbsp;&nbsp;名前：
                                                        </td>
                                                        <td style="width:80%;">
                                                            <input type='text' class='register_input w-100' placeholder='名前を入力してください' 
                                                            <?php if($_SESSION["userlevel"] !== "1") {echo "disabled";} ?>
                                                            required value='' id="name_temp_update" name="name_temp_update">
                                                            <input type='text' hidden value='' id="name_temp_hidden" name="name_temp_hidden">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:20%;">
                                                            &nbsp;&nbsp;EMAIL：
                                                        </td>
                                                        <td style="width:80%;">
                                                            <input type='text' class='register_input w-100' placeholder='任意' value='' 
                                                            id="email_temp_update" name="email_temp_update">
                                                        </td>
                                                    </tr>
                                                    <tr style="width: 100%;">
                                                    <td style="width:20%;">
                                                            &nbsp;&nbsp;G係：
                                                        </td>
                                                        <td style="width:80%;">
                                                            <select style="font-color: black;" id="group_temp_update" name="group_temp_update" required 
                                                                <?php if($_SESSION["userlevel"] !== "1") {echo "disabled";} ?>
                                                                class="selectpicker group-selector w-100" data-max-options="1" data-size="4" title="所属G係">
                                                                    <?php
                                                                        $query = "SELECT * FROM group_
                                                                            ORDER BY
                                                                                group_name                    
                                                                            ";
                                                                        $stmt = $pdo->prepare($query);
                                                                        $stmt->execute();
                                                                        $result = $stmt->fetchAll();
                                                                        foreach($result as $row) {
                                                                            echo "
                                                                                <option value='$row[group_id]'";                                                                           
                                                                            echo ">$row[group_name]</option>
                                                                            ";
                                                                        }
                                                                    ?>
                                                            </select>
                                                            <input type="text" value="" hidden id="group_temp_hidden" name="group_temp_hidden">
                                                        </td>
                                                    </tr>
                                                    <tr style="width: 100%;">
                                                        <td style="width:20%;">
                                                            &nbsp;&nbsp;工程：
                                                        </td>
                                                        <td style="width:80%;">
                                                            <select style="font-color: black;" id="department_temp_update" name="department_temp_update"
                                                                <?php if($_SESSION["userlevel"] !== "1") {echo "disabled";} ?>
                                                                class="selectpicker department-selector w-100" data-max-options="1" required data-size="4" title="工程選択">
                                                                    <?php
                                                                        $query = "SELECT * FROM department                                                                        
                                                                            ";
                                                                        
                                                                        $stmt = $pdo->prepare($query);
                                                                        //$stmt->bindParam(":group_", $group_);
                                                                        $stmt->execute();

                                                                        $result = $stmt->fetchAll();

                                                                        foreach($result as $row) {
                                                                            echo "
                                                                                <option value='$row[department_id]'
                                                                            ";
                                                                            
                                                                            echo"
                                                                                >$row[department_name]</option>
                                                                            ";
                                                                        }

                                                                    ?>
                                                            </select>
                                                            <input type="text" value="" hidden id="department_temp_hidden" name="department_temp_hidden">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:20%;">
                                                            &nbsp;&nbsp;号棟：
                                                        </td>
                                                        <td style="width:30%; overflow: visible;">
                                                        <select style="font-color: black;" id="building_temp_update" name = "building_temp_update" required
                                                        <?php if($_SESSION["userlevel"] !== "1") {echo "disabled";} ?>
                                                        class="selectpicker w-100 building-selector overflow-visible" data-max-options="1" data-live-search = "true" data-size="3" title="号棟選択">
                                                            <?php
                                                                $query = "SELECT DISTINCT(building_id),building_name FROM buildings
                                                                    ";
                                                                
                                                                $stmt = $pdo->prepare($query);
                                                                //$stmt->bindParam(":group_", $group_);
                                                                $stmt->execute();
                                                                $result = $stmt->fetchAll();

                                                                foreach($result as $row) {
                                                                    echo "
                                                                        <option value='$row[building_id]'>$row[building_name]</option>
                                                                    ";
                                                                }
                
                                                            ?>
                                                        </select>
                                                        <input type="text" val="" hidden id="building_temp_hidden" name="building_temp_hidden">
                                                        </td>
                                                        <td style="width:20%;">
                                                            &nbsp;&nbsp;班：
                                                        </td>
                                                        <td style="width:30%;">
                                                            <select style="font-color: black;" id="shift_temp_update" required name="shift_temp_update"
                                                            <?php if($_SESSION["userlevel"] !== "1") {echo "disabled";} ?>
                                                                class="selectpicker shift-selector w-100 overflow-visible" data-max-options="1" data-live-search = "true" data-size="3" title="班選択">
                                                                <?php
                                                                    $query = "SELECT DISTINCT(shift_id),shift_description FROM shift
                                                                        ";
                                                                    
                                                                    $stmt = $pdo->prepare($query);
                                                                    $stmt->execute();
                                                                    $result = $stmt->fetchAll();

                                                                    foreach($result as $row) {
                                                                       echo "
                                                                            <option value='$row[shift_id]'>$row[shift_description]</option>
                                                                        ";
                                                                    }
                    
                                                                ?>
                                                            </select>
                                                            <input type="text" hidden value = "" name="shift_temp_hidden" id="shift_temp_hidden">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 35%;">
                                                            &nbsp;&nbsp;従業員ステータス:
                                                        </td>
                                                        <td style="width: 65%;">
                                                            <select style="font-color: black;" id="employee_status_temp_update" name="employee_status_temp_update" required
                                                                <?php if($_SESSION["userlevel"] !== "1") {echo "disabled";} ?>
                                                                class="selectpicker employee-status-selector w-100" data-max-options="1" data-live-search = "true" data-size="5" title="従業員ステータスを選択してください">
                                                                    <?php
                                                                        $query = "SELECT DISTINCT(employee_status_id),employee_status_name FROM employee_status
                                                                            ";
                                                                        
                                                                        $stmt = $pdo->prepare($query);
                                                                        $stmt->execute();

                                                                        $result = $stmt->fetchAll();

                                                                        foreach($result as $row) {
                                                                            echo "
                                                                                <option value='$row[employee_status_id]'
                                                                            ";

                                                                            if($row["employee_status_name"] === '玉村在籍') {
                                                                                echo "
                                                                                    selected
                                                                                ";
                                                                            }

                                                                            echo "
                                                                                >$row[employee_status_name]</option>
                                                                            ";
                                                                           
                                                                        }
                        
                                                                    ?>
                                                            </select>
                                                            <input type="text" value="" id="employee_status_temp_hidden" hidden name="employee_status_temp_hidden">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 35%;">
                                                            &nbsp;&nbsp;ユーザーレベル:
                                                        </td>
                                                        <td style="width: 65%;">
                                                            <select style="font-color: black;" id="userlevel_temp_update" name="userlevel_temp_update" required
                                                            <?php if($_SESSION["userlevel"] !== "1") {echo "disabled";} ?>
                                                                class="selectpicker userlevel-selector w-100" data-max-options="1" data-live-search = "true" data-size="5" title="">
                                                                    <?php
                                                                        $query = "SELECT DISTINCT(userlevel_id),userlevel_name_jp FROM userlevel
                                                                            ";
                                                                        
                                                                        $stmt = $pdo->prepare($query);
                                                                        $stmt->execute();

                                                                        $result = $stmt->fetchAll();

                                                                        foreach($result as $row) {
                                                                            echo "
                                                                                <option value='$row[userlevel_id]'>
                                                                            ";
                                                                            echo "
                                                                                $row[userlevel_name_jp]</option>
                                                                            ";
                                                                           
                                                                        }
                        
                                                                    ?>
                                                            </select>
                                                            <input type="text" val="" hidden id="userlevel_temp_hidden" name="userlevel_temp_hidden">
                                                        </td>
                                                    </tr>

                                                    
                                                    <!--
                                                    
                                                    ACCOUNT ACTIVATION AND RESET PASSWORD
                                                    
                                                    <tr style="width: 100%;">
                                                        <td style="width: 35%;">
                                                        &nbsp;&nbsp;アカウント:
                                                        </td>
                                                        <td style="width: 45%;">
                                                            <select style="font-color: black;" id="account_activation_temp_update" name= "account_activation_temp_update" required
                                                            <?php if($_SESSION["userlevel"] !== "1") {echo "disabled";} ?>
                                                                class="selectpicker account-activation-selector w-100" data-max-options="1" data-live-search = "true" data-size="5" title="">
                                                                    <option value="1">活性化</option>
                                                                    <option value="2">非活性化</option>
                                                            </select>
                                                            <input type="text" hidden name="account_activation_temp_hidden" id="account_activation_temp_hidden">
                                                        </td>
                                                        <td style="width: 20%;">
                                                            <button type='button' id='reset-password-main' value='' class='reset-password-main btn btn-outline-danger reset_password' data-bs-toggle='modal' data-bs-target='#reset_password_modal'
                                                            style='padding: .1rem .1rem;
                                                            font-size: .875rem;
                                                            line-height: .5;
                                                            border-radius: .2rem;'
                                                            
                                                            ><i class=' fa-solid fa-arrows-rotate'></i></button>
                                                        </td>
                                                    </tr> -->
                                                </tbody>
                                            </table>                                       
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        
                                        <button type="submit" id ="update-temporary-employee-btn" disabled class="btn btn-primary btn-complete-tmp-register" data-bs-dismiss="modal">送信</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Modal For ID Card Registration-->
                 
                        <div class="modal fade" id="id-card-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">ID登録</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="text-align:center;">
                                        以下をご確認ください。<br>
                                        <hr>
                                        <table id="ID-registration-table" border="1" class="table table-hover table-bordered rounded-3 participantsT">
                                            <thead>
                                                <tr>
                                                    <th>GID</th>
                                                    <th>名前</th>
                                                </tr>
                                            </thead>
                                            <tbody id="post_list_modal_table">
                                                <tr>
                                                    <td id="GID-id-register"></td>
                                                    <td id="name-register"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="submit-form-div" >
                                            <input type='text' class='register_input' autofocus placeholder='[ID]をスキャンしてください' value='' id="register_input" name ='rfid'>
                                            <button type="submit" class="btn btn-primary btn-complete" data-bs-dismiss="modal">確認</button>
                                        </div>
                                    </div>
                                    <div class="modal-footer">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--End Modal -->

                        <!-- Modal For Bar Code Registration-->
                 
                        <div class="modal fade" id="bar-code-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">バーコード登録</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="text-align:center;">
                                        以下をご確認ください。<br>
                                        <hr>
                                        <table id="ID-registration-table" border="1" class="table table-hover table-bordered rounded-3 overflow-hidden participantsT">
                                            <thead>
                                                <tr>
                                                    <th>GID</th>
                                                    <th>名前</th>
                                                    <th>バーコード</th>
                                                </tr>
                                            </thead>
                                            <tbody id="post_list_bar_code_modal_table">
                                            </tbody>
                                        </table>
                                        <div class="submit-form-div" >
                                                <input type='text' class='register_input' autofocus placeholder='新しいバーコード情報を入力してください' value='' id="bar_code_register_input" name ='rfid'>
                                                <button type="submit" class="btn btn-primary btn-complete-bar" data-bs-dismiss="modal">確認</button>
                                        </div>
                                    </div>
                                    <div class="modal-footer">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--End Modal -->

                        <!-- Modal For Reset Password-->
                 
                        <div class="modal fade" id="reset_password_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">バーコードのリセット</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="text-align:center;">
                                        選択したアカウントのパスワードをリセットしてもよろしいですか？<br>
                                        <hr>
                                        <table id="ID-registration-table" border="1" class="table table-hover table-bordered rounded-3 overflow-hidden participantsT">
                                            <thead>
                                                <tr>
                                                    <th class="w-25">GID</th>
                                                    <th class="w-75">名前</th>
                                                </tr>
                                            </thead>
                                            <tbody id="post_list_reset_password">
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">NO</button>
                                        <button type="submit" name="submit" class="btn btn-danger" id = "reset-password-btn" data-bs-dismiss="modal">リセット</button>  
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--End Modal -->
  
                        <!-- Modal Deleting Temporary Employee-->
                 
                        <div class="modal fade" id="delete_tmp_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header text-center">
                                        <h5 class="modal-title text-center" style="text-align:center;" id="staticBackdropLabel">削除の確認</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                <div class="modal-body">
                                選択した臨時従業員を削除しますか?<br>
                                    [<span id="delete_participant"></span>]
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">NO</button>
                                    <button type="submit" name="submit" class="btn btn-danger" id = "delete_tmp_ajax" data-bs-dismiss="modal">DELETE</button>       
                                </div>
                            </div>
                        </div>
                        
    </div> <!--mainwrapper-->
</div> <!--full-->

<!--

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
                                                -->

<script type="text/javascript">
    
$(document).ready(function() {

    change_icon();

function change_icon () {

    if($('#input-shift-select :selected').length > 0) {
        $('.shift').removeClass("none-shift").addClass("selected-shift");
    }
    else {
        $('.shift').removeClass("selected-shift").addClass("none-shift"); 
    }
    if($('#input-group-select :selected').length > 0) {
        $('.group').removeClass("none-group").addClass("selected-group");
    }
    else {
        $('.group').removeClass("selected-group").addClass("none-group"); 
    }
    if($('#input-process-select :selected').length > 0) {
        $('.process').removeClass("none-process").addClass("selected-process");
    }
    else {
        $('.process').removeClass("selected-process").addClass("none-process"); 
    }
    if($('#input-building-select :selected').length > 0) {
        $('.building').removeClass("none-building").addClass("selected-building");
    }
    else {
        $('.building').removeClass("selected-building").addClass("none-building"); 
    }

    if($('#input-employee-status-select :selected').length > 0) {
            $('.employee-status').removeClass("none-employee-status").addClass("selected-employee-status");
        }
    else {
        $('.employee-status').removeClass("selected-employee-status").addClass("none-employee-status"); 
    }
    
    if($('#input-id-registration-select :selected').length > 0) {
            $('.id-registration').removeClass("none-id-registration").addClass("selected-id-registration");
        }
    else {
        $('.id-registration').removeClass("selected-id-registration").addClass("none-id-registration"); 
    }

}

 //Test Select Picker

    $('#input-shift-select').change(function() {
        change_icon();
        filter_data();
    });

    $('#input-process-select').change(function() {
        change_icon();
        filter_data();
    });

    $('#input-building-select').change(function() {
        change_icon();
        filter_data();
    });

    $('#input-employee-status-select').change(function() {
        change_icon();
        filter_data();
    });

    $('#input-id-registration-select').change(function() {
        change_icon();
        filter_data();
    });
        


//Check required data before submitting temporary employee form

        //Validate Email Address

var email_address_checker = 1
$("#email_temp").on('keyup',function () {
    var email_address = $("#email_temp").val();
    function isEmail(email_address) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email_address);
        }
    
    if(email_address !== "") {

        if(isEmail(email_address) === true) {
            email_address_checker = 1;
            check_required_data();
        }
        else {      
            email_address_checker = 2;
            check_required_data();
        }
    }
    else {
        email_address_checker = 1
        check_required_data();
    }       
});

$("#name_temp").on('keyup', function() {
    check_required_data();
});

$("#building_temp").on('change', function() {
    check_required_data();
});

$("#shift_temp").on('change', function() {
    check_required_data();
});

$("#department_temp").on('change', function() {
    check_required_data();
});

$("#GID_option_temp").on('change', function() {

    if($("#GID_option_temp").val() === "2") {
        $("#GID_temp").attr("disabled", true);
    }

    else if($("#GID_option_temp").val() === "1") {
        $("#GID_temp").attr("disabled", false);
    }

    check_required_data();

})

$("#GID_temp").on('keyup', function() {
    check_required_data();
})

function check_required_data() {

    var name_temp = $("#name_temp").val();
    var shift_temp = $("#shift_temp").val();
    var building_temp = $("#building_temp").val();
    var department_temp = $("#department_temp").val();
    var GID_option_temp = $("#GID_option_temp").val();
    var GID_temp = $("#GID_temp").val().length;
    
    switch(true) {
        case (name_temp === ""):
            $("#add-temporary-employee-btn").attr("disabled", true);
            break;
        case (shift_temp === ""):
            $("#add-temporary-employee-btn").attr("disabled", true);
            break;
        case (building_temp === ""):
            $("#add-temporary-employee-btn").attr("disabled", true);
            break;
        case (department_temp === ""):
            $("#add-temporary-employee-btn").attr("disabled", true);
            break;
        case (GID_option_temp === ""):
            $("#add-temporary-employee-btn").attr("disabled", true);
            break;
        case (email_address_checker === 2):
            $("#add-temporary-employee-btn").attr("disabled", true);
            console.log("invalid email_address");
            break;
        case (GID_option_temp === "1"):
            if(GID_temp > 6){
                $("#add-temporary-employee-btn").attr("disabled", false);   
            }
            else {
                $("#add-temporary-employee-btn").attr("disabled", true);
            } 
            break;
        default:
            $("#add-temporary-employee-btn").attr("disabled", false);
    }
   
}

//Check Required Data for Updating Temporary Employees

//Check required data before submitting temporary employee form

//Validate Email Address

var email_address_checker_update = 1
$("#email_temp_update").on('keyup',function () {
    var email_address = $("#email_temp_update").val();
    function isEmail(email_address) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email_address);
        }
    
    if(email_address !== "") {

        if(isEmail(email_address) === true) {
            email_address_checker_update = 1;
            check_required_data_update();
        }
        else {      
            email_address_checker_update = 2;
            check_required_data_update();
        }
    }
    else {
        email_address_checker_update = 1
        check_required_data_update();
    }       
});

$("#name_temp_update").on('keyup', function() {
    check_required_data_update();
});

$("#building_temp_update").on('change', function() {
    check_required_data_update();
});

$("#shift_temp_update").on('change', function() {
    check_required_data_update();
});

$("#department_temp_update").on('change', function() {
    check_required_data_update();
});

/*$("#GID_option_temp_update").on('change', function() {

    if($("#GID_option_temp_update").val() === "2") {
        $("#GID_temp_update").attr("disabled", true);
    }

    else if($("#GID_option_temp").val() === "1") {
        $("#GID_temp_update").attr("disabled", false);
    }

    check_required_data_update();

})*/

$("#GID_temp_update").on('keyup', function() {
    check_required_data_update();
})

function check_required_data_update() {

    var name_temp = $("#name_temp_update").val();
    var shift_temp = $("#shift_temp_update").val();
    var building_temp = $("#building_temp_update").val();
    var department_temp = $("#department_temp_update").val();
    //var GID_option_temp = $("#GID_option_temp_update").val();
    //var GID_temp = $("#GID_temp_update").val().length;
    
    switch(true) {
        case (name_temp === ""):
            $("#update-temporary-employee-btn").attr("disabled", true);
            break;
        case (shift_temp === ""):
            $("#update-temporary-employee-btn").attr("disabled", true);
            break;
        case (building_temp === ""):
            $("#update-temporary-employee-btn").attr("disabled", true);
            break;
        case (department_temp === ""):
            $("#update-temporary-employee-btn").attr("disabled", true);
            break;
        /*case (GID_option_temp === ""):
            $("#update-temporary-employee-btn").attr("disabled", true);
            break; */
        case (email_address_checker_update === 2):
            $("#update-temporary-employee-btn").attr("disabled", true);
            console.log("invalid email_address");
            break;
        /*case (GID_option_temp === "1"):
            if(GID_temp > 6){
                $("#update-temporary-employee-btn").attr("disabled", false);   
            }
            else {
                $("#update-temporary-employee-btn").attr("disabled", true);
            } 
            break;*/
        default:
            $("#update-temporary-employee-btn").attr("disabled", false);
    }
    
}

var GID_temp_edit = "";
//Edit Information on Temporary Employees 
$('#IDregTable tbody').on('click', '.update-temporary-employee-btn', function () {
    GID_temp_edit = $(this).val();
    console.log(GID_temp_edit + "hello"); 

    $.ajax({

    url: "includes/fetch_data_temporary_employee.inc.php",
    method: "POST",
    data: {GID_temp_edit:GID_temp_edit},
    success:function(data){
        //$("#post_list_reset_password").html(data);
        var test_data = JSON.parse(data);
        console.log(test_data);

        var temporary_employee_id =test_data[10];
        var temporary_employee = temporary_employee_id.toString();

        //Change the attributes if selected person is temporary employee

        if(temporary_employee === "1") {
            $("#delete-tmp-employee-btn").attr("disabled", false);
            $("#name_temp_update").attr("disabled",false);
            $("#shift_temp_update").attr("disabled",false);
            $(".building-selector").attr("disabled",false);
            $(".employee-status-selector").attr("disabled",false);
            $(".group-selector").attr("disabled",false);
            $(".department-selector").attr("disabled",false);
            $(".userlevel-selector").attr("disabled",true);
            $('.selectpicker').selectpicker('refresh');
        }
        else {
            $("#name_temp_update").attr("disabled",true);
            $("#shift_temp_update").attr("disabled",true);
            $("#building_temp_update").attr("disabled",true);
            $("#employee_status_temp_update").attr("disabled",true);
            $("#group_temp_update").attr("disabled",true);
            $("#department_temp_update").attr("disabled",true);
            $("#userlevel_temp_update").attr("disabled",false);
            $('.selectpicker').selectpicker('refresh');
        }

        var GID_temp_update = test_data[0];
        $("#GID_temp_update").val(GID_temp_update);
        $("#GID_temp_hidden").val(GID_temp_update);
        $("#reset-password-main").val(GID_temp_update);
        var name_temp_update = test_data[1];
        $("#name_temp_update").val(name_temp_update);
        $("#name_temp_hidden").val(name_temp_update);

        var shift_temp_update =test_data[2];
        $(".shift-selector").selectpicker("val", shift_temp_update);
        $("#shift_temp_hidden").val(shift_temp_update);
        
        var building_temp_update = test_data[3];
        $(".building-selector").selectpicker("val", building_temp_update);
        $("#building_temp_hidden").val(building_temp_update);
        var employee_status_temp_update = test_data[4];
        $(".employee-status-selector").selectpicker("val", employee_status_temp_update);
        $("#employee_status_temp_hidden").val(employee_status_temp_update);
        var group_temp_update = test_data[5];
        $(".group-selector").selectpicker("val", group_temp_update);
        $("#group_temp_hidden").val(group_temp_update);
        var department_temp_update = test_data[6];
        $(".department-selector").selectpicker("val", department_temp_update);
        $("#department_temp_hidden").val(department_temp_update);
        var email_temp_update = test_data[7];
        $("#email_temp_update").val(email_temp_update);
        var userlevel_temp_update = test_data[8];
        $(".userlevel-selector").selectpicker("val", userlevel_temp_update);
        $("#userlevel_temp_hidden").val(userlevel_temp_update);
        var account_activation_int =test_data[9];
        //converts int to string
        var account_activation_temp_update = account_activation_int.toString();
        $(".account-activation-selector").selectpicker("val", account_activation_temp_update);
        $("#account_activation_temp_hidden").val(account_activation_temp_update);

        var temporary_employee_id =test_data[10];
        var temporary_employee =temporary_employee_id.toString();



        console.log(account_activation_temp_update);
        //filter_data();
        check_required_data_update();

    }

    });
});


//reset filter 

$('#reset-filter').on('click', function() {
    location.reload();
});

//Reset Password

var reset_password_GID = "";
$('#IDregTable tbody').on('click', '.reset-password-main', function () {
    reset_password_GID = $(this).val();
    console.log(reset_password_GID);

    $.ajax({

        url: "includes/reset_password.inc.php",
        method: "POST",
        data: {reset_password_GID:reset_password_GID},
        success:function(data){
            $("#post_list_reset_password").html(data);
            //console.log("success on password reset");
            filter_data();
        }

    });
});

$('#reset-password-btn').on("click", function() {

    var GID_reset = reset_password_GID;
    $.ajax({
        url: "includes/reset_password.inc.php",
        method: "POST",
        data: {GID_reset:GID_reset},
        success:function(data){
            $("#duplicate-error").html(data);
            
            console.log("success on password reset");
            filter_data();
        }
    });
});

//Delete Temporary Employee
/*
var delete_tmp_GID = "";

$('#IDregTable tbody').on('click', '.delete_tmp_GID', function() {
    delete_tmp_GID = $(this).val();

    $("#delete_participant").html(delete_tmp_GID);

    console.log(delete_tmp_GID);

});
*/



$('#delete-tmp-employee-btn').on('click', function() {
    
    $("#delete_participant").html(GID_temp_edit);

});


$("#delete_tmp_ajax").on("click", function () {

    $.ajax({
    url: "includes/delete_tmp_employee.inc.php",
    method: "POST",
    data: {GID_temp_edit:GID_temp_edit},
        success:function(data){
            console.log("success on changing account_activation");

            $("#duplicate-error").html(data);
            filter_data();
        }
    });

});


//On change value for GID account activation

var account_activation;
var GID_user_account;

$('#IDregTable tbody').on('change', '.GID-account', function() {

    GID_user_account = $(this).val();
    console.log(GID_user_account);

    var GID_check = $(this).is(":checked");
    console.log(GID_check);

    switch(GID_check) {
        case(true):
            account_activation = 1;
            break;
        case(false):
            account_activation = 2;
            break;
    }
    console.log(account_activation);
    account_settings();
    
});

function account_settings() {
    
    $.ajax({
    url: "includes/account_settings.inc.php",
    method: "POST",
    data: {account_activation:account_activation, GID_user_account:GID_user_account},
        success:function(data){
            console.log("success on changing account_activation");
            filter_data();
        }
  });


}


//Click Trigger Event for bar code

$('#bar_code_register_input').keypress(function (e) {
 var key = e.which;
 if(key == 13)  // the enter key code
  {
    console.log("you press enter");
    $('.btn-complete-bar').click();
    return false;  
  }
});  

//Click Trigger Event for ID card

$('#register_input').keypress(function (e) {
 var key = e.which;
 if(key == 13)  // the enter key code
  {
    console.log("you press enter");
    $('.btn-complete').click();
    return false;  
  }
}); 

//auto-focus on modal registration

$('.modal').on('shown.bs.modal', function() {
  $(this).find('[autofocus]').focus();
});

//get the GID and name of the ID to be registered in modal registration

var ID_GID_register = "";

$("#IDregTable tbody").on('click','.id-register', function() {

ID_GID_register = $(this).val();
console.log(ID_GID_register);

$.ajax({
    url: "includes/id_register_table.inc.php",
    method: "POST",
    data: {ID_GID_register:ID_GID_register},
        success:function(data){
            $('#post_list_modal_table').html(data);
            console.log("success on fetching data");
        }
  });

});

//get the GID and name of the bar code to be registered in modal registration


$("#IDregTable tbody").on('click','.bar-code-register', function() {

GID_register = $(this).val();
console.log(GID_register);

$.ajax({
    url: "includes/bar_code_register_table.inc.php",
    method: "POST",
    data: {GID_register:GID_register},
        success:function(data){
            $('#post_list_bar_code_modal_table').html(data);
            
            console.log("success on fetching data");
        }
  });

});

//id registration asynchronous <3

$(".btn-complete").on('click', function() {
    var rfid = $("#register_input").val();

    $.ajax({
    url: "includes/id_register.inc.php",
    method: "POST",
    data: {rfid:rfid,ID_GID_register:ID_GID_register},
        success:function(data){
            $('#duplicate-error').html(data);
            filter_data();
            console.log("success on id registration");
            $("#register_input").val("");
        }
  });

});

//bar code registration asynchronous <3

$(".btn-complete-bar").on('click', function() {
    var bar_code = $("#bar_code_register_input").val();

    $.ajax({
    url: "includes/bar_code_register.inc.php",
    method: "POST",
    data: {bar_code:bar_code,GID_register:GID_register},
        success:function(data){
            console.log(data);
            $('#duplicate-error').html(data);

            $("#bar_code_register_input").val(""); 
            filter_data();
            //console.log("success on id registration");  
        }
    });
});


//highlight mouse hover

$(".id-registration-tab").addClass("active");



/****** FILTERS ********/
filter_data();
function filter_data() {
  //$('#post_list').html();
  var action = 'fetch_data';
  var shift = get_filter('shift');
  var process = get_filter('process');
  var building = get_filter('building');
  var employee_status = get_filter('employee_status');
  var GID_search = $('#GID_search').val();
  var name_search = $('#name_search').val();
  var id_registration = get_filter('id_registration');

  $.ajax({
      url: "includes/fetch_data_id_register.inc.php",
      method: "POST",
      data: {action:action,
        shift:shift,
        process:process,
        building:building,
        employee_status:employee_status,
        GID_search:GID_search,
        name_search:name_search,
        id_registration:id_registration},
      success:function(data){
        $('#post_list').html(data);
      }
  });
}

function get_filter(class_name)
{
var filter = [];
$('.'+class_name+':checked').each(function(){
    filter.push($(this).val());
});

return filter;
}

$('.common_selector').click(function(){

    if($('input[name="checkbox_shift[]"]:checked').length > 0) {
        $("#shift_icon").attr("class", "bi bi-funnel-fill");
    }
    else {
        $("#shift_icon").attr("class", "bi bi-caret-down");
    }

    if($('input[name="checkbox_process[]"]:checked').length > 0) {
        $("#process_icon").attr("class", "bi bi-funnel-fill");
    }
    else {
        $("#process_icon").attr("class", "bi bi-caret-down");
    }

    if($('input[name="checkbox_building[]"]:checked').length > 0) {
        $("#building_icon").attr("class", "bi bi-funnel-fill");
    }
    else {
        $("#building_icon").attr("class", "bi bi-caret-down");
    }

    if($('input[name="checkbox_employee_status[]"]:checked').length > 0) {
        $("#employee_status_icon").attr("class", "bi bi-funnel-fill");
    }
    else {
        $("#employee_status_icon").attr("class", "bi bi-caret-down");
    }

    if($('input[name="checkbox_id_registration[]"]:checked').length > 0) {
        $("#id_registration_icon").attr("class", "bi bi-funnel-fill");
    }
    else {
        $("#id_registration_icon").attr("class", "bi bi-caret-down");
    }
    
    filter_data();
});

$('#GID_search').on("input", function(){

    if($("#GID_search").val() !== "") {
        $("#GID_search_icon").attr("class","bi bi-funnel-fill");
    }
    else {
        $("#GID_search_icon").attr("class","bi bi-caret-down");
    }

    event.preventDefault();
    filter_data();

});

$('#name_search').on("input", function(){

    if($("#name_search").val() !== "") {
        $("#name_search_icon").attr("class","bi bi-funnel-fill");
    }
    else {
        $("#name_search_icon").attr("class","bi bi-caret-down");
    }

    event.preventDefault();
    filter_data();

});
});

</script>
