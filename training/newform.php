<?php
    include_once 'navigation_test.php';
    $group_ = $_SESSION["group_id"];
    include_once 'includes/dbh2.inc.php';
    $GID_creator = $_SESSION["GID"];

    if(isset($_SESSION["test_datetime_start"]))
    {
        echo $_SESSION["test_datetime_start"];
    }
    
    $training_name = '';
    $process_prefix = '';
    $instructor_regular = '';
    $instructor_a = '';
    $instructor_b = '';
    $instructor_c = '';
    $instructor_d = '';
    $location_regular = '';
    $location_a = '';
    $location_b = '';
    $location_c = '';
    $location_d = '';
    $start_time_regular = null;
    $start_time_a = null;
    $start_time_b = null;
    $start_time_c = null;
    $start_time_d = null;
    $end_time_regular = null;
    $end_time_a = null;
    $end_time_b = null;
    $end_time_c = null;
    $end_time_d = null;
    $term = '';
    $purpose = '';
    $audience = '';
    $contents = '';
    $usage_id = '';
    $training_id = '';
    $creation_department = '';
    $confirmation_by = "";
    $category = array ();

if(isset($_GET["training_id"])) {
    $training_id = $_GET["training_id"];
    $query_copy = "SELECT * FROM training_form
        INNER JOIN
            users ON users.GID = training_form.creator
        WHERE training_id = :training_id
    ";
    $stmt_copy = $pdo->prepare($query_copy);
    $stmt_copy->bindParam(":training_id", $training_id);
    $stmt_copy-> execute();
    $result_copy = $stmt_copy->fetchAll();
    
    foreach ($result_copy as $copy_data) {
        $training_name = $copy_data["training_name"];
        $process_prefix = $copy_data["process_prefix"];
        $instructor_regular = $copy_data["instructor_regular"];
        $instructor_a = $copy_data["instructor_a"];
        $instructor_b = $copy_data["instructor_b"];
        $instructor_c = $copy_data["instructor_c"];
        $instructor_d = $copy_data["instructor_d"];
        $location_regular = $copy_data["location_regular"];
        $location_a = $copy_data["location_a"];
        $location_b = $copy_data["location_b"];
        $location_c = $copy_data["location_c"];
        $location_d = $copy_data["location_d"];
        $term = $copy_data["term"];
        $purpose = $copy_data["purpose"];
        $contents = $copy_data["contents"];
        $usage_id = $copy_data["usage_id"];
        $creation_department = $copy_data["department_id"];

    }

    if($creation_department === $_SESSION["department"]) {
        $query_copy_same_process = "SELECT * FROM training_form
            WHERE 
                creator = :GID_creator
            ORDER BY 
                date_created 
            DESC LIMIT 1";
        $stmt_copy_same_process = $pdo->prepare($query_copy_same_process);
        $stmt_copy_same_process->bindParam(":GID_creator", $GID_creator);
        $stmt_copy_same_process->execute();
        $result_copy_same_process = $stmt_copy_same_process->fetchAll();

        foreach($result_copy_same_process as $copy_data) {
            $audience = $copy_data["audience"];
  
            $confirmation_by = $copy_data["confirmation_by"];
        }

    }

    else { //IF NOT FROM SAME PROCESS

        $query_copy_not_same_process = "SELECT * FROM training_form
            WHERE 
                creator = :GID_creator
            ORDER BY 
                date_created 
            DESC LIMIT 1";
        $stmt_copy_not_same_process = $pdo->prepare($query_copy_not_same_process);
        $stmt_copy_not_same_process->bindParam(":GID_creator", $GID_creator);
        $stmt_copy_not_same_process->execute();
        $result_copy_not_same_process = $stmt_copy_not_same_process->fetchAll();

        //UNSET 
        $term = "";
        $process_prefix = "";
        $instructor_regular = '';
        $instructor_a = '';
        $instructor_b = '';
        $instructor_c = '';
        $instructor_d = '';
        $location_regular = '';
        $location_a = '';
        $location_b = '';
        $location_c = '';
        $location_d = '';

        foreach($result_copy_not_same_process as $copy_data_same_process) {
           
            $process_prefix = $copy_data["process_prefix"];
            $location_regular = $copy_data["location_regular"];
            $location_a = $copy_data["location_a"];
            $location_b = $copy_data["location_b"];
            $location_c = $copy_data["location_c"];
            $location_d = $copy_data["location_d"];
            $instructor_regular = $copy_data["instructor_regular"];
            $instructor_a = $copy_data["instructor_a"];
            $instructor_b = $copy_data["instructor_b"];
            $instructor_c = $copy_data["instructor_c"];
            $instructor_d = $copy_data["instructor_d"];  
            $audience = $copy_data["audience"];
            $term = $copy_data["term"];
            $confirmation_by = $copy_data["confirmation_by"];

        }

    }

    $query_cat = "SELECT category.category_id, category_name FROM category
        INNER JOIN 
            category_ref ON category_ref.category_id = category.category_id    
        WHERE training_id = :training_id";

    $stmt_cat = $pdo->prepare($query_cat);
    $stmt_cat->bindParam(":training_id", $training_id);
    $stmt_cat->execute();

    $result_cat = $stmt_cat->fetchAll();

    foreach ($result_cat as $categories) {
        $category[] = $categories["category_id"];
    }
}

else if(!isset($_GET["training_id"])) {

    $query_previous = 
    "SELECT * FROM training_form 
        WHERE 
            creator = :creator
        ORDER BY 
            date_created 
        DESC LIMIT 1";

    $stmt_previous = $pdo->prepare($query_previous);
    $stmt_previous->bindParam(":creator", $GID_creator);
    $stmt_previous->execute();

    $result_previous_data = $stmt_previous->fetchAll();

    $training_id = "";
    foreach ($result_previous_data as $prev_data) {
        $training_name = $prev_data["training_name"];
        $process_prefix = $prev_data["process_prefix"];
        $training_name = $prev_data["training_name"];
        $instructor_regular = $prev_data["instructor_regular"];
        $instructor_a = $prev_data["instructor_a"];
        $instructor_b = $prev_data["instructor_b"];
        $instructor_c = $prev_data["instructor_c"];
        $instructor_d = $prev_data["instructor_d"];
        $location_regular = $prev_data["location_regular"];
        $location_a= $prev_data["location_a"];
        $location_b= $prev_data["location_b"];
        $location_c= $prev_data["location_c"];
        $location_d= $prev_data["location_d"];
        $purpose = $prev_data["purpose"];
        $audience = $prev_data["audience"];
        $training_id =$prev_data["training_id"];       
        $term = $prev_data["term"];
        $confirmation_by = $prev_data["confirmation_by"];

    }

    $query_cat_previous = "SELECT 
            category.category_id, category_name FROM category
        INNER JOIN 
            category_ref ON category_ref.category_id = category.category_id    
        WHERE 
            training_id = :training_id";

    $stmt_cat_prev = $pdo->prepare($query_cat_previous);
    $stmt_cat_prev->bindParam(":training_id", $training_id);
    $stmt_cat_prev->execute();

    $result_cat_prev = $stmt_cat_prev->fetchAll();

    foreach ($result_cat_prev as $categories) {
    $category[] = $categories["category_id"];
    }
}


?>
    <!-----------REGISTRATION FORM----------->

    <style> 
.bootstrap-select > .dropdown-toggle.bs-placeholder:disabled {
    background-color: gray !important;   
}

.bootstrap-select .dropdown-toggle /*dropdown,*/
/*.bootstrap-select .dropdown-menu li a options*/

{
  background-color: lightgoldenrodyellow !important; 
  width: 100% !important;
  font-size: 14px !important;
}

/**File Name **/

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

/**Group Icon**/

.group.bootstrap-select .dropdown-menu { 
    width: auto !important; 
 
    max-height: 220px;
    overflow-y:visible;
}

.group.bootstrap-select .dropdown-toggle /*dropdown,*/
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

.none-group.bootstrap-select .dropdown-toggle::after {
  border: none;
  font: normal normal normal 14px/1;
  font-style: bold;
  font-family: "bootstrap-icons";
  content: "\F22C"; /* the desired FontAwesome icon */
  vertical-align: 0; /* to center vertically */
}

.selected-group.bootstrap-select .dropdown-toggle::after {
  border: none;
  font: normal normal normal 14px/1;
  font-style: bold;
  font-family: "bootstrap-icons";
  content: "\F3E0"; /* the desired FontAwesome icon */
  vertical-align: 0; /* to center vertically */
}

/**Process**/

.process.bootstrap-select .dropdown-menu { 
    width: auto !important; 
 
    max-height: 220px;
    overflow-y:visible;
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
    width: auto !important; 
 
    max-height: 220px;
    overflow-y:visible;
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

/***Position *****/

.position.bootstrap-select .dropdown-menu { 
    width: auto !important; 
    max-height: 300px;
    /*overflow-y:visible; */
    /*overflow-y: scroll;*/
}

.position.bootstrap-select .dropdown-toggle /*dropdown,*/
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

.none-position.bootstrap-select .dropdown-toggle::after {
  border: none;
  font: normal normal normal 14px/1;
  font-style: bold;
  font-family: "bootstrap-icons";
  content: "\F22C"; /* the desired FontAwesome icon */
  vertical-align: 0; /* to center vertically */
}

.selected-position.bootstrap-select .dropdown-toggle::after {
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




</style>
            <form action="includes/createform.inc.php" id="new-form" method="post" enctype="multipart/form-data">
                <div class="all-header"  style="position:relative;  margin-bottom:15px;">
                    <div class="new-form-header">
                        <button type="button" id ="clear_button" class="btn btn-danger mb-3" style="font-size: 14px; float:left; width:100px; margin-right:20px; position:absolute;" onclick="">
                            内容クリア
                        </button>
                    </div>
                    <div id="creation-department" class ="header-1">
                        <h4><b>作成部署: 製造部</b></h4>
                    </div>   
                </div>
                <hr>
                <div id="mainrecord" style="width: 100%;">
                    <table id="mainrecordTable" border="1" class="table table-sm table-hover rounded-3 mainrecordT2 overflow-visible" style="width:100%; table-layout:fixed;">
                        <tbody>
                            <tr style="width:100%">
                                <td style="width: 10%;">
                                    <span class="" style="text-align:center;">名称：</span>
                                </td>
                                <td style="width:40%">
                                    <input type="text" name="training_name" id="educationID" value="<?php echo $training_name;?>" class="input-main-form" style="width:100%; font-size: 14px;" required>
                                </td>
                                <td style="width:15%">
                                    <span>工程：</span>
                                    <select style="height: 35px; font-size: 12px;" name="process_prefix" id="trainingDepartment" class="selectpicker w-50" required
                                        data-max-options="1" data-live-search = "true" data-size="6" title="選択">
                                        <option value="" disabled selected hidden>Select</option>
                                            <?php
                                                if ($process_prefix !== '') {
                                                    echo "<option value= '$process_prefix' selected>$process_prefix</option>";
                                                }

                                                $query = "SELECT * FROM process_prefix
                                                    ORDER BY
                                                        sequence ASC
                                                ;";
                                                $stmt = $pdo->prepare($query);
                                                $stmt->execute();
                                                $result = $stmt->fetchAll();
                                                $php_array = [];
                                                foreach($result as $row)
                                                {
                                                    echo "<option value= '$row[process_prefix]'>$row[process_prefix]</option>";
                                                };
                                            ?>
                                    </select>    
                                </td>
                                <td style="width:15%">
                                    <input type="text" id="term" name="term" value="<?php echo $term; ?>" style="width: 30%; font-size: 14px;" class="input-main-form" required>
                                    &nbsp;<span>期</span>             
                                </td>
                                <td style="width:10%">
                                    <input type="radio" id="trainingLocInternal" name="training_area" value="1" checked>
                                        <label for="trainingLocInternal" style="vertical-align:middle;">社内</label>
                                </td>
                                <td style="width:10%">
                                    <input type="radio" id="trainingLocExternal" name="training_area" value="2">
                                        <label for="trainingLocExternal">社外</label>
                                </td>         
                            </tr>
                        </tbody>
                    </table>
                    <table id="mainrecordTable2" class="table table-hover table-sm rounded-3 overflow-visible mainrecordT2" style="width: 100%; table-layout:fixed;">
                        <tr style="width:100%;">
                            <td style="width:12%;">
                                <span>日勤者実施日時：</span>
                            </td>
                            <td style="vertical-align:middle; width:19%;">
                                <input style="font-size: 12px !important;" type="datetime-local" name="datetime_regular_start" id="datetime_regular_start" value="<?php echo $start_time_regular; ?>" class="input-main-form w-100" >
                            </td>
                            <td style="width:2%;">~</td>
                            <td style="vertical-align:middle; width:19%;">
                                <input style="font-size: 12px !important;" type="datetime-local" name="datetime_regular_end" id="datetime_regular_end" value="<?php echo $end_time_regular; ?>" class="input-main-form w-100">
                            </td>
                            <td style="width:5%;">
                                場所：
                            </td>
                            <td style="width:17%;">
                                <input type="text" id="location_regular" name="location_regular" value="<?php echo $location_regular; ?>" class="input-main-form w-100">
                            </td>
                            <td style="width:5%; padding: 0;">
                            講師：
                            </td>
                            <td style="width:20%;">
                                <select name="instructor_regular" id="instructor-regular" data-allow-clear="true" class="selectpicker instructor-select w-100" data-live-search = "true" data-size="6" title="講師選択">
                                    <?php
                                        $query_instructor = "SELECT name_ FROM users
                                            WHERE
                                                userlevel = '2'
                                            OR
                                                userlevel = '4'
                                        ";

                                        $stmt_instructor = $pdo->prepare($query_instructor);
                                        
                                        $stmt_instructor->execute();

                                        $result_query_instructor = $stmt_instructor->fetchAll();

                                        foreach ($result_query_instructor as $instructors) {
                                            echo "<option value ='$instructors[name_]'";
                                            
                                            if($instructor_regular === $instructors["name_"]) {
                                                echo "selected";
                                            }
                                            echo">$instructors[name_]</option>";
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr style="width:100%;">
                            <td class="w-12">
                                <span>Ａ班実施日時：</span>
                            </td>
                            <td style="vertical-align:middle;" class="w-18.5">
                                <input style="font-size: 12px !important;" type="datetime-local" name="datetime_a_start" value = "<?php echo $start_time_a; ?>" id="datetime_a_start" class="input-main-form w-100">
                            </td>
                            <td class="w-2">~</td>
                            <td style="vertical-align:middle;" class="w-18.5">
                                <input style="font-size: 12px !important;" type="datetime-local" name="datetime_a_end" value="<?php echo $end_time_a; ?>" id="datetime_a_end" class="input-main-form w-100">
                            </td>
                            <td class="w-5">
                                場所：
                            </td>
                            <td class="w-17">
                                <input type="text" id="location_a" name="location_a" value="<?php echo $location_a; ?>" class="input-main-form w-100">
                            </td>
                            <td class="w-5">
                                講師：
                            </td>
                            <td class="w-20">
                        
                            <!--SEARCH INSTRUCTOR A-->
                                <select name="instructor_a" id="instructor-a"  class="selectpicker w-100" data-live-search = "true" data-size="6" data-allow-clear="true" data-max-options="1" title="講師選択">
                                    <?php
                                        $query_instructor = "SELECT name_ FROM users
                                            WHERE
                                                userlevel = '2'
                                            OR
                                                userlevel = '4'
                                            ";
                                        $stmt_instructor = $pdo->prepare($query_instructor);
                                        $stmt_instructor->execute();

                                        $result_query_instructor = $stmt_instructor->fetchAll();

                                        foreach ($result_query_instructor as $instructors) {
                                            echo "<option value ='$instructors[name_]'";
                                            if($instructor_a === $instructors["name_"]) {
                                                echo "selected";
                                            }
                                            echo">$instructors[name_]</option>";
                                        }
                                    ?>
                                </select>                
                            </td>
                        </tr>

                        <tr class="w-100">
                            <td class="w-12">
                                <span>Ｂ班実施日時：</span>
                            </td>
                            <td style="vertical-align:middle;" class="w-19">
                                <input style="font-size: 12px !important;" type="datetime-local" name="datetime_b_start" id="datetime_b_start" value="<?php echo $start_time_b; ?>" class="input-main-form w-100">
                            </td>
                            <td class="w-2">~</td>
                            <td style="vertical-align:middle;" class="w-19">
                                <input style="font-size: 12px !important;" type="datetime-local" name="datetime_b_end" id="datetime_b_end" value="<?php echo $end_time_b; ?>" class="input-main-form w-100">
                            </td>
                            <td class="w-5">
                            場所：
                            </td>
                            <td class="w-17">
                                <input  type="text" id="location_b" name="location_b" value="<?php echo $location_b; ?>" class="input-main-form w-100">
                            </td>
                            <td class="w-5">
                            講師：
                            </td>
                            <td class="w-20">
                                <select name="instructor_b" id="instructor_b"  class="selectpicker w-100" data-live-search = "true" data-allow-clear="true" data-size="6" data-max-options="1" title="講師選択">
                                    <?php
                                        $query_instructor = "SELECT name_ FROM users
                                            WHERE 
                                                userlevel = '2'
                                            OR
                                                userlevel = '4'";
                                            
                                        $stmt_instructor = $pdo->prepare($query_instructor);
                                        $stmt_instructor->execute();
                                        $result_query_instructor = $stmt_instructor->fetchAll();

                                        foreach ($result_query_instructor as $instructors) {
                                            echo "<option value ='$instructors[name_]'";
                                                if($instructor_b === $instructors["name_"]) {
                                                    echo "selected";
                                                }
                                            echo">$instructors[name_]</option>";
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>

                        <tr class="w-100">
                            <td class="w-12">
                                <span>Ｃ班実施日時：</span>
                            </td>
                            <td class="w-19" style="vertical-align:middle;">
                                <input style="font-size: 12px !important;" type="datetime-local" name="datetime_c_start" id="datetime_c_start" value="<?php echo $start_time_c; ?>" class="input-main-form w-100">
                            </td>
                            <td class="w-2">~</td>
                            <td class="w-19" style="vertical-align:middle;">
                                <input style="font-size: 12px !important;" type="datetime-local" name="datetime_c_end" id="datetime_c_end" value="<?php echo $end_time_c; ?>" class="input-main-form w-100">
                            </td>
                            <td class="w-5">
                            場所：
                            </td>
                            <td class="w-18">
                                <input type="text" id="location_c" name="location_c" value="<?php echo $location_c; ?>" class="input-main-form w-100">
                            </td>
                            <td class="w-5">
                            講師：
                            </td>
                            <td class="w-20">
                                <select name="instructor_c" id="instructor_c"  class="selectpicker w-100" data-live-search = "true" data-allow-clear="true" data-size="6" data-max-options="1" title="講師選択">
                                    <?php
                                        $query_instructor = "SELECT name_ FROM users
                                            WHERE
                                                userlevel = '2'
                                            OR
                                                userlevel = '4' 
                                                ";

                                            $stmt_instructor = $pdo->prepare($query_instructor);
                                            $stmt_instructor->execute();

                                            $result_query_instructor = $stmt_instructor->fetchAll();

                                            foreach ($result_query_instructor as $instructors) {
                                                echo "<option value ='$instructors[name_]'";
                                                if($instructor_c === $instructors["name_"]) {
                                                    echo "selected";
                                                } 
                                                echo">$instructors[name_]</option>";
                                            }
                                    ?>
                                </select>    
                            </td>
                        </tr>
                        <tr class="w-100">
                            <td class="w-12">
                                <span>Ｄ班実施日時：</span>
                            </td>
                            <td class="w-19" style="vertical-align:middle;">
                                <input style="font-size: 12px;"  type="datetime-local" name="datetime_d_start" id="datetime_d_start" value="<?php echo $start_time_d; ?>" class="input-main-form w-100">
                            </td>
                            <td class="w-2">~</td>
                            <td class="w-19" style="vertical-align:middle;">
                                <input style="font-size: 12px !important;" type="datetime-local" name="datetime_d_end" id="datetime_d_end" value="<?php echo $end_time_d; ?>" class="input-main-form w-100">
                            </td>
                            <td class="w-5">
                            場所：
                            </td>
                            <td class="w-17">
                                <input type="text" id="location_d" name="location_d" value="<?php echo $location_d; ?>" class="input-main-form w-100">
                            </td>
                            <td class="w-5">
                            講師：
                            </td>
                            <td class="w-20">
                                <select name="instructor_d" id="instructor_d"  class="selectpicker w-100" data-live-search="true" data-allow-clear="true" data-max-options="1" data-size="6" title="講師選択">
                                    <?php
                                        $query_instructor = "SELECT name_ FROM users
                                            WHERE 
                                                userlevel = '2'
                                            OR
                                                userlevel = '4'";

                                        $stmt_instructor = $pdo->prepare($query_instructor);                                           
                                        $stmt_instructor->execute();
                                        $result_query_instructor = $stmt_instructor->fetchAll();

                                        foreach ($result_query_instructor as $instructors) {
                                            echo "<option value ='$instructors[name_]'";
                                            if($instructor_d === $instructors["name_"]) {
                                                echo "selected";
                                            }
                                            echo">$instructors[name_]</option>";
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>  
                    </table>
                </div>
                <div id="categoryDIV" class="categoryDIV">
                    <caption><b>区分</b></caption>
                    <table id="categoryTable" class="table table-hover rounded-3 overflow-hidden mainrecordT2">
                        <tbody>
                            <tr style="width:100%;">
                                <td style="width:20%">
                                    <input type="checkbox" id="categoryQuality"
                                        class="form-check-input"
                                        name="category[]"
                                        value="1"
                                        <?php if(in_array(1,$category)) {echo 'checked';}?>> <!--Quality-->
                                    <label for="categoryQuality" class="fs-6">品質</label>
                                </td> 

                                <td style="width:20%">
                                    <input type="checkbox" 
                                        id="categoryEnvironment"
                                        name="category[]"
                                        class="form-check-input" 
                                        value="2"
                                        <?php if(in_array(2,$category)) {echo 'checked';}?>>
                                    <label for="categoryEnvironment" class="fs-6">環境</label> <!--Environment-->
                                </td>

                                <td style="width:20%">
                                    <input type="checkbox" 
                                        id="categorySafetyAndHygiene" 
                                        name="category[]"
                                        class="form-check-input" 
                                        value="3"
                                        <?php if(in_array(3,$category)) {echo 'checked';}?>>
                                    <label for="categorySafetyAndHygiene" class="fs-6">安全衛生</label> <!--Safety and Hygiene-->
                                </td>

                                <td style="width:40%">
                                    <div>
                                        <input type="checkbox" id="categoryOther" name="category[]" class="form-check-input" value="4"style="vertical-align: middle;"
                                            <?php if(in_array(4,$category)) {echo 'checked';}?>>
                                        <label for="categoryOther" class="fs-6">その他</label>
                                        <input type="text" id="categoryOtherManual" value="" name="category_others_manual" placeholder="PLEASE SPECIFY"style="width:50%"class="input-main-form">
                                    </div>
                                </td> 
                            </tr>
                        </tbody>
                    </table>        
                </div>
                <div id="purposeDIV" class="purposeDIV" style="width:100%;">
                    <caption><b>目的、対象者</b></caption>
                    <table id="purposeTable" border="1" class="table table-hover rounded-3 overflow-hidden mainrecordT2" style="width:100%;">
                        <tr style="width: 100%;">
                            <td colspan="1" style="width:10%">目的：</td>
                            <td colspan="6"><input type="text" name="purpose" id="purposeID" value="<?php echo $purpose; ?>" style="width:96%" required class="input-main-form"></td>
                        </tr>
                        <tr>
                            <td colspan ="1" style="width:10%">対象者：</td>
                            <td style ="50%"><input type="text" name="audience" id="audienceID" value="<?php echo $audience;?>" style="width:92%" required class="input-main-form"></td>
                            <td colspan ="1" style="width:2.5%">名:</td>
                            <td style="width:2.5%"><span class="jqValue" id="jqValue"></span><input type="text" id="count_value" name="count_value" hidden class="count_value input-main-form" value=""></td>
                            <td style="width:20%"></td>
                            <td style="width:10%">
                                <span>OPEN：</span>
                            </td>
                            <td style="width:5%">
                                <input type="checkbox" class="checkbox" id="open-training" name="open-training" style="float: left;" value="1">
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="participantsDIV" class="participantsDIV">
                    <div class="header-participants" style="position:relative; margin-bottom: 20px;">
                        <div class="filter-reset" style="position:absolute">
                            <a class="btn btn-danger" id="reset-filter-btn" style="float:right;">リセット&nbsp;&nbsp;<i class="fa-solid fa-filter-circle-xmark"></i></a>
                        </div>
                        <div>
                            <caption><b>受講者（製造）</b></caption> 
                        </div>
                    </div>        
                    <table id="participantsTable" class="table table-hover table-bordered rounded-3 table-sm overflow-visible participantsT">
                        <thead class="table text-center theadstyle participants_thead" style="width: 98.5%;">
                            <tr id="firstrow" style="height: 40px;">
                                <th style="width:5%; vertical-align:middle;height:40px;"><input type="checkbox" class=""  id="select_all" onClick="toggle(this)" onchange="count()" style="vertical-align:middle;"></th>
                                <th style="width:11%; vertical-align:middle; height: 40px;">
                                    <div class="dropdown p-0">
                                        <button class="btn btn-GID-search" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">GID<i class="bi bi-caret-down float-right" id="GID_search_icon" style="float: right;"></i></button>
                                            <ul class="dropdown-menu p-2" style="width: 300px;" aria-labelledby="dropdownMenuButton1">
                                                <li><input type="search" name="GID_search" id="GID_search" class="dropdown-item" 
                                                    value = "" placeholder="Search GID">
                                                </li>
                                            </ul>
                                    </div>
                                </th>
                                <th style="width:18%; vertical-align:middle;height:40px;">
                                    <div class="dropdown p-0">
                                        <button class="btn btn-name-search" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">名前<i class="bi bi-caret-down float-right" id="GID_name_icon" style="float: right;"></i></button>
                                        <ul class="dropdown-menu p-2" style="width: 300px;" aria-labelledby="dropdownMenuButton1">
                                            <li><input type="search" name="GID_name" id="GID_name" class="dropdown-item" 
                                                value = "" placeholder="Search 名前">
                                            </li>
                                        </ul>
                                    </div>
                                    
                                </th>
                                <th style="width:6%; vertical-align:middle;height:40px;">
                                    <div class="shift-select-container p-0" style="width:100%;">
                                        <select data-selected-text-format="static" title="班" class="shift selectpicker form-control" data-size = "6" data-live-search = "true" style=""
                                            multiple id="input-shift-select" data-actions-box="true" aria-label="size 3 select example">
                                            <?php

                                                //Default Filter

                                                $query_shift_default = "SELECT distinct(shift_description) FROM users
                                                    INNER JOIN
                                                        shift on shift.shift_id = users.shift_id
                                                    WHERE
                                                        group_id = :group_id";
                                                $stmt_shift_default = $pdo->prepare($query_shift_default);
                                                $stmt_shift_default->bindParam(":group_id", $_SESSION["group_id"]);
                                                $stmt_shift_default->execute();

                                                $result_shift_default = $stmt_shift_default->fetchAll();
                                                foreach($result_shift_default as $row) {
                                                    $default_shift[] = $row["shift_description"];
                                                }

                                                


                                                //SAVED FILTER
                                                $query_shift_filter = "SELECT shift FROM filters
                                                WHERE
                                                    GID = :GID
                                                   ";
                                                $stmt_shift_filter = $pdo->prepare($query_shift_filter);
                                                $stmt_shift_filter->bindParam(":GID", $_SESSION["GID"]);
                                                $stmt_shift_filter->execute();
                                                $result_shift_filter = $stmt_shift_filter->fetchAll();
                                                $result_shift_filter_count = $stmt_shift_filter->rowCount();
                                                if($result_shift_filter_count > 0) {
                                                    foreach($result_shift_filter as $row_shift_filter) {
                                                       $saved_shift_filter = json_decode($row_shift_filter["shift"]);
                                                    }    
                                                }
                                                else {
                                                    //continue
                                                } 
                                                $query = "SELECT distinct(shift_description) FROM users
                                                    INNER JOIN 
                                                        shift ON users.shift_id = shift.shift_id
                                                    WHERE
                                                   /*     group_id = :group_id
                                                    AND  */
                                                        employee_resignation_id != '4'
                                                    
                                                    ORDER BY shift.shift_description ASC
                                                    ;";

                                                $stmt = $pdo->prepare($query);
                                               // $stmt->bindParam(":group_id", $group_); 
                                                $stmt->execute();
                                                $result = $stmt->fetchAll();
                                                foreach($result as $row)
                                                {
                                                    echo "<option name='checkbox_shift[]' value='$row[shift_description]' class='common_selector shift'
                                                    ";        
                                                    if(isset($saved_shift_filter)) {
                                                        if(in_array($row["shift_description"],$saved_shift_filter)) {
                                                            echo "selected";
                                                        }
                                                        else { //continue      
                                                        } 
                                                    }
                                                    else { 

                                                        if(in_array($row["shift_description"], $default_shift))
                                                            echo "selected";
                                                        else {
                                                            //continue
                                                        }

                                                    } 
                                                    echo ">$row[shift_description]</option>";
                                                }
                                            ?>
                                        </select>
                                    </div> 
                                </th>
                                <!--Group -->
                                <th style="width:11%; vertical-align:middle;height:40px;">

                                    <div class="group-select-container p-0" style="width:100%;">
                                        <select data-selected-text-format="static" title="G係" class="group selectpicker form-control" data-size = "6" data-live-search = "true" style=""
                                            multiple id="input-group-select" data-actions-box="true">
                                            
                                            <?php
                                                //SAVED FILTER
                                                $query_group_filter = "SELECT group_ FROM filters
                                                    WHERE
                                                        GID = :GID
                                                    ";                    
                                                $stmt_group_filter = $pdo->prepare($query_group_filter);
                                                $stmt_group_filter->bindParam(":GID", $_SESSION["GID"]);
                                                $stmt_group_filter->execute();
                                                $result_group_filter = $stmt_group_filter->fetchAll();
                                                $result_group_filter_count = $stmt_group_filter->rowCount();
                                                
                                                if($result_group_filter_count > 0) {
                                                    foreach($result_group_filter as $row_group_filter) {
                                                        if($row_group_filter["group_"] !== NULL) {
                                                            $saved_group_filter = json_decode($row_group_filter["group_"]);
                                                        }
                                                    }    
                                                }

                                                else { 
                                                    
                                                }
                                                
                                                $query = "SELECT DISTINCT(group_name) FROM users
                                                    INNER JOIN group_ ON users.group_id = group_.group_id
                                                    WHERE
                                                        employee_resignation_id != '4'
                                                    ORDER BY
                                                        group_name
                                                    ;";
                                                $stmt = $pdo->prepare($query);
                                                $stmt->execute();
                                                $result = $stmt->fetchAll();
                                                foreach($result as $row)
                                                    {
                                                        echo "<option name='checkbox_group[]' value='$row[group_name]' class='common_selector group_'
                                                        ";

                                                    if(isset($saved_group_filter)) {
                                                        if(in_array($row["group_name"],$saved_group_filter)) {
                                                            echo "selected";
                                                        }
                                                        else { //continue      
                                                        } 
                                                    }
                                                    else { //continue
                                                            if($row["group_name"] === $_SESSION["group_name"]) {
                                                                echo "selected";
                                                            }    
                                                        }
                                                    echo ">$row[group_name]</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </th>
                                <!--Process-->

                                <th style="width:15%; vertical-align:middle; height:40px;">
                                    <div class="process-select-container p-0" style="width:100%;">
                                        <select data-selected-text-format="static" title="工程" class="process selectpicker form-control" data-size = "6" data-live-search = "true" style=""
                                            multiple id="input-process-select" data-actions-box="true">
                                            <?php

                                                //Default process

                                                $query_process_default = "SELECT distinct(department_name) FROM users
                                                    INNER JOIN
                                                        department ON department.department_id = users.department_id
                                                    WHERE
                                                        group_id = :group_id";
                                                $stmt_process_default = $pdo->prepare($query_process_default);
                                                $stmt_process_default->bindParam(":group_id", $_SESSION["group_id"]);
                                                $stmt_process_default->execute();

                                                $result_process_default = $stmt_process_default->fetchAll();
                                                foreach($result_process_default as $row) {
                                                    $default_process[] = $row["department_name"];
                                                }

                                              
                                                //SAVED FILTER
                                                
                                                $query_process_filter = "SELECT department FROM filters
                                                    WHERE
                                                        GID = :GID
                                                    ";
                                                
                                                $stmt_process_filter = $pdo->prepare($query_process_filter);
                                                $stmt_process_filter->bindParam(":GID", $_SESSION["GID"]);
                                                $stmt_process_filter->execute();
                                                
                                                $result_process_filter = $stmt_process_filter->fetchAll();
                                                $result_process_filter_count = $stmt_process_filter->rowCount();
                                                
                                                if($result_process_filter_count > 0) {
                                                    foreach($result_process_filter as $row_process_filter) {
                                                        $saved_process_filter = json_decode($row_process_filter["department"]);
                                                    }    
                                                }
                                                
                                                $query = "SELECT DISTINCT(department_name) FROM users
                                                    INNER JOIN 
                                                        department ON users.department_id = department.department_id
                                                    WHERE
                                                    /*    group_id = :group_id
                                                    AND */
                                                        employee_resignation_id != '4'
                                                    ;";
                                                $stmt = $pdo->prepare($query);
                                                //$stmt->bindParam(":group_id", $group_);
                                                $stmt->execute();
                                                $result = $stmt->fetchAll();
                                                foreach($result as $row)
                                                    {
                                                        echo "<option name='checkbox_process[]' value='$row[department_name]' class='common_selector process'
                                                        ";

                                                        if(isset($saved_process_filter)) {
                                                            if(in_array($row["department_name"],$saved_process_filter)) {
                                                                echo "selected";
                                                            }
                                                            else { //continue      
                                                            } 
                                                        }
                                                        else { //continue
                                                            if(in_array($row["department_name"], $default_process)) {
                                                                echo "selected";
                                                            }
                                                            else {
                                                                //continue
                                                            }
                                                        }
                                                        echo ">$row[department_name]</option>"; 
                                                    }
                                            ?>
                                        </select>
                                    </div>
                                </th>
     
                                <!--building-->
                                <th style="width:8%; vertical-align:middle; height:40px;">
                                    <div class="building-select-container p-0" style="width:100%;">
                                        <select data-selected-text-format="static" title="号棟" class="building selectpicker form-control" data-size = "6" data-live-search = "true" style=""
                                            multiple id="input-building-select" data-actions-box="true">
                                            <?php

                                            //Default Building

                                            $query_building_default = "SELECT distinct(building_id) FROM users
                                                WHERE
                                                    group_id = :group_id
                                                AND
                                                    employee_resignation_id != '4'
                                            ";
                                            $stmt_building_default = $pdo->prepare($query_building_default);
                                            $stmt_building_default->bindParam(":group_id", $_SESSION["group_id"]);
                                            $stmt_building_default->execute();

                                            $result_building_default = $stmt_building_default->fetchAll();
                                            foreach($result_building_default as $row) {
                                                $default_building[] = $row["building_id"];
                                            }

                                            //Saved Building Filter

                                            $query_building_filter = "SELECT building FROM filters
                                            WHERE
                                                GID = :GID
                                                ";

                                            $stmt_building_filter = $pdo->prepare($query_building_filter);
                                            $stmt_building_filter->bindParam(":GID", $_SESSION["GID"]);
                                            $stmt_building_filter->execute();

                                            $result_building_filter = $stmt_building_filter->fetchAll();
                                            $result_building_filter_count = $stmt_building_filter->rowCount();

                                            if($result_building_filter_count > 0) {
                                                foreach($result_building_filter as $row_building_filter) {
                                                    $saved_building_filter = json_decode($row_building_filter["building"]);
                                                }    
                                            }

                                            else {
                                                //continue
                                            } 

                                            $query = "SELECT DISTINCT(users.building_id),building_name FROM users
                                                INNER JOIN
                                                    buildings ON buildings.building_id = users.building_id
                                                /*WHERE
                                                    group_id = :group_id
                                                */  
                                                ORDER by
                                                    building_name ASC
                                                ";
                                            $stmt = $pdo->prepare($query);
                                            /*$stmt->bindParam(":group_id", $group_);*/
                                            $stmt->execute();
                                            $result = $stmt->fetchAll();
                                            foreach($result as $row)
                                                {
                                                    echo "<option name='checkbox_building[]' value='$row[building_id]' class='common_selector building'";

                                                    if(isset($saved_building_filter)) {
                                                        if(in_array($row["building_id"],$saved_building_filter)) {
                                                            echo "selected";
                                                        }
                                                        else { //continue      
                                                        } 
                                                    }
                                                    else { 
                                                        if(in_array($row["building_id"], $default_building)) {
                                                            echo "selected";
                                                        }
                                                        else {
                                                            //continue
                                                        }
                                                    } 

                                                    echo ">$row[building_name]</option>";

                                                }
                                            
                                            ?>
                                        </select>
                                    </div>
                                </th>
                                <!--Position-->
                                <th style="width:10%; vertical-align:middle; height:40px;">
                                    <div class="position-select-container p-0" style="width:100%;">
                                        <select data-selected-text-format="static" title="役職" class="position selectpicker form-control" data-size = "6" data-live-search = "true" style=""
                                            multiple id="input-position-select" data-actions-box="true">
                                            <?php

                                            //Default position filter
                                            
                                            $default_position = array();
                                            $query_default_position = "SELECT position_level, users.position_id, position FROM users
                                                INNER JOIN
                                                    position ON users.position_id = position.position_id
                                                WHERE
                                                    position_level < :position_level
                                            ";

                                            $stmt_default_position = $pdo->prepare($query_default_position);
                                            //$stmt_default_position->bindParam(":group_id", $_SESSION["group_id"]);
                                            $stmt_default_position->bindParam(":position_level", $_SESSION["position_level"]);
                                            $stmt_default_position->execute();
                                            $result_default_position = $stmt_default_position->fetchAll();
                                            $result_default_position_count = $stmt_default_position->rowCount();

                                            if($result_default_position_count > 1) {
                                                foreach($result_default_position as $row) {
                                                    $default_position[] = $row["position_id"];
                                                } 
                                            }

                                            //SAVED FILTER
                                            $query_position_filter = "SELECT position FROM filters
                                            WHERE
                                                GID = :GID
                                                ";
                                            
                                            $stmt_position_filter = $pdo->prepare($query_position_filter);
                                            $stmt_position_filter->bindParam(":GID", $_SESSION["GID"]);
                                            $stmt_position_filter->execute();
                                            
                                            $result_position_filter = $stmt_position_filter->fetchAll();
                                            $result_position_filter_count = $stmt_position_filter->rowCount();
                                            
                                            if($result_position_filter_count > 0) {
                                                foreach($result_position_filter as $row_position_filter) {
                                                    $saved_position_filter = json_decode($row_position_filter["position"]);
                                                }    
                                            } 
                                            $query = "SELECT DISTINCT(users.position_id),position_level, position FROM users
                                                INNER JOIN
                                                    position ON position.position_id = users.position_id
                                               /* WHERE
                                                    group_id = :group_id */
                                                ORDER by 
                                                    position_level ASC
                                                ;";
                                            $stmt = $pdo->prepare($query);
                                           // $stmt->bindParam(":group_id", $group_);
                                            $stmt->execute();
                                            $result = $stmt->fetchAll();
                                            $position_id_default = [];
                                            foreach($result as $row)
                                                {
                                                    echo "<option name='checkbox_position[]' value='$row[position_id]' class='common_selector position'";

                                                    if(isset($saved_position_filter)) {
                                                        if(in_array($row["position_id"],$saved_position_filter)) {
                                                            echo "selected";
                                                        }
                                                        else { //continue      
                                                        } 
                                                    }
                                                    else { //continue
                                                        if($_SESSION["position_level"] > $row["position_level"]) {
                                                            echo "selected";
                                                        }
                                                    }
                                                    
                                                    echo ">$row[position]</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                   
                                </th>

                                <!--Employee Status -->
                                <th style="width:16%; vertical-align:middle; height:40px;">

                                    <div class="employee-status-select-container p-0" style="width:100%;">
                                        <select data-selected-text-format="static" title="従業員ステータス" class="employee-status selectpicker form-control" data-size = "6" data-live-search = "true" style=""
                                            multiple id="input-employee-status-select" data-actions-box="true">
                                            
                                            <?php
                                                
                                                //Default values for employee status 

                                                $employee_default_checked = ['国内出向中','国内出張中','太陽電気','海外出張中','玉村在籍','産休中','育休中','サンエス','ミナカミテック','休職中','割田','配信停止'];
                                                //SAVED FILTER
                                                
                                                $query_default_employee_status = "SELECT distinct(employee_status_name) FROM users
                                                    INNER JOIN
                                                        employee_status ON users.employee_status_id = employee_status.employee_status_id
                                                    WHERE
                                                        group_id = :group_id
                                                    AND
                                                        employee_resignation_id != '4'
                                                ";

                                                $stmt_default_employee_status = $pdo->prepare($query_default_employee_status);
                                                $stmt_default_employee_status->bindParam(":group_id", $_SESSION["group_id"]);
                                                $stmt_default_employee_status->execute();

                                                $result_default_employee_status = $stmt_default_employee_status->fetchAll();

                                                foreach($result_default_employee_status as $row) {
                                                    if(in_array($row["employee_status_name"], $employee_default_checked)) {
                                                        $employee_default_employee_status[] = $row["employee_status_name"];
                                                    }

                                                    else {
                                                        //continue
                                                    }
                                                }

                                                $query_employee_status_filter = "SELECT employee_status FROM filters
                                                WHERE
                                                    GID = :GID
                                                    ";
                                                 
                                                $stmt_employee_status_filter = $pdo->prepare($query_employee_status_filter);
                                                $stmt_employee_status_filter->bindParam(":GID", $_SESSION["GID"]);
                                                $stmt_employee_status_filter->execute();
                                                 
                                                $result_employee_status_filter = $stmt_employee_status_filter->fetchAll();
                                                $result_employee_status_filter_count = $stmt_employee_status_filter->rowCount();
                                                 
                                                if($result_position_filter_count > 0) {
                                                      foreach($result_employee_status_filter as $row_employee_status_filter) {
                                                         $saved_employee_status_filter = json_decode($row_employee_status_filter["employee_status"]);
                                                    }    
                                                } 

                                                $query = "SELECT DISTINCT(users.employee_status_id),employee_status_name FROM users

                                                    INNER JOIN 
                                                        employee_status ON employee_status.employee_status_id = users.employee_status_id 
                                                    /*WHERE
                                                        group_id = :group_id */
                                                    ORDER BY 
                                                        users.employee_status_id ASC;
                                                    ";
                                                $stmt = $pdo->prepare($query);
                                                //$stmt->bindParam(":group_id", $group_);
                                                $stmt->execute();
                                                $result = $stmt->fetchAll();
                                                foreach($result as $row)
                                                    {
                                                        echo "<option name='checkbox_employee_status[]' value='$row[employee_status_name]' class='common_selector employee-status'";

                                                        if(isset($saved_employee_status_filter)) {
                                                            if(in_array($row["employee_status_name"],$saved_employee_status_filter)) {
                                                                echo "selected";
                                                            }
                                                            else { //continue      
                                                            } 
                                                        }
                                                        else { //continue
                                                            if(in_array($row["employee_status_name"], $employee_default_employee_status)) {
                                                                echo "selected";
                                                            }
                                                        }
                                                        
                                                        echo ">$row[employee_status_name]</option>";
                                                    }
                                            ?>        
                                </th>
                            </tr>
                        </thead>
                        <div class="testing-only">
                        <tbody id="post_list" class="participants_tbody">
                            <div class="loading-screen" style="display:none;">
                                    <dotlottie-player 
                                    src="https://lottie.host/3827ada8-97bd-4b44-8b42-2837434748df/5xzBlkIfd9.lottie"
                                    background="transparent"
                                    speed="1"
                                    style="width: 300px; height: 300px"
                                    loop
                                    autoplay
                                    display 
                                    ></dotlottie-player>
                            </div>
                        </tbody>

                        </div>
                      
                    </table>                 
                </div> 

                <?php

                if(isset($_GET["training_id"])) {

                echo "
                <div class='reference_material_div'>
                    <table class='table table-bordered table-hover rounded-3 overflow-hidden reference_material_T' id='files_table'>
                        <thead class='table text-center theadstyle reference_material_thead' style='width: 98.5%;'>
                            <th style='width:10%;'>No.</th>
                            <th style='width:65%;'>Reference Materials</th>
                            <th style='width:12.5%;'>Download</th>
                            <th style='width:12.5%;'>Files</th>
                        </thead>
                        <tbody id='post_list_add_files' class='files_tbody'>
                        </tbody>
                    </table>
                </div>  
                
                <div class='upload_div'>
                    <div class='mb-3'>
                        <input class='form-control file-multiple' type='file' id='file-upload' name='file[]' style='width:50%; background-color:lightyellow;' multiple>
                        
                    </div>
                </div>";
                }

                else {
                    echo "
                    <span style = 'font-size: 10px; text-align:left;'>ファイルタイプ: 'jpg'、'jpeg'、'png'、'pdf'、'xlsx'、'docs'、'xls'、'docx'、'ppt'、'pptx'、'csv'、'doc'
                    「ファイルは4つまで、容量は8Mまで」</span>
                    <div class='upload_div'>
                    
                        <div class='mb-3'>
                            <input class='form-control' type='file' id='file-upload' name='file[]' style='width:50%; background-color:lightyellow;' multiple>
                        </div>
                    </div>
                    ";
                }

                ?>
                <div id="contentsDIV" class="contentsDIV">
                    <caption><b>内容</b></caption><br>
                    <span style = 'font-size: 10px; text-align:left; float:left;'>最大 150 文字</span>
                    <table id="contentsTable" border="1" class="contentsT">
                        <tr>
                            <td><textarea maxlength="150" type="text" name="contents" id="contentsID" value="" class="contentsInput" maxlength="150" rows="3" required><?php  echo $contents; ?></textarea></td>
                        </tr>
                    </table>
                </div>
                <div id="usageDIV">
                <caption><b>使用資料（作業標準がある場合には、作業標準№を記入、ない場合には資料名等を記入）</b></caption><br>
                <span style = 'font-size: 10px; text-align:left;  float:left;'>最大 150 文字</span>
                    <table id="usageTable" border="1" class="usageT">
                        <tr>
                            <td colspan="4"><textarea type="text" name="usage_" id="usage-materials" value="" rows="3" class="usageInput" maxlength="150" required><?php echo $usage_id; ?></textarea></td>
                        </tr>
                    </table>
                </div>
                <div id="confirmation_by" class="confirmation_by_div">
                    <caption style="text-align:center;"><b>教育効果の確認方法、確認予定日</b></caption>
                    <table id="confirmation_table" border="1" class="table table-hover rounded-3 overflow-hidden mainrecordT2">
                        <tr>
                            <td colspan="4" style="width:100%">
                                <input type="text" name="confirmation_by"
                                    value ="<?php 
                                        if(isset($confirmation_by)) {
                                            echo $confirmation_by;
                                        }
                                    ?>"
                                id="confirmation_by_id" class="input-main-form" style="width:100%" required>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="1" style="width:25%; vertical-align:middle;">最終確認予定日：</td>
                            <td colspan="1" style="width:25%"><input type="datetime-local" name="confirmation_date" class="input-main-form" id="confirmation_date_id" value="<?php if(isset($cofirmation_date)) {echo $confirmation_date; } ?>" style="width:90%" required></td>
                            <td colspan="1"></td>
                            <td colspan="1"></td>
                        </tr>
                    </table>
                </div>
                    <button type="submit" id ="submit_button" class="btn btn-primary mb-3" style="float:right; width:150px; margin-right:20px;">
                    送信&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa-solid fs-6 fa-file-export"></i>
                    </button>
            
            </form>   
            </div>

            
            </div> <!--paddin-->
        </div> <!--col-->
    </div> <!--row-->
</div> <!--container-fluid-->  

<!-----SCRIPT------>
<!--jQuery and Bootstrap javascript
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
Bootstrap/jQuery Select picker
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css"/>-->


<script type="text/javascript">

/**Participants**/


$(document).ready(function() {


    var $loading = $(".loading-screen").hide();
    initialize_icon();

    change_icon();

    function initialize_icon() {
        if($('input[name="checkbox_position[]"]:checked').length > 0) {
            $("#position_icon").attr("class", "bi bi-funnel-fill");
        }
        else {
            $("#position_icon").attr("class", "bi bi-caret-down");
        }

        if($('input[name="checkbox_employee_status[]"]:checked').length > 0) {
            $("#employee_status_icon").attr("class", "bi bi-funnel-fill");
        }
        else {
            $("#employee_status_icon").attr("class", "bi bi-caret-down");
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

    }
    
    //Open Training

    $("#open-training").on("change", function () {
        
        if($("#open-training").is(':checked')) {
            $("#participantsDIV").attr("class", "d-none");
        }

        else {
            $("#participantsDIV").attr("class", "participantsDIV");
        }
    });

    //Reset filter
    
    $("#reset-filter-btn").on("click", function() {

        $("#input-shift-select").val("").trigger("change");
        $("#input-shift-select").selectpicker("val","");

        //Set Default for shift

        var default_shift = <?php echo json_encode($default_shift); ?>;
        var shift_selection = $("#input-shift-select option[name='checkbox_shift[]']");
        
        $.each(shift_selection, function () {
            
            var this_shift = $(this).val();
            if(jQuery.inArray(this_shift, default_shift) !== -1) {
                $(this).prop('selected', true).trigger("change");
            }
            else {
                $(this).prop('selected', false).trigger("change");
            }
            
        });

        $("#input-group-select").selectpicker("val","");
        $("#input-group-select option[value ='<?php echo $_SESSION["group_name"];?>']").prop("selected", true).trigger("change");
        
        $("#input-process-select").val("").trigger("change");
        $("#input-process-select").selectpicker("val","");

        //Set Default for process

        var default_process = <?php if(isset($default_process)) { echo json_encode($default_process); }  ?>;
        var process_selection = $("#input-process-select option[name='checkbox_process[]']");

        $.each(process_selection, function () {
            
            var this_process = $(this).val();
            if(jQuery.inArray(this_process, default_process) !== -1) {
                $(this).prop('selected', true).trigger("change");
            }
            else {
                $(this).prop('selected', false).trigger("change");
            }
            
        });

        $("#input-building-select").val("").trigger("change");
        $("#input-building-select").selectpicker("val","");

        //Set Default for Building

        
        var default_building = <?php echo json_encode($default_building); ?>;
        var building_selection = $("#input-building-select option[name='checkbox_building[]']");

        $.each(building_selection, function () {
            
            var this_building = $(this).val();
            if(jQuery.inArray(this_building, default_building) !== -1) {
                $(this).prop('selected', true).trigger("change");
            }
            else {
                $(this).prop('selected', false).trigger("change");
            }
            
        });

        $("#GID_search").val("");
        $("input[name='checkbox_sign_progress[]']").prop('checked', false);
        $("#sign_progress_icon").attr("class", "bi bi-caret-down");
        $("#GID_name").val("");
        $("#GID_name_icon").attr("class", "bi bi-caret-down");

        //Set Default checkbox for position
        var position = <?php echo $_SESSION["position_level"]; ?>;        
        var position_array_checked = $("#input-position-select option[name='checkbox_position[]']");
        var default_position = <?php echo json_encode($default_position); ?>;

        console.log(default_position);

        $.each(position_array_checked, function () {
            var this_position = $(this).val();

            if(jQuery.inArray(this_position, default_position) !== -1) {
                $(this).prop('selected', true).trigger("change");
                console.log("yes nagtrigger to");
            }
            else {
                $(this).prop('selected', false).trigger("change");
            }
             
        }); 
 

        //Set Default checkbox for employee status

        var employee_status_array_checked = $("#input-employee-status-select option[name='checkbox_employee_status[]']");
        
        $.each(employee_status_array_checked, function () {
            var employee_status_value = $(this).val();

            //var employee_status_default = ['国内出向中','国内出張中','太陽電気','海外出張中','玉村在籍','産休中','育休中','サンエス','ミナカミテック','休職中','割田','配信停止'];

            var employee_status_default = <?php echo json_encode($employee_default_employee_status); ?>;
            //  var employee_status_default = [];
            if(jQuery.inArray(employee_status_value, employee_status_default) !== -1) {
                $(this).prop('selected', true).trigger("change");
                //console.log("gumagana yung sa employee status");
            }
            else {
                $(this).prop('selected', false).trigger("change");
            }
        });
        
        $("#input-building-select").selectpicker("refresh");
        $("#input-process-select").selectpicker("refresh");
        $("#input-shift-select").selectpicker("refresh");
        $("#input-group-select").selectpicker("refresh");
        $("#input-employee-status-select").selectpicker("refresh");
        $("#input-position-select").selectpicker("refresh");
        reset_data();
       // change_icon();

      //filter_data();
        
        
    });

    function reset_data() {
        var reset_process = 1
        var reset_shift = 1

        $.ajax({
          url: "includes/reset_data_filter.inc.php",
          method: "POST",
          data: {reset_process:reset_process, reset_shift:reset_shift},
          success:function(data){
           // console.log("yehey it works");
           
           filter_data();
          }
      });


    }
    //Clear Button - clear the input fields except participants

    $("#clear_button").on("click", function() {

        $("#educationID").val("");
        $("#term").val("");
        $("#datetime_regular_start").val("");
        $("#datetime_a_start").val("");
        $("#datetime_b_start").val("");
        $("#datetime_c_start").val("");
        $("#datetime_d_start").val("");
        $("#datetime_regular_end").val("");
        $("#datetime_a_end").val("");
        $("#datetime_b_end").val("");
        $("#datetime_c_end").val("");
        $("#datetime_d_end").val("");
        $("#location_regular").val("");
        $("#location_a").val("");
        $("#location_b").val("");
        $("#location_c").val("");
        $("#location_d").val("");
        $('select[name=instructor_regular]').selectpicker('val', '');
        $('select[name=instructor_a]').selectpicker('val', '');
        $('select[name=instructor_b]').selectpicker('val', '');
        $('select[name=instructor_c]').selectpicker('val', '');
        $('select[name=instructor_d]').selectpicker('val', '');
        $("input[name='category[]']").prop('checked', false); // Unchecks it
        $("#categoryOtherManual").val("");
        $("#purposeID").val("");
        $("#audienceID").val("");
        $("#file-upload").val("");
        $("#contentsID").val("");
        $("#usage-materials").val("");
        $("#confirmation_by_id").val("");
        $("#confirmation_date_id").val("");  

    });

    //Check the file extension 

    var file_selection;

    $("#file-upload").change(function () {

        file_selection = $("#file-upload");

        var count_files_upload = file_selection[0].files.length;

        if(count_files_upload > 4) {
            alert("Please upload a maximum of 4 files");
            $('#file-upload').val("");
        }
        //console.log(count_files_upload);

        var fileExtension = ['jpg','jpeg','png','pdf','xlsx','docs','xls','docx','ppt','pptx','csv','doc'];
        var total_size = 0;
         for (var i = 0; i< count_files_upload; i++) {
            var current_file = file_selection[0].files[i].name.split('.').pop().toLowerCase();      
          //  console.log(file_selection[0].files[i].name);
         //   console.log(file_selection[0].files[i].size);

            total_size = total_size + file_selection[0].files[i].size;

            if(total_size > 8388608) {
                alert("容量MAXは8MBまでです。");
                $('#file-upload').val("");
           
            }

            if ($.inArray(current_file, fileExtension) == -1) {
                alert("'jpg'、'jpeg'、'png'、'pdf'、'xlsx'、'docs'、'xls'、'docx'、'ppt'、'pptx'、'csv'、'doc' しかアップロードできません。");
                $('#file-upload').val("");
           
            } 
        }
        
    }); 


    //Check if there is an upload file

    $("#file-upload").change(function() {
        if ($('#file-upload').get(0).files.length === 0) {
            $("#usage-materials").attr("required", true);
        }
        else {
            $("#usage-materials").attr("required", false);
        }
    });

 

   $(".new-form-tab").addClass("active");

    add_files_data();

    $("#new-form").on("submit", function() {

        //Check Term, should be 3 digits

        var term_id_digit = $("#term").val();
            function is_two_digit(term_id_digit) {
                var regex = /^\d{2}$/;
                return regex.test(term_id_digit);
            }

            function is_three_digit(term_id_digit) {
                var regex = /^\d{3}$/;
                return regex.test(term_id_digit);
            }

         

            if(term_id_digit !== "") {
                /*if(is_two_digit(term_id_digit) === true) {
                    //continue
                }

                else {
                    alert("半角でお願いします。");
                    return false;
                } */

                
                switch(true) {

                    case(is_two_digit(term_id_digit) === true):
                        //continue
                        break;
                    case(is_three_digit(term_id_digit) === true):
                        //continue
                        break;
                    default:
                        alert("半角でお願いします。");
                        return false;
                    
                }

            }

            else {
                alert("半角でお願いします。");
                return false;
            }
        checked = $('input[name="GIDcheck[]"]:checked').length;

        checked_2 = $('input[name="category[]"]:checked').length;

        if(!checked) {
            if(confirm("受講者は選択されていません。そのまま教育訓練記録を作成しますか?")) {
                ("#new-form").submit();
            }
            else {
                return false;
            }
           // return false;
        }
        
        if(!checked_2) {
            alert("You must select at least one category!");
            return false;
        }
    });


    //Test Select Picker

    $('#input-shift-select').change(function() {
        change_icon();
        filter_data();
    });

    $('#input-group-select').change(function() {
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

    $('#input-position-select').change(function() {
        change_icon();
        filter_data();
    });

    $('#input-employee-status-select').change(function() {
        change_icon();
        filter_data();
    });

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
        if($('#input-position-select :selected').length > 0) {
            $('.position').removeClass("none-position").addClass("selected-position");
        }
        else {
            $('.position').removeClass("selected-position").addClass("none-position"); 
        }
        if($('#input-employee-status-select :selected').length > 0) {
            $('.employee-status').removeClass("none-employee-status").addClass("selected-employee-status");
        }
        else {
            $('.employee-status').removeClass("selected-employee-status").addClass("none-employee-status"); 
        }

    }

    filter_data();
    function filter_data() {
      
        //$('#post_list').html();
      var action = 'fetch_data';
      var shift = get_filter('shift');
      var group_ = get_filter('group_');
      var process = get_filter('process');
      var building = get_filter('building');
      var participants = get_filter('participants');
      var position = get_filter('position');
      var employee_status = get_filter('employee-status');
      var participants_subtract = get_filter_uncheck('participants');
      var GID_search = $('#GID_search').val();
      var GID_name = $('#GID_name').val();
    
      
      
     // $loading.show();

      $.ajax({

            url: "includes/fetch_data.inc.php",
            method: "POST",
            data: {action:action,shift:shift,process:process,building:building,participants:participants,
            position:position,employee_status:employee_status,GID_search:GID_search,GID_name:GID_name,group_:group_},
    
                success:function(data){
            $("#post_list").html(data);
            
            count();
            }
         
      });
    }

    function get_filter(class_name)
    {
        var filter = [];
    
    $('.'+class_name+':checked').each(function(){
        filter.push($(this).val());
    });
    //alert(filter);
    return filter;
    }



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

  /*  $('#GID_name').keyup(function(event){

    if($("#GID_name").val() !== "") {
        $("#GID_name_icon").attr("class","bi bi-funnel-fill");
    }
    else {
        $("#GID_name_icon").attr("class","bi bi-caret-down");
    }

    event.preventDefault();
    filter_data();

    }); */

    $("#GID_name").on("input", function() { 
    // update panel

        if($("#GID_name").val() !== "") {
            $("#GID_name_icon").attr("class","bi bi-funnel-fill");
        }
        else {
            $("#GID_name_icon").attr("class","bi bi-caret-down");
        }

        event.preventDefault();
        filter_data();
    });

    //count checkbox icon shift
    
  $('.common_selector').click(function(){

   // if($('input[name="checkbox_shift[]"]:checked').length > 0) {
   //     $("#shift_icon").attr("class", "bi bi-funnel-fill");
   // }
   // else {
   ///     $("#shift_icon").attr("class", "bi bi-caret-down");
   // }

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

    if($('input[name="checkbox_position[]"]:checked').length > 0) {
        $("#position_icon").attr("class", "bi bi-funnel-fill");
    }
    else {
        $("#position_icon").attr("class", "bi bi-caret-down");
    }

    if($('input[name="checkbox_employee_status[]"]:checked').length > 0) {
        $("#employee_status_icon").attr("class", "bi bi-funnel-fill");
    }
    else {
        $("#employee_status_icon").attr("class", "bi bi-caret-down");
    }

    filter_data();
        
  });

  $('#select_all').click(function(){
        if(this.checked) {
            filter_data();
        }
        if(!this.checked) {       
            subtract_data();              
        }
      
});
 
    $('#participantsTable tbody').on('click', '.common_selector',function(){
        if(this.checked) {
            filter_data();
        }
        if(!this.checked) {            
            subtract_data();
        }
  });


  //uncheck participants
  function get_filter_uncheck (class_name){
    var filter = [];
    
    $('.'+class_name+':not(:checked)').each(function(){
        filter.push($(this).val());
    });
    //alert(filter);
    return filter;
  }

  function subtract_data () {
        var participants_subtract = get_filter_uncheck('participants');
      //console.log(participants);
      
      $.ajax({
          url: "includes/fetch_data.inc.php",
          method: "POST",
          data: {participants_subtract:participants_subtract},
          success:function(data){
         //   console.log("success");
          }
      });
  }

  //add files

  var file_count;
    function add_files_data() {
        //$('#post_list_add_files').html();
        var action ='fetch_data';
        $.ajax({
        url: "includes/fetch_data_add_files_copy_form.inc.php",
        method: "POST",
        data: {action:action},
        success:function(data){ 
         //   console.log("success");
            $('#post_list_add_files').html(data);
            file_count = $('#post_list_add_files').html(data).find('tr').length;
            if (file_count === 0) {
            $("#usage-materials").attr("required", true);
            }
            else {
                $("#usage-materials").attr("required", false);
            }
        },
        error:function(data){
          
        }
        });
    }

    $("#update-form").on("submit", function() { 

         


    });
    


});


function toggle(source) {
    checkboxes = document.getElementsByName('GIDcheck[]');
    for(var i=0, n=checkboxes.length;i<n;i++) {    
    checkboxes[i].checked = source.checked;  
    }
}

function count() {
    var checkedboxes = $('input[name="GIDcheck[]"]:checked').length;
    $('.jqValue').html(checkedboxes);
   // console.log(checkedboxes);
    document.getElementById("count_value").value = checkedboxes;

}


//function for save filter






</script>

</body>
</html>

