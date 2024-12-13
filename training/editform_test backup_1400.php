<?php


    include_once 'navigation_test.php'; 
    include('includes/edit_form_test.inc.php');

    //$category_array = array ();
    //$category_array = $_SESSION["category"];
    //$creation_department = $_SESSION["creation_department"];
    $_SESSION["creation_department"] = $creation_department;
    $department = $_SESSION["department"];
    $group_ = $_SESSION["group_id"];
    $_SESSION["training_id"] = $training_id;
    //$training_id = $_SESSION["training_id"];

    if(isset($_SESSION["participants_selected"])) {
        unset($_SESSION["participants_selected"]);
    }

    if(isset($_SESSION["checked_participants"])) {
        unset($_SESSION["checked_participants"]);
    }
    
    $input_status = "";
    if($creation_department !== $department) {
        $input_status = "disabled";
    }
    else {
        //continue
    }

?>
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
</style>
         <!-----------REGISTRATION FORM----------->
         
        <div class="main w-100" id="main" style="height:87%;">           
            <div class="col new-form-header" id="alert_window_card" style="position:absolute; float:left;">
                    <?php 
                        if (isset($_GET["error"])) {
                                if ($_GET["error"] === "training_id_duplicate") {
                                echo "                               
                                <div class='alert alert-danger alert-dismissible fade show pt-2 pb-2' role='alert'>
                                    DUPLICATE TRAINING ID!
                                    <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>      
                                ";
                                
                                
                                }
                        }
                        if (isset($_GET["success"])) {
                            if($_GET["success"] === "updated") {
                                echo "                               
                                <div class='alert alert-success alert-dismissible fade show pt-2 pb-2' role='alert'>
                                    $_GET[training_id]が正常に更新されました
                                    <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>      
                                "; 
                            }
                        }

                        if(isset($_GET["error"])) {

                            if($_GET["error"] === "file_type") {
                                
                                echo "
                                <div class='alert alert-danger alert-dismissible fade show pt-2 pb-2' style='bottom: 45px;' role='alert'>
                                        エラー：ファイルはアップロードできません。
                                        ファイル形式： 'jpg','jpeg','png','pdf','xlsx','docs','xls','docx','ppt','pptx','csv', 'doc'
                                    <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>
                                    ";
                            }
                        }
                        
                        ?>
            </div>
            <form action="includes/update_form.inc.php" method="post" id="update-form" enctype="multipart/form-data">
            <div class="all-header w-100"  style="position:relative;  margin-bottom:15px;">
                <div class="new-form-header">
                    <button type="button" <?php if($creation_department !== $_SESSION["department"]) { echo "disabled"; }?> id ="clear_button" class="btn btn-danger mb-3" style="font-size: 14px; float:left; width:100px; margin-right:20px; position:absolute;" onclick="">
                    内容クリア
                    </button>
                </div>
                <div id="creationdepartment" class="header-1">
                    <h4><b>作成部署: 製造部</b></h4>         
                </div> 
            </div>
            <hr>
            <div id="mainrecord" style="width:100%;">
                <table style="width:100%; table-layout:fixed;" id="mainrecordTable" border="1" class="table table-sm table-hover rounded-3 mainrecordT2 overflow-visible">
                    <tr style="width:100%">
                        <td style="width:10%;">
                            <span>名称：</span>
                        </td>
                        <td style="width:45%;">
                            <input type="text"
                                name="educationID" id="educationID" maxlength="49" value="<?php echo $training_name; ?>" required class="input-main-form w-100"
                                <?php if($department !== $creation_department) {
                                    echo "disabled";
                                    }
                                ?>
                            >
                        </td>
                            <td class="w-5">
                                <span>工程： <?php echo $process_prefix;?></span>
                                <input hidden name="process_prefix" id="process_prefix_id"
                                    value="<?php echo $process_prefix; ?>" class="input-main-form">        
                            </td>
                            <td class="w-5">
                                <input type="text" value="<?php echo $process_suffix;?>" name="process_suffix" id="process_suffix_id"
                                class="input-main-form w-100"
                                <?php if($department !== $creation_department) {
                                    echo "disabled";
                                }
                                ?>
                                >
                            </td>
                            <td class="w-10">
                                <input required type="text" maxlength="4" id="term" name="term" value="<?php echo $term; ?>" style="width: 30%;" class="input-main-form w-100"
                                    <?php if($department !== $creation_department) {
                                        echo "disabled";
                                    }
                                    ?>
                                >
                                                      
                            </td>
                            <td class="w-5"><span>期</span></td>
                            <td class="w-10">
                                <input type='radio' 
                                    <?php
                                        if($department !== $creation_department) {
                                            echo "disabled";
                                        }
                                        ?>
                                        id='trainingLocInternal' name='trainingLoc' value='1'
                                        <?php
                                        if($area == '1') {
                                        echo "checked"; 
                                        }
                                    ?>
                                >
                                <label for='trainingLocInternal'>社内</label>
                            </td>
                            <td class="w-10">
                                <input type='radio' 
                                    <?php
                                        if($department !== $creation_department) {
                                            echo "disabled";
                                        }
                                        ?>
                                        id='trainingLocExternal' name='trainingLoc' value='2'
                                        <?php
                                        if($area =='2') {
                                        echo "checked"; 
                                    }
                                    ?>
                                >
                                <label for='trainingLocExternal'>社外</label> 
                            </td>       
                        </tr>
                </table>
                
                    <!-- FROM NEW FROM-->

                    <table id="mainrecordTable2" class="table table-hover table-sm rounded-3 overflow-visible mainrecordT2" style="width: 100%; table-layout:fixed;">
                        <tr style="width:100%;">
                            <td style="width:14%;">
                                <span>日勤者実施日時：</span>
                            </td>
                            <td style="vertical-align:middle; width:18%;">
                                <input <?php echo $input_status; ?> style="font-size: 12px !important;" type="datetime-local" name="datetime_regular_start" id="datetime_regular_start" value="<?php echo $start_time_regular; ?>" class="input-main-form w-100" >
                            </td>
                            <td style="width:2%;">~</td>
                            <td style="vertical-align:middle; width:18%;">
                                <input <?php echo $input_status; ?> style="font-size: 12px !important;" type="datetime-local" name="datetime_regular_end" id="datetime_regular_end" value="<?php echo $end_time_regular; ?>" class="input-main-form w-100">
                            </td>
                            <td style="width:6%;">
                                場所：
                            </td>
                            <td style="width:17%;">
                                <input <?php echo $input_status; ?> type="text" id="location_regular" name="location_regular" value="<?php echo $location_regular; ?>" class="input-main-form w-100">
                            </td>
                            <td style="width:6%; padding: 0;">
                                講師：
                            </td>
                            <td style="width:18%;">
                                <input <?php echo $input_status; ?> type="text" id="instructor_regular" name="instructor_regular" value="<?php echo $instructor_regular; ?>"  class="input-main-form w-100">
                            </td>
                        </tr>

                        <tr style="width:100%;">
                            <td class="w-14">
                                <span>Ａ班実施日時：</span>
                            </td>
                            <td style="vertical-align:middle;" class="w-18">
                                <input <?php echo $input_status; ?> style="font-size: 12px !important;" type="datetime-local" name="datetime_a_start" value = "<?php echo $start_time_a; ?>" id="datetime_a_start" class="input-main-form w-100">
                            </td>
                            <td class="w-2">~</td>
                            <td style="vertical-align:middle;" class="w-18">
                                <input <?php echo $input_status; ?> style="font-size: 12px !important;" type="datetime-local" name="datetime_a_end" value="<?php echo $end_time_a; ?>" id="datetime_a_end" class="input-main-form w-100">
                            </td>
                            <td class="w-6">
                                場所：
                            </td>
                            <td class="w-17">
                                <input <?php echo $input_status; ?> type="text" id="location_a" name="location_a" value="<?php echo $location_a; ?>" class="input-main-form w-100">
                            </td>
                            <td class="w-6">
                                講師：
                            </td>
                            <td class="w-18">
                                <input <?php echo $input_status; ?> type="text" id="instructor_a" name="instructor_a" value="<?php echo $instructor_a; ?>"  class="input-main-form w-100">
                            </td>
                        </tr>

                        <tr class="w-100">
                            <td class="w-14">
                                <span>Ｂ班実施日時：</span>
                            </td>
                            <td style="vertical-align:middle;" class="w-18">
                                <input <?php echo $input_status; ?> style="font-size: 12px !important;" type="datetime-local" name="datetime_b_start" id="datetime_b_start" value="<?php echo $start_time_b; ?>" class="input-main-form w-100">
                            </td>
                            <td class="w-2">~</td>
                            <td style="vertical-align:middle;" class="w-18">
                                <input <?php echo $input_status; ?> style="font-size: 12px !important;" type="datetime-local" name="datetime_b_end" id="datetime_b_end" value="<?php echo $end_time_b; ?>" class="input-main-form w-100">
                            </td>
                            <td class="w-6">
                                場所：
                            </td>
                            <td class="w-17">
                                <input <?php echo $input_status; ?> type="text" id="location_b" name="location_b" value="<?php echo $location_b; ?>" class="input-main-form w-100">
                            </td>
                            <td class="w-6">
                                講師：
                            </td>
                            <td class="w-18">
                                <input <?php echo $input_status; ?> type="text" id="instructor_b" name="instructor_b" value="<?php echo $instructor_b; ?>" class="input-main-form w-100">
                            </td>
                        </tr>

                        <tr class="w-100">
                            <td class="w-14">
                                <span>Ｃ班実施日時：</span>
                            </td>
                            <td class="w-18" style="vertical-align:middle;">
                                <input <?php echo $input_status; ?> style="font-size: 12px !important;" type="datetime-local" name="datetime_c_start" id="datetime_c_start" value="<?php echo $start_time_c; ?>" class="input-main-form w-100">
                            </td>
                            <td class="w-2">~</td>
                            <td class="w-18" style="vertical-align:middle;">
                                <input <?php echo $input_status; ?> style="font-size: 12px !important;" type="datetime-local" name="datetime_c_end" id="datetime_c_end" value="<?php echo $end_time_c; ?>" class="input-main-form w-100">
                            </td>
                            <td class="w-6">
                                場所：
                            </td>
                            <td class="w-17">
                                <input <?php echo $input_status; ?> type="text" id="location_c" name="location_c" value="<?php echo $location_c; ?>" class="input-main-form w-100">
                            </td>
                            <td class="w-6">
                                講師：
                            </td>
                            <td class="w-18">
                                <input <?php echo $input_status; ?> type="text" id="instructor_c" name="instructor_c" value="<?php echo $instructor_c; ?>" class="input-main-form w-100">
                            </td>
                        </tr>

                        <tr class="w-100">
                            <td class="w-14">
                                <span>Ｄ班実施日時：</span>
                            </td>
                            <td class="w-18" style="vertical-align:middle;">
                                <input <?php echo $input_status; ?> style="font-size: 12px;"  type="datetime-local" name="datetime_d_start" id="datetime_d_start" value="<?php echo $start_time_d; ?>" class="input-main-form w-100">
                            </td>
                            <td class="w-2">~</td>
                            <td class="w-18" style="vertical-align:middle;">
                                <input <?php echo $input_status; ?> style="font-size: 12px !important;" type="datetime-local" name="datetime_d_end" id="datetime_d_end" value="<?php echo $end_time_d; ?>" class="input-main-form w-100">
                            </td>
                            <td class="w-6">
                            場所：
                            </td>
                            <td class="w-17">
                                <input <?php echo $input_status; ?> type="text" id="location_d" name="location_d" value="<?php echo $location_d; ?>" class="input-main-form w-100">
                            </td>
                            <td class="w-6">
                            講師：
                            </td>
                            <td class="w-18">
                                <input <?php echo $input_status; ?> type="text" id="instructor_d" name="instructor_d" value="<?php echo $instructor_d; ?>" class="input-main-form w-100">
                            </td>
                        </tr>    
                    </table>                    
            </div>

            <div id="categoryDIV" class="categoryDIV">
                <caption><b>区分</b></caption>
                <table id="categoryTable" border="1" class="table table-hover rounded-3 overflow-hidden mainrecordT2" >
                    <tbody>
                        <tr>
                            <td>
                                <input <?php echo $input_status; ?> type="checkbox" id="categoryQuality"  name="category[]" value="1" <?php if(in_array(1,$category_array)) {echo 'checked';}?>> 
                                <label for="categoryQuality">品質</label>
                            </td>
                            <td style="width:25%">
                                <input type="checkbox" <?php echo $input_status; ?> id="categoryEnvironment" name="category[]" value="2" <?php if(in_array(2,$category_array)) {echo 'checked';}?>>
                                <label for="categoryEnvironment">環境</label> <!--Environment-->
                            </td>
                            <td style="width:25%">
                                <input type="checkbox" <?php echo $input_status; ?> id="categorySafetyAndHygiene" name="category[]" value="3" <?php if(in_array(3,$category_array)) {echo 'checked';}?>>
                                <label for="categorySafetyAndHygiene">安全衛生</label> <!--Safety and Hygiene-->
                            </td>
                            <td style="width:25%">
                                <div>
                                    <input type="checkbox" <?php echo $input_status; ?> id="categoryOther" name="category[]" value="4" <?php if(in_array(4,$category_array)) {echo 'checked';}?>>
                                    <label for="categoryOther">その他</label>
                                    <input type="text" <?php echo $input_status; ?> id="categoryOtherManual" value="" name="categoryOtherManual" placeholder="PLEASE SPECIFY" style="width:70%" class="input-main-form">
                                </div>
                            </td> 
                        </tr>
                    </tbody>
                </table>        
            </div>

            <div id="purposeDIV" class="purposeDIV">
                <caption><b>目的、対象者</b></caption>
                <table id="purposeTable" border="1" class="table table-hover rounded-3 overflow-hidden mainrecordT2" style="width:100%;">
                    <tr>
                        <td>目的：</td>
                        <td colspan="5">
                            <input type="text" <?php echo $input_status; ?> name="purposeID" maxlength="49" id="purposeID" class="input-main-form" value="<?php echo $purpose; ?>" style="width:96%" required>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 10%;">対象者：</td>
                        <td style="width: 40%;"><input <?php echo $input_status; ?> type="text" maxlength="49" name="audienceID" id="audienceID" class="input-main-form" value="<?php echo $audience; ?>" style="width:90%" required></td>
                        <td style="width:5%;">名:</td>
                        <td style="width:30%; text-align:left;"><span id="count_value" class="count_value" style="text-align:left;"></span>
                            <input <?php echo $input_status; ?> hidden type="text" value="" id="count_value_input" name="count_value_input"></td>
                        <td style="width:10%">
                            <span>OPEN：</span>
                        </td>
                        <td style="width:5%">
                            <input type="checkbox" disabled <?php if($open_training === "1") { echo "checked"; } ?> class="checkbox" id="open-training" name="open-training" style="float: left;" value="1">
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
                    <table id="participantsTable" style="font-size: 14px;" class="table table-sm table-hover table-bordered rounded-3 overflow-hidden participantsT">

                        <thead class="table text-center theadstyle participants_thead" style="width: 98.5%;">
                            <tr id="firstrow" style="height: 40px;">
                                <th style="width:11.1%; vertical-align:middle;height:40px;">
                                    <div class="dropdown p-0">
                                        <button class="btn btn-GID-search" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">GID<i class="bi bi-caret-down float-right" id="GID_search_main_icon" style="float: right;"></i></button>
                                            <ul class="dropdown-menu p-2" style="width: 300px;" aria-labelledby="dropdownMenuButton1">
                                                <li><input type="search" name="GID_search_main" id="GID_search_main" class="dropdown-item" 
                                                    value = "" placeholder="Search GID">
                                                </li>
                                            </ul>
                                    </div>
                                </th>
                                <th style="width:15.1%; vertical-align:middle;height:40px;">
                                    <div class="dropdown p-0">
                                        <button class="btn btn-name-search" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">名前<i class="bi bi-caret-down float-right" id="GID_name_main_icon" style="float: right;"></i></button>
                                        <ul class="dropdown-menu p-2" style="width: 300px;" aria-labelledby="dropdownMenuButton1">
                                            <li><input type="search" name="GID_name_main" id="GID_name_main" class="dropdown-item" 
                                                value = "" placeholder="Search 名前">
                                            </li>
                                        </ul>
                                    </div>
                                </th>
                                <th style="width:9.1%; vertical-align:middle;height:40px;">
                                    <div class="shift-select-container p-0" style="width:100%;">
                                        <select data-selected-text-format="static" title="期" class="shift selectpicker form-control" data-size = "6" data-live-search = "true" style=""
                                            multiple id="input-shift-select" data-actions-box="true" aria-label="size 3 select example">
                                        <?php
                                            $query_shift = "SELECT distinct(shift_description) FROM attendance
                                                INNER JOIN 
                                                    users on attendance.GIDh = users.GID
                                                INNER JOIN 
                                                    shift ON users.shift_id = shift.shift_id
                                                WHERE 
                                                    training_id = :training_id
                                                ORDER BY 
                                                    shift.shift_description ASC;";

                                            $stmt_shift = $pdo->prepare($query_shift);
                                            $stmt_shift->bindParam(":training_id",$training_id);
                                            $stmt_shift->execute();
                                            $result = $stmt_shift->fetchAll();
                                            foreach($result as $row)
                                                {
                                                    echo "<option name='checkbox_shift_main[]' value='$row[shift_description]' class='common_selector shift'
                                                    >$row[shift_description]</option>
                                                    ";
                                                      
                                                }
        
                                        ?>
                                        </select>
                                    </div>
                                    <!--<a href="" role="button" id="drowdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color:white"><i id="shift_main_icon" style="float:right;" class="bi bi-caret-down"></i>班</a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <?php
                                                    $query_shift = "SELECT distinct(shift_description) FROM attendance
                                                        INNER JOIN 
                                                            users on attendance.GIDh = users.GID
                                                        INNER JOIN 
                                                            shift ON users.shift_id = shift.shift_id
                                                        WHERE 
                                                            training_id = :training_id
                                                        ORDER BY 
                                                            shift.shift_description ASC;";

                                                $stmt_shift = $pdo->prepare($query_shift);
                                                $stmt_shift->bindParam(":training_id",$training_id);
                                                $stmt_shift->execute();
                                                $result = $stmt_shift->fetchAll();
                                                foreach($result as $row)
                                                    {
                                            ?>
                                                <div class="list-group-item checkbox">
                                                    <label><input type="checkbox" name="checkbox_shift_main[]" class="common_selector shift" value="
                                                        <?php echo $row["shift_description"];
                                                        ?>
                                                        "> <?php echo $row["shift_description"];
                                                        ?>
                                                    </label>
                                                </div>
                                                    <?php
                                                    }
                                                    ?>        
                                        </ul> 
                                                --> 
                                </th>
                                <th style="width:13.1%; vertical-align:middle; height:40px;">
                                    <a href="" role="button" id="drowdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color:white"><i id="process_main_icon" style="float:right;" class="bi bi-caret-down"></i>工程</a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <?php
                                                $query = "SELECT DISTINCT(department_name) FROM attendance
                                                    INNER JOIN 
                                                        users ON users.GID = attendance.GIDh
                                                    INNER JOIN 
                                                        department ON users.department_id = department.department_id
                                                    WHERE 
                                                        training_id = :training_id
                                                    ";

                                                $stmt = $pdo->prepare($query);
                                                $stmt->bindParam("training_id",$training_id);
                                                $stmt->execute();
                                                $result = $stmt->fetchAll();
                                                foreach($result as $row)
                                                    {
                                            ?>
                                                <div class="list-group-item checkbox">
                                                    <label><input type="checkbox" name="checkbox_process_main[]" class="common_selector process" value="<?php echo $row["department_name"];?>"> <?php echo $row["department_name"];?>
                                                    </label>
                                                </div>
                                                    <?php
                                                    }
                                                    ?> 
                                        </ul>  
                                </th>
                                <th style="width:11%; vertical-align:middle; height:40px;">
                                    <a href="" role="button" id="drowdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color:white"><i id="building_main_icon" style="float:right;" class="bi bi-caret-down"></i>号棟</a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <?php
                                                $query = "SELECT DISTINCT(users.building_id),building_name FROM attendance
                                                    INNER JOIN 
                                                        users on users.GID = attendance.GIDh
                                                    INNER JOIN
                                                        buildings ON buildings.building_id = users.building_id
                                                    WHERE 
                                                        training_id = :training_id";   

                                                $stmt = $pdo->prepare($query);
                                                $stmt->bindParam("training_id",$training_id);
                                                $stmt->execute();
                                                $result = $stmt->fetchAll();
                                                foreach($result as $row)
                                                    {
                                            ?>
                                                <div class="list-group-item checkbox">
                                                    <label><input type="checkbox" name="checkbox_building_main[]" class="common_selector building" value="
                                                        <?php echo $row["building_id"];
                                                        ?>
                                                        "> <?php echo $row["building_name"];?>
                                                    </label>
                                                </div>
                                                    <?php
                                                    }
                                                    ?> 
                                        </ul>   
                                </th>
                                <th style="width:9.6%; vertical-align:middle; height:40px;">
                                認定&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="judgement_applicable" 
                                    <?php if($department !== $creation_department) {
                                        echo "disabled";
                                    }?>
                                name="judgement_applicable" <?php if($judgement === 1) echo "checked"; ?> value="2">
                                
                                </th>
                                <th style="width:11.7%; vertical-align:middle; height:40px;">
                                出席
                                </th>
                                <th style="width:8.8%; vertical-align:middle; height:40px;">        
                                    <a href="" role="button" id="dropdown_menu_sign" data-bs-toggle="dropdown" aria-expanded="false" style="color:white"><i id="sign_progress_icon" style="float:right;" class="bi bi-caret-down"></i>サイン</a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdown_menu_sign">
                                            <?php
                                                $query = 
                                                    "SELECT DISTINCT(sign_progress) FROM attendance
                                                    WHERE 
                                                        training_id = :training_id
                                                    ";   
                                               $stmt = $pdo->prepare($query);
                                               $stmt->bindParam("training_id",$training_id);
                                               $stmt->execute();
                                               $result = $stmt->fetchAll();
                                               foreach($result as $row)
                                                   {
                                            ?>
                                            <div class="list-group-item checkbox">
                                                <label><input type="checkbox" name="checkbox_sign_progress[]" class="common_selector sign_progress" value="<?php echo $row["sign_progress"]; ?>"> 
                                                        <?php 
                                                            if($row["sign_progress"] === "1") {
                                                                echo "進行中";
                                                            }
                                                            else if($row["sign_progress"] === "2") {
                                                                echo "完了";
                                                            }
                                                        ?>
                                                   </label>
                                               </div>
                                                   <?php
                                                   }
                                                   ?> 
                                        </ul>
                                </th>
                                <th style="width:12.5%; vertical-align:middle; height:40px;">
                                <i class="bi bi-person-dash"></i>
                                </th> 
                            </tr>
                        </thead>
                        <tbody id="post_list" class="participants_tbody">
                        </tbody>
                    </table>
                    <div id="success"></div>
                      
            </div>
            <div style="width:100%; height: 60px; <?php if($open_training === "1") { echo "display:none;";} ?>">
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="float:left; width:150px;" <?php if($department !== $creation_department) {
                        echo "disabled";
                    }?>>
                    受講者追加&nbsp;<i class="bi bi-person-fill-add"></i>
                    </button>

                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" id="email-modal-btn" data-bs-target="#email-modal" style="float:right; width:150px;" <?php if($department !== $creation_department) {
                        echo "disabled";
                    }?>
                    >
                    電子メール&nbsp;<i class="bi bi-envelope-at-fill"></i>
                    </button>            
            </div>

            <div class="reference_material_div">
                <table class="table table-bordered table-hover rounded-3 overflow-hidden reference_material_T" id="files_table">
                    <thead class="table text-center theadstyle reference_material_thead" style="width: 98.5%;">
                        <th style="width:10%;">No.</th>
                        <th style="width:65%;">参考資料</th>
                        <th style="width:12.5%;">ダウンロード</th>
                        <th style="width:12.5%;">削除</th>
                    </thead>
                    <tbody id="post_list_add_files" class="files_tbody">
                    </tbody>
                </table>
            </div>

            <span style = 'font-size: 10px; text-align:left;'>ファイルタイプ: 'jpg'、'jpeg'、'png'、'pdf'、'xlsx'、'docs'、'xls'、'docx'、'ppt'、'pptx'、'csv'、'doc'「ファイルは4つまで、容量は8Mまで」</span>
  
            <div class="upload_div">
                <div class="mb-3">
                    <!--<label for="formFileMultiple" class="form-label">Upload Additional Files</label>-->
                    <input class="form-control upload-file-materials" type="file" id="file-upload" name="file[]" style="width:50%; background-color:lightyellow;" 
                    <?php if($department !== $creation_department) {
                        echo "disabled";
                     }
                    ?> multiple>
                </div>
            </div> 

            <!--<div style="width:100%; height: 60px;">
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop_02" style="float:left; width:150px;" <?php if($department !== $creation_department) {
                        echo "disabled";
                     }?>>
                    形式を追加&nbsp;<i class="bi bi-file-earmark-plus-fill"></i>
                    </button>   
                    
            </div> -->
            
            <div id="contentsDIV" class="contentsDIV">
            <caption><b>内容</b></caption><br>
            <span style = 'font-size: 10px; text-align:left; float:left;'>最大 150 文字</span>
                <table id="contentsTable" border="1" class="contentsT">
                
                <tr>
                <td><textarea type="text"
                <?php if($department !== $creation_department) {
                        echo "disabled";
                     }
                ?>
                name="contentsID" id="contentsID" value="" class="contentsInput" rows="3" maxlength="150" required><?php echo  $contents; ?></textarea></td>
                </tr>
                </table>
            </div>
            <div id="usageDIV">
                    <caption><b>使用資料（作業標準がある場合には、作業標準№を記入、ない場合には資料名等を記入）</b></caption><br>
                    <span style = 'font-size: 10px; text-align:left; float:left;'>最大 150 文字</span>
                    <table id="usageTable" border="1" class="usageT">
                    <tr>
                    <td><textarea type="text" 
                    <?php if($department !== $creation_department) {
                        echo "disabled";
                     }
                    ?>
                    name="usageID" id="usage-materials" value="" rows="3" class="usageInput" maxlength="150" required><?php echo $usage_; ?></textarea></td>
                    </tr>
                </table>
            </div>
            <div id="confirmation_by" class="confirmation_by_div">
                    <caption style="text-align:center;"><b>教育効果の確認方法、確認予定日</b></caption>
                    <table id="confirmation_table" border="1" class="table table-hover rounded-3 overflow-hidden mainrecordT2">
                        <tr>
                            <td colspan="4" style="width:100%"><input type="text" maxlength="49"
                            <?php if($department !== $creation_department) {
                            echo "disabled";
                            }
                            ?>
                        class="input-main-form" name="confirmation_by" id="confirmation_by_id" value="<?php echo $confirmation_by; ?>" style="width:100%" required></td>
                        </tr>
                        <tr>
                            <td colspan="1" style="width:25%; vertical-align:middle;">最終確認予定日：</td>
                            <td colspan="1" style="width:25%"><input 
                            <?php if($department !== $creation_department) {
                            echo "disabled";
                             }
                            ?>
                            type="datetime-local" class="input-main-form" name="confirmation_date" id="confirmation_date_id" value="<?php echo $confirmation_date; ?>" style="width:90%" required></td>
                            <td colspan="1"></td>
                            <td colspan="1"></td>
                        </tr>
                    </table>
                </div>
                <div id="checker_comment_div" class="checker_comment_regular_div">
                
                <h7 style="text-align:center;"><b>教育効果の確認結果</b></h7><br>
                </div>
                
                
            <div id="checker_comment_div" class="checker_comment_regular_div" style="overflow-y: visible; position:relative;">
                
                    <table id="confirmation_table" border="1" class="table table-hover rounded-3 mainrecordT2" overflow-visible>

                    <!--regular-->
                        <tr style="width:100%;"> 
                            <td colspan="1" style="width:15%">日勤者：</td>
                            <td colspan="1" style="width:15%; overflow:visible;">
                                <div class="container" style="overflow:visible;">
                                    <select name="participants_regular[]" id="participants_regular" onchange="checker_date_regular_auto();" class="selectpicker required" data-live-search = "true" title="インタビュー者を選択"
                                    
                                    <?php

                                        //count regular participants
                                        $query_count_regular_participants = "SELECT GIDh, attendance.name_, attendance.training_id, users.shift_id, users.GID, attendance.interviewee, attendance.attendance  FROM attendance
                                            INNER JOIN 
                                               users ON users.GID = attendance.GIDh
                                            WHERE 
                                               attendance.training_id = :training_id
                                            AND 
                                               users.shift_id = '5'
                                            AND 
                                                attendance.attendance = '1'";
                                       
                                       $stmt_count_regular_participants = $pdo->prepare($query_count_regular_participants);
                                       $stmt_count_regular_participants->bindParam(":training_id",$training_id);
                                       $stmt_count_regular_participants->execute();

                                       $count_regular_participants=$stmt_count_regular_participants->rowCount();

                                       $stmt_count_regular_participants->closeCursor();
                                        
                                        //count finished regular participants
                                        $query = "SELECT GIDh, attendance.name_, attendance.training_id, users.shift_id, users.GID, attendance.interviewee, attendance.attendance FROM attendance
                                            INNER JOIN 
                                                users ON users.GID = attendance.GIDh
                                            WHERE 
                                                attendance.training_id = :training_id
                                            AND 
                                                users.shift_id = '5'
                                            AND
                                                sign_progress = '2'
                                            AND
                                                attendance.attendance = '1'
                                            ";

                                        $stmt_interviewee = $pdo->prepare($query);
                                        $stmt_interviewee->bindParam(":training_id", $training_id);
                                        $stmt_interviewee->execute();

                                        $result_query = $stmt_interviewee->fetchAll();

                                        $interview_regular_exist = $stmt_interviewee->rowCount();
                                        if($interview_regular_exist !== $count_regular_participants) { 
                                            echo "disabled";
                                        }
                                        if($department !== $creation_department) {
                                            echo " disabled";
                                            }
                                        if($interview_regular_exist < 1) {
                                            echo " disabled";
                                        }
                                    ?>
                                                 
                                    multiple data-size="5" >
                                    
                                    <?php
                                        foreach ($result_query as $participants) {
                                            echo "<option value ='$participants[GIDh]'";

                                            if($participants["interviewee"] === 2){
                                                echo "selected";
                                            } 

                                            echo">$participants[name_]</option>";
                                        }
                                    ?>
                                    </select>
                                </div>
                            </td>
                           
                            <td colspan="1" style="width:15%">
                            <input
                            <?php if($department !== $creation_department) {
                            echo " disabled";
                            }
                            ?>
                            class="input-main-form" type="datetime-local" name="checker_date_regular" id="checker_date_regular" value="<?php echo $checker_date_regular;?>" style="width:90%"
                            <?php
                                    if($interview_regular_exist !== $count_regular_participants) { 
                                        echo " disabled";
                                    }
                                    if($interview_regular_exist < 1) {
                                        echo " disabled";
                                    }
                            ?>></td>
                            <td colspan="1" style="width:55%">
                            <input maxlength="49"
                            <?php if($department !== $creation_department) {
                            echo "disabled";
                            }
                            if($interview_regular_exist !== $count_regular_participants) { 
                                echo " disabled";
                            }
                            if($interview_regular_exist < 1) {
                                echo " disabled";
                            }
                            ?>
                            class="input-main-form" type="text" name="checker_comment_regular" id="checker_comment_regular"
                            value="<?php echo $checker_comment_regular; ?>" style="width:100%">
                            </td>
                           
                        </tr>

                    <!--team A-->
                        <tr style="width:100%;">
                            <td colspan="1" style="width:15%">Ａ班：</td>
                            <td colspan="1" style="width:15%; overflow:visible;">
                                <div class="container" style="overflow:visible;">
                                    <select name="participants_a[]" id="participants_a" onchange="checker_date_a_auto()"  class="selectpicker" data-live-search = "true" title = "インタビュー者を選択"
                                    
                                    <?php
                                        //count team a participants
                                        $query_count_a_participants = "SELECT GIDh, attendance.name_, attendance.training_id, users.shift_id, users.GID, attendance.interviewee, attendance.attendance FROM attendance
                                        INNER JOIN 
                                            users ON users.GID = attendance.GIDh
                                        WHERE 
                                            attendance.training_id = :training_id
                                        AND 
                                            users.shift_id = '1'
                                        AND
                                            attendance.attendance = '1'
                                        ";
                                 
                                        $stmt_count_a_participants = $pdo->prepare($query_count_a_participants);
                                        $stmt_count_a_participants->bindParam(":training_id",$training_id);
                                        $stmt_count_a_participants->execute();

                                        $count_a_participants=$stmt_count_a_participants->rowCount();

                                        $stmt_count_a_participants->closeCursor();

                                        //count team a finished participants

                                        $query = "SELECT GIDh, attendance.name_, attendance.training_id, users.shift_id, users.GID, attendance.interviewee,
                                                attendance.attendance
                                            FROM 
                                                attendance
                                            INNER JOIN 
                                                users ON users.GID = attendance.GIDh
                                            WHERE 
                                                attendance.training_id = :training_id
                                            AND 
                                                users.shift_id = '1'
											AND
												sign_progress = '2'
                                            AND
                                                attendance.attendance = '1'
                                            ";

                                        $stmt_interviewee = $pdo->prepare($query);
                                        $stmt_interviewee->bindParam(":training_id", $training_id);
                                        $stmt_interviewee->execute();

                                        $interview_a_exist = $stmt_interviewee->rowCount();
                                        if($interview_a_exist !== $count_a_participants) { 
                                            echo "disabled";
                                        }
                                        if($department !== $creation_department) {
                                            echo " disabled";
                                            }
                                        if($interview_a_exist < 1) {
                                            echo " disabled";
                                        }
                                    ?>
                                    
                                    multiple data-size="5" >


                                    <?php
                                        $result_query = $stmt_interviewee->fetchAll();

                                        foreach ($result_query as $participants) {
                                            echo "<option value ='$participants[GIDh]'";

                                            if($participants["interviewee"] === 2){
                                                echo "selected";
                                            } 

                                            echo">$participants[name_]</option>";
                                        }
                                    ?>
                                    </select>
                                </div>
                             
                            </td>
                           
                            <td colspan="1" style="width:15%">
                            <input
                            <?php if($department !== $creation_department) {
                            echo "disabled";
                            }
                            ?>
                            class="input-main-form" type="datetime-local" name="checker_date_a" id="checker_date_a" 
                            value="<?php echo $checker_date_a;?>" style="width:90%"
                            <?php
                                    if($interview_a_exist !== $count_a_participants) { 
                                        echo " disabled";
                                    }
                                    if($interview_a_exist < 1) {
                                        echo " disabled";
                                    }
                            ?>></td>
                            <td colspan="1" style="width:55%">
                            <input maxlength="49"
                            <?php 
                            if($department !== $creation_department) {
                            echo "disabled";
                            }
                            if($interview_a_exist !== $count_a_participants) { 
                                echo " disabled";
                            }
                            if($interview_a_exist < 1) {
                                echo " disabled";
                            } 
                            ?>
                            class="input-main-form" type="text" name="checker_comment_a" id="checker_comment_a" 
                            value="<?php
                                echo $checker_comment_a;
                            ?>" style="width:100%">
                            </td>
                           
                        </tr>

                        <!--team B-->
                        <tr style="width:100%;">
                            <td colspan="1" style="width:15%">Ｂ班：</td>
                            <td colspan="1" style="width:15%; overflow:visible;">
                                <div class="container" style="overflow:visible;">
                                    <select name="participants_b[]" id="participants_b" onchange="checker_date_b_auto();" class="selectpicker" data-live-search = "true" title = "インタビュー者を選択"
                                    
                                    <?php

                                        //count team b participants
                                        $query_count_b_participants = "SELECT GIDh, attendance.name_, attendance.training_id, users.shift_id, users.GID, attendance.interviewee, 
                                        attendance.attendance

                                        FROM 
                                            attendance
                                        INNER JOIN 
                                            users ON users.GID = attendance.GIDh
                                        WHERE 
                                            attendance.training_id = :training_id
                                        AND 
                                            users.shift_id = '2'
                                        AND
                                            attendance.attendance = '1'    
                                            ";
                                 
                                        $stmt_count_b_participants = $pdo->prepare($query_count_b_participants);
                                        $stmt_count_b_participants->bindParam(":training_id",$training_id);
                                        $stmt_count_b_participants->execute();

                                        $count_b_participants=$stmt_count_b_participants->rowCount();

                                        $stmt_count_b_participants->closeCursor();

                                        //count team b finished participants
                                        $query = "SELECT GIDh, attendance.name_, attendance.training_id, users.shift_id, users.GID, attendance.interviewee, attendance.attendance FROM attendance
                                        INNER JOIN 
                                            users ON users.GID = attendance.GIDh
                                        WHERE 
                                            attendance.training_id = :training_id
                                        AND 
                                            users.shift_id = '2'
                                        AND
                                            sign_progress = '2'
                                        AND
                                            attendance.attendance = '1'
                                        ";

                                        $stmt_interviewee = $pdo->prepare($query);
                                        $stmt_interviewee->bindParam(":training_id", $training_id);
                                        $stmt_interviewee->execute();

                                        $interview_b_exist = $stmt_interviewee->rowCount();
                                        if($interview_b_exist !== $count_b_participants) { 
                                            echo "disabled";
                                        }
                                        if($department !== $creation_department) {
                                            echo " disabled";
                                            }
                                        if($interview_b_exist < 1) {
                                            echo " disabled";
                                        } 
                                    ?>
                                    
                                    multiple data-size="5" >
                                    <?php
                                        $result_query = $stmt_interviewee->fetchAll();
                                        foreach ($result_query as $participants) {
                                            echo "<option value ='$participants[GIDh]'";

                                            if($participants["interviewee"] === 2){
                                                echo "selected";
                                            } 

                                            echo">$participants[name_]</option>";
                                        }
                                    ?>
                                    </select>
                                </div>
                             
                            </td>
                           
                            <td colspan="1" style="width:15%">
                            <input 
                            <?php if($department !== $creation_department) {
                            echo "disabled";
                            }
                            ?>
                            class="input-main-form" type="datetime-local" name="checker_date_b" id="checker_date_b" 
                            value="<?php echo $checker_date_b; ?>" style="width:90%"
                            <?php
                                    if($interview_b_exist !== $count_b_participants) { 
                                        echo " disabled";
                                    }
                                    if($interview_b_exist < 1) {
                                        echo " disabled";
                                    } 
                            ?>></td>
                            <td colspan="1" style="width:55%">
                            <input maxlength="49"
                            <?php if($department !== $creation_department) {
                            echo "disabled";
                            }
                            if($interview_b_exist !== $count_b_participants) { 
                                echo " disabled";
                            }
                            if($interview_b_exist < 1) {
                                echo " disabled";
                            } 
                            ?>
                            class="input-main-form" type="text" name="checker_comment_b" id="checker_comment_b" 
                            value="<?php echo $checker_comment_b;
                            ?>" style="width:100%">
                            </td>
                           
                        </tr>

                        <!--team C-->
                        <tr style="width:100%;">
                            <td colspan="1" style="width:15%">Ｃ班：</td>
                            <td colspan="1" style="width:15%; overflow:visible;">
                                <div class="container" style="overflow:visible;">
                                    <select name="participants_c[]" id="participants_c" onchange="checker_date_c_auto();" class="selectpicker" data-live-search = "true" title = "インタビュー者を選択"
                                    
                                    <?php

                                        //count team c participants
                                        $query_count_c_participants = "SELECT GIDh, attendance.name_, attendance.training_id, users.shift_id, users.GID, attendance.interviewee, attendance.attendance FROM attendance
                                            INNER JOIN 
                                                users ON users.GID = attendance.GIDh
                                            WHERE 
                                                attendance.training_id = :training_id
                                            AND 
                                                users.shift_id = '3'
                                            AND
                                                attendance.attendance = '1'
                                            ";
                                 
                                        $stmt_count_c_participants = $pdo->prepare($query_count_c_participants);
                                        $stmt_count_c_participants->bindParam(":training_id",$training_id);
                                        $stmt_count_c_participants->execute();

                                        $count_c_participants=$stmt_count_c_participants->rowCount();

                                        $stmt_count_c_participants->closeCursor();

                                        //count team c finished participants
                                         $query = "SELECT GIDh, attendance.name_, attendance.training_id, users.shift_id, users.GID, attendance.interviewee, 
                                            attendance.attendance

                                            FROM 
                                                attendance
                                            INNER JOIN 
                                                users ON users.GID = attendance.GIDh
                                            WHERE 
                                                attendance.training_id = :training_id
                                            AND 
                                                users.shift_id = '3'
                                            AND
                                                sign_progress = '2'
                                            AND
                                                attendance.attendance = '1'
                                            ";

                                        $stmt_interviewee = $pdo->prepare($query);
                                        $stmt_interviewee->bindParam(":training_id", $training_id);
                                        $stmt_interviewee->execute();

                                        $interview_c_exist = $stmt_interviewee->rowCount();
                                        if($interview_c_exist !== $count_c_participants) { 
                                            echo " disabled";
                                        }
                                        if($department !== $creation_department) {
                                            echo " disabled";
                                            }
                                        if($interview_c_exist < 1) {
                                            echo " disabled";
                                        } 
                                    ?>
                                    
                                    multiple data-size="5" >
                                    <?php

                                        $result_query = $stmt_interviewee->fetchAll();

                                        foreach ($result_query as $participants) {
                                            echo "<option value ='$participants[GIDh]'";

                                            if($participants["interviewee"] === 2){
                                                echo "selected";
                                            } 

                                            echo">$participants[name_]</option>";
                                        }
                                    ?>
                                    </select>
                                </div>
                             
                            </td>
                           
                            <td colspan="1" style="width:15%">
                            <input 
                            <?php if($department !== $creation_department) {
                            echo " disabled";
                            }

                            if($interview_c_exist < 1) { 
                                echo " disabled";
                            }
                            ?>
                            class="input-main-form" type="datetime-local" name="checker_date_c" id="checker_date_c" 
                            value="<?php echo $checker_date_c; ?>" style="width:90%"
                            <?php
                                    if($interview_c_exist !== $count_c_participants) { 
                                        echo " disabled";
                                    }
                            ?>></td>
                            <td colspan="1" style="width:55%">
                            <input maxlength="49"
                            <?php if($department !== $creation_department) {
                            echo " disabled";
                            }

                            if($interview_c_exist !== $count_c_participants) { 
                                echo " disabled";
                            }
                            if($interview_c_exist < 1) {
                                echo " disabled";
                            }    
                            ?>
                            class="input-main-form" type="text" name="checker_comment_c" id="checker_comment_c" 
                            value="<?php echo $checker_comment_c;
                             ?>" style="width:100%">
                            </td>
                           
                        </tr>

                        
                        <!--team D-->
                        <tr style="width:100%;">
                            <td colspan="1" style="width:15%">Ｄ班：</td>
                            <td colspan="1" style="width:15%; overflow:visible;">
                                <div class="container" style="overflow:visible;">
                                    <select name="participants_d[]" id="participants_d" onchange="checker_date_d_auto();"  class="selectpicker" data-live-search = "true" title = "インタビュー者を選択"
                                    
                                    <?php
                                        //count team d participants
                                        $query_count_d_participants = "SELECT GIDh, attendance.name_, attendance.training_id, users.shift_id, users.GID, attendance.interviewee,
                                            attendance.attendance
                                            FROM 
                                                attendance
                                            INNER JOIN 
                                                users ON users.GID = attendance.GIDh
                                            WHERE 
                                                attendance.training_id = :training_id
                                            AND 
                                                users.shift_id = '4'
                                            AND
                                                attendance.attendance = '1'
                                            ";
                                 
                                        $stmt_count_d_participants = $pdo->prepare($query_count_d_participants);
                                        $stmt_count_d_participants->bindParam(":training_id",$training_id);
                                        $stmt_count_d_participants->execute();

                                        $count_d_participants=$stmt_count_d_participants->rowCount();

                                        $stmt_count_d_participants->closeCursor();

                                        //count team d finished participants
                                        $query = "SELECT GIDh, attendance.name_, attendance.training_id, users.shift_id, users.GID, attendance.interviewee, attendance.attendance FROM attendance
                                        INNER JOIN 
                                            users ON users.GID = attendance.GIDh
                                        WHERE 
                                            attendance.training_id = :training_id
                                        AND 
                                            users.shift_id = '4'
                                        AND
                                            sign_progress = '2'
                                        AND
                                            attendance.attendance = '1'
                                        ";

                                        $stmt_interviewee = $pdo->prepare($query);
                                        $stmt_interviewee->bindParam(":training_id", $training_id);
                                        $stmt_interviewee->execute();
                                        $interview_d_exist = $stmt_interviewee->rowCount();
                                        if($interview_d_exist !== $count_d_participants) { 
                                            echo "disabled";
                                        }
                                        if($department !== $creation_department) {
                                            echo " disabled";
                                            } 
                                        if($interview_d_exist < 1) {
                                            echo " disabled";
                                        }      
                                    ?>
                                    
                                    multiple data-size="5" >
                                    <?php
                                        
                                        $result_query = $stmt_interviewee->fetchAll();

                                        foreach ($result_query as $participants) {
                                        echo "<option value ='$participants[GIDh]'";

                                            if($participants["interviewee"] === 2){
                                                echo "selected";
                                            }
                                            
                                            echo">$participants[name_]</option>";
                                        }
                                    ?>
                                    </select>
                                </div>
                             
                            </td>
                           
                            <td colspan="1" style="width:15%">
                            <input
                            <?php if($department !== $creation_department) {
                            echo "disabled";
                            }
                            ?>
                            class="input-main-form" type="datetime-local" name="checker_date_d" id="checker_date_d" 
                            value="<?php echo $checker_date_d; ?>"  style="width:90%"
                                <?php
                                    if($interview_d_exist !== $count_d_participants) { 
                                        echo " disabled";
                                    }
                                    if($interview_d_exist < 1) {
                                        echo " disabled";
                                    }
                                ?>></td>
                            <td colspan="1" style="width:55%">
                            <input maxlength="49"
                                <?php if($department !== $creation_department) {
                                    echo "disabled";
                                    }
                                    if($interview_d_exist !== $count_d_participants) { 
                                        echo " disabled";
                                    }
                                    if($interview_d_exist < 1) {
                                        echo " disabled";
                                    }
                                ?>
                            class="input-main-form" type="text" name="checker_comment_d" id="checker_comment_d" 
                            value="<?php echo $checker_comment_d;
                            ?>" style="width:100%">
                            </td>
                            
                        </tr>
                               
                    </table>
                
            </div>
      
            <!--------------------------------------->
        </div>
        <div class="row" style="height:13%; padding-top:20px;">
                <div class="col-2" style="">
                <button type="submit" class = "btn btn-primary" style="vertical-align: middle; text-decoration:none; float;left;width: 150px;<?php if($department !== $creation_department) {
                        echo "display:none;";
                     }
                ?>
                ">
                <span>更新&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-arrow-clockwise"></i></span></button> 
                </form>                  
                </div>
                <div class="col-4">
                    <?php
                        echo "
                        <span style='font-size: 15px;'>最終更新者: $modified_by_name </span><br>
                        <span style='font-size: 15px;'>最終更新日: $modified_date </span><br>
                        ";

                    ?>
                </div>
                <div class="col-2">
                    <a href="newform.php?training_id=<?php echo $training_id;?>"  class="btn btn-primary"  style="width: 150px;float:right;" ><span>コピー&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-copy"></i></span></a>
                </div>
                <div class="col-2" >
                    <a href="pdf_preview.php?<?php echo $training_id;?>" target="_blank" class="btn btn-primary" style="width: 150px;float:right;"><span style="">PDF 表示&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-filetype-pdf"></i></span></a>
                </div>
                <div class="col-2">
                    <button data-bs-toggle="modal" class="btn btn-danger" data-bs-target="#delete_confirmation_modal" style="width: 100px; float:right;" <?php if($department !== $creation_department) {
                        echo "disabled";
                     }?>>訓練削除</button>
                </div>
               
        </div>

            <!---Modal for Delete Confirmation--->
            
            <div class="modal fade" id="delete_confirmation_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h5 class="modal-title text-center" style="text-align:center;" id="staticBackdropLabel">削除の確認</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    <div class="modal-body">
                        <span><?php echo $_GET["training_id"]; ?>とそのすべてのコンテンツを削除してもよろしいですか?</span>
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">NO</button>
                                <form action="includes/delete_training_record.inc.php" method="POST">
                                <input hidden type="text" name="training_id_delete" id="training_id_delete" value="<?php echo $_GET["training_id"]; ?>">
                            <button type="submit" name="submit" class="btn btn-danger" data-bs-dismiss="modal">DELETE</button>
                                </form>
                            
                        </div>
                    </div>
                </div>
            </div>

            <!---Modal for Mail Participants--->
            
            <div class="modal fade" id="email-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h5 class="modal-title text-center" style="text-align:center;" id="staticBackdropLabel">電子メール</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    <div class="modal-body">
                        選択した参加者に電子メールを送りますか?<br>
                        <table class="table text-center">
                            <thead>
                                <th>GID</th>
                                <th>名前</th>
                                <th>メール</th>
                            </thead>
                            <tbody id="post_list_email">
                            </tbody>
                        </table>
                    
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">NO</button>
                            <button type="submit" name="submit" class="btn btn-primary" id = "send-mail-btn" data-bs-dismiss="modal">SEND</button>       
                        </div>
                    </div>
                </div>
            </div>

             <!---Modal for Approval Mail Participants--->
            
             <div class="modal fade" id="mail-approver-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h5 class="modal-title text-center" style="text-align:center;" id="">電子メール</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          
                            選択した参加者に電子メールを送りますか?<br>
                            <table class="table text-center">
                                <thead>
                                    <th>GID</th>
                                    <th>名前</th>
                                    <th>メール</th>
                                </thead>
                                <tbody id="post_list_approver_email">
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">NO</button>
                            <button type="submit" name="submit" class="btn btn-primary" id = "send-approver-mail-btn" data-bs-dismiss="modal">SEND</button>       
                        </div>
                    </div>
                </div>
            </div>
                
            <!---Modal for Delete Trainee--->
            
            <div class="modal fade" id="delete_trainee_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h5 class="modal-title text-center" style="text-align:center;" id="staticBackdropLabel">削除の確認</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    <div class="modal-body">
                        選択した参加者を削除しますか?<br>
                        [<span id="delete_participant"></span>]
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">NO</button>
                            <button type="submit" name="submit" class="btn btn-danger" id = "delete_trainee_ajax" data-bs-dismiss="modal">DELETE</button>       
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Modal for Add Participants -->

            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">研修生を追加<i class="bi bi-person-fill-add"></i></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                
                    <div class="modal-body">
                        <a class="btn btn-danger" id="add-participants-reset-filter-btn" style="float:right; margin-bottom:10px;">リセット&nbsp;&nbsp;<i class="fa-solid fa-filter-circle-xmark"></i></a>
                
                        <table id="add-participants-table" border="1" style="height: 50%;" class="table table-hover rounded-3 table-sm participantsT">
                            <thead class="table text-center theadstyle participants_thead" style="width: 98.5%;">
                                <tr id="firstrow" style="height: 40px;">
                                    <th style="width:10%; vertical-align:middle;height:40px;"><input type="checkbox"  id="select_all" onClick="toggle(this)" onchange="count()" style="vertical-align:middle;">すべて選択</th>
                                    <th style="width:18%; vertical-align:middle;height:40px;">GID
                                        <a href="" role="button" id="drowdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color:white"><i id="GID_search_icon" style="float:right;" class="bi bi-caret-down"></i></a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <div class="list-group-item">
                                                    <div class="form-group">
                                                        <input type="text" name="GID_search_main" id="GID_search_main" class="form-control" placeholder="Search GID">
                                                    </div>
                                                </div>              
                                            </ul> 
                                    </th>
                                    <th style="width:18%; vertical-align:middle;height:40px;">名前
                                        <a href="" role="button" id="drowdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color:white"><i id="GID_name_icon" style="float:right;" class="bi bi-caret-down"></i></a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <div class="list-group-item">
                                                <div class="form-group">
                                                    <input type="text" name="GID_name" id="GID_name" class="form-control" placeholder="Search 名前">
                                                </div>
                                            </div>              
                                            </ul> 
                                    </th>
                                    <th style="width:18%; vertical-align:middle;height:40px;">
                                        <a href="" role="button" id="drowdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color:white"><i id="shift_icon" style="float:right;" class="bi bi-caret-down"></i>班</a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <?php
                                                $query = "SELECT distinct(shift_description) FROM users
                                                    INNER JOIN shift ON users.shift_id = shift.shift_id
                                                    
                                                    ORDER BY shift.shift_description ASC;";
                                                $stmt = $pdo->prepare($query);
                                                $stmt->execute();
                                                $result = $stmt->fetchAll();
                                                foreach($result as $row)
                                                    {
                                            ?>
                                                <div class="list-group-item checkbox">
                                                    <label><input name="checkbox_shift[]" type="checkbox" class="common_selector_add shift_add" value="<?php echo $row["shift_description"];?>"> 
                                                        <?php echo $row["shift_description"];
                                                        ?>
                                                    </label>
                                                </div>
                                                    <?php
                                                    }
                                                    ?>                                  
                                        </ul>  
                                    </th>
                                    <th style="width:18%; vertical-align:middle; height:40px;">
                                        <a href="" role="button" id="drowdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color:white"><i id="process_icon" style="float:right;" class="bi bi-caret-down"></i>工程</a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="max-height: 300px; overflow-y:scroll">
                                            <?php
                                                $query = "SELECT DISTINCT(department_name) FROM users
                                                    INNER JOIN department ON users.department_id = department.department_id
                                                    
                                                    ";
                                                $stmt = $pdo->prepare($query);
                                                $stmt->execute();
                                                $result = $stmt->fetchAll();
                                                foreach($result as $row)
                                                    {
                                            ?>
                                                <div class="list-group-item checkbox">
                                                    <label><input name="checkbox_process[]" type="checkbox"
                                                        <?php
                                                        if ($row["department_name"] === $_SESSION["department_name"]) {
                                                            echo "checked";
                                                        }
                                                        ?>
                                                        class="common_selector_add process_add" 
                                                        value="<?php echo $row["department_name"];?>"> 
                                                        <?php echo $row["department_name"];
                                                        ?>
                                                    </label>
                                                </div>
                                                    <?php
                                                    }
                                                    ?> 
                                                       
                                            </ul>  
                                    </th>
                                    <th style="width:18%; vertical-align:middle; height:40px;">
                                        <a href="" role="button" id="drowdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color:white"><i id="building_icon" style="float:right;" class="bi bi-caret-down"></i>Building</a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <?php
                                                    $query = "SELECT DISTINCT(building_name),users.building_id FROM users
                                                            INNER JOIN
                                                                buildings ON buildings.building_id = users.building_id
                                                        ORDER by building_name ASC
                                                        ;";
                                                    $stmt = $pdo->prepare($query);
                                                    $stmt->execute();
                                                    $result = $stmt->fetchAll();
                                                    foreach($result as $row)
                                                    {
                                                ?>
                                                    <div class="list-group-item checkbox">
                                                        <label><input name="checkbox_building[]" type="checkbox" class="common_selector_add building_add" value="
                                                            <?php echo $row["building_id"];
                                                            ?>
                                                            "> <?php echo $row["building_name"];?>
                                                        </label>
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>  
                                            </ul>   
                                    </th> 
                                </tr>
                            </thead>
                            <form id="participants_form" method="POST">
                            <tbody id="post_list_add" class="participants_tbody">
                            </tbody>
                            
                        </table> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" type="submit" name="submit" id="submit_add" value="submit_add" class="btn btn-primary" data-bs-dismiss="modal">ADD</button>
                        </form>    
                    </div>
                </div>
            </div>
        </div>
        <!--end for modal add participants-->

         <!-- Modal for Reason -->
         <div class="modal fade" id="reason-not-attend" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="static-label">研修生を追加<i class="bi bi-person-fill-add"></i></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" type="submit" name="submit_reason" id="submit_reason" value="submit_add" class="btn btn-primary" data-bs-dismiss="modal">ADD</button>
                        </form>
                        
                    </div>
                </div>
            </div>
            </div>
        <!--end for modal reason-->

        <!-- Modal For Reset Signature-->
                 
        <div class="modal fade" id="reset_signature_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">サインのリセット</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="text-align:center;">
                        選択しサインをリセットしてもよろしいですか？<br>
                        <hr>
                        <table id="ID-registration-table" border="1" class="table table-hover table-bordered rounded-3 overflow-hidden participantsT">
                            <thead>
                                <tr>
                                    <th class="w-25">GID</th>
                                    <th class="w-75">名前</th>
                                </tr>
                            </thead>
                            <tbody id="post_list_reset_signature">
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">NO</button>
                        <button type="submit" name="submit" class="btn btn-danger" id = "reset-signature-btn" data-bs-dismiss="modal">リセット</button>  
                    </div>
                </div>
            </div>
        </div>
        <!--End Modal -->

      
            </div> <!--paddin-->
        </div> <!--col-->
    </div> <!--row-->
</div> <!--container-fluid-->  

<!--<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>
-->

<script type="text/javascript">
    
/**Participants **/

$(document).ready(function() {

    //Save the checked participants in add participants table

    //var checklist_GID = [];

   /* $("#select_all").on('change', function () {
        var GID_select_all = [];
        GID_select_all = $("#add-participants-table .GIDcheck").val();
        console.log(GID_select_all);
    }) */


   /* $("#select_all").on('change', function(event){
    event.preventDefault();
    

    var checklist_GID = $("#add-participants-table tbody input:checkbox:checked").map(function(){
      return $(this).val();
    }).get(); // <----
    console.log(checklist_GID);

    var action = "select_all";
    $.ajax({
        url: "includes/fetch_data_add_participants.inc.php",
        method: "POST",
        data: {action:action,checklist_GID:checklist_GID},
            success:function(data){ 
                },
            error:function(data){
                console.log("error");
            }               
        }); 

    }); */
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


    //Send Approval Email Table AJAX

     $('#approver-email-modal-btn').on("click", function () {
        approval_email_table();
    });

    function approval_email_table() {
        var training_id = "<?php echo $training_id;?>";

        $.ajax({
          url: "includes/fetch_data_email_participants.inc.php",
          method: "POST",
          data: {training_id:training_id},
          success:function(data){
            $('#post_list_email').html(data);
            console.log("success");
          }
      });
    }

    //Send Email Table AJAX

    $('#email-modal-btn').on("click", function () {
        email_table();
    });

    function email_table() {
        var training_id = "<?php echo $training_id;?>";

        $.ajax({
          url: "includes/fetch_data_email_participants.inc.php",
          method: "POST",
          data: {training_id:training_id},
          success:function(data){
            $('#post_list_email').html(data);
            console.log("success");
          }
      });
    }

    //SEND EMAIL AJAX

    $("#send-mail-btn").on("click", function () {

        send_email();

    });

    function send_email () {
        var training_id = "<?php echo $training_id;?>";

        $.ajax({
          url: "includes/test_mail.php",
          method: "POST",
          data: {training_id:training_id},
          success:function(data){
            $('#alert_window_card').html(data);
            console.log(data);
          }
      });
    }


     //reset filter main
    
     $("#reset-filter-btn").on("click", function() {
  //      $("input[name='checkbox_shift_main[]']").prop('checked', false);
  //      $("#shift_main_icon").attr("class", "bi bi-caret-down");
        $("#GID_search_main").val("");
        $("#GID_search_main_icon").attr("class", "bi bi-caret-down");
        $("input[name='checkbox_process_main[]']").prop('checked', false);
        $("#process_main_icon").attr("class", "bi bi-caret-down");
        $("input[name='checkbox_sign_progress[]']").prop('checked', false);
        $("#sign_progress_icon").attr("class", "bi bi-caret-down");
        $("#GID_name_main").val("");
        $("#GID_name_main_icon").attr("class", "bi bi-caret-down");
        $("input[name='checkbox_building_main[]']").prop('checked', false);
        $("#building_main_icon").attr("class", "bi bi-caret-down");
        $("input[name='checkbox_position[]']").prop('checked', false);
        $("#position_icon").attr("class", "bi bi-caret-down");
        $("input[name='checkbox_employee_status[]']").prop('checked', false);
        $("#employee_status_icon").attr("class", "bi bi-caret-down");
        filter_data();
    });

    //reset filter 

    $("#add-participants-reset-filter-btn").on("click", function() {
        $("input[name='checkbox_shift[]']").prop('checked', false);
        $("#shift_icon").attr("class", "bi bi-caret-down");
        $("#GID_search").val("");
        $("#GID_search_icon").attr("class", "bi bi-caret-down");

        //Set Default check for department

        var main_department = "<?php echo $_SESSION["department_name"]; ?>";

        var process_array = $("input[name='checkbox_process[]']");

        $.each(process_array, function () {
            if($(this).val() === main_department) {
                $(this).prop('checked', true);
                console.log(this);
            }
            else {
                $(this).prop('checked', false);
            }
        });

      //  $("input[name='checkbox_process[]']").prop('checked', false);
        $("#process_icon").attr("class", "bi bi-caret-down");
        $("#GID_name").val("");
        $("#GID_name_icon").attr("class", "bi bi-caret-down");
        $("input[name='checkbox_building[]']").prop('checked', false);
        $("#building_icon").attr("class", "bi bi-caret-down");
        
        filter_add_data();
    });


    //Reset Signature
    var reset_signature_GID = "";
    $('#participantsTable tbody').on('click', '.reset-signature', function () {
        reset_signature_GID = $(this).val();
        console.log(reset_signature_GID);

        $.ajax({

            url: "includes/reset_signature.inc.php",
            method: "POST",
            data: {reset_signature_GID:reset_signature_GID},
            success:function(data){
                $("#post_list_reset_signature").html(data);
                //console.log("success on password reset");
                filter_data();
            }

        });
    });

    $('#reset-signature-btn').on("click", function() {

    var GID_signature_reset = reset_signature_GID;
    var training_id = "<?php echo $training_id;?>";
    $.ajax({
        
        url: "includes/reset_signature.inc.php",
        method: "POST",
        data: {GID_signature_reset:GID_signature_reset,training_id:training_id},
        success:function(data){
            $("#alert_window_card").html(data);
            
            console.log("success on signature reset");
            filter_data();
        }

    });

});

    //Clear All fields except upload and participants

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
        $('#instructor_regular').val("");
        $('#instructor_a').val("");
        $('#instructor_b').val("");
        $('#instructor_c').val("");
        $('#instructor_d').val("");
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

    $("#add-participants-table tbody").on('change','.GIDcheck', function () {
        GID_new_participant = $(this).val();
        console.log(GID_new_participant);

        var GID_check = $(this).is(":checked");
        console.log(GID_check);

        switch(GID_check) {
            case(true):
                var action = "check";
                $.ajax({
                        url: "includes/fetch_data_add_participants.inc.php",
                        method: "POST",
                        data: {action:action,GID_new_participant:GID_new_participant},
                        success:function(data){ 
                        },
                        error:function(data){
                            console.log("error");
                        }               
                    }); 
                break;
            case(false):
                var action = "uncheck";
                $.ajax({
                        url: "includes/fetch_data_add_participants.inc.php",
                        method: "POST",
                        data: {action:action,GID_new_participant:GID_new_participant},
                        success:function(data){ 
                        },
                        error:function(data){
                            console.log("error");
                        }               
                    }); 
                break;
                
                break;
        }
    });

    //Check the file extension and the file size

    var file_selection;

    $("#file-upload").change(function () {

        file_selection = $("#file-upload");

        var count_files_upload = file_selection[0].files.length;
        console.log(count_files_upload);

        if(count_files_upload > 4) {
            alert("Please uploade a maximum of 4 files");
            $('#file-upload').val("");
        }

        var fileExtension = ['jpg','jpeg','png','pdf','xlsx','docs','xls','docx','ppt','pptx','csv','doc'];
        var total_size = 0;
         for (var i = 0; i< count_files_upload; i++) {
            var current_file = file_selection[0].files[i].name.split('.').pop().toLowerCase();      
            console.log(file_selection[0].files[i].name);
            console.log(file_selection[0].files[i].size);

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
  

    //judgement

    var judgement_applicable;

    $(".judgement_applicable").change(function() {
        if($(".judgement_applicable").is(":checked")) {
            judgement_applicable = 1;
            $(".judgement").attr("disabled", false);
            judgement();
        }
        else {
            judgement_applicable = 2;
            $(".judgement").attr("disabled", true);
            judgement();
        }
    })

    function judgement() {
        $.ajax({
          url: "includes/fetch_data_judgement.inc.php",
          method: "POST",
          data: {judgement_applicable:judgement_applicable},
          success:function(data){
            console.log("success");
          }
      });
    }
    
    //
    $(".new-form-tab").addClass("active");

    filter_data();
    add_files_data();

    function filter_data() {

    $('#post_list').html();
    var action = 'fetch_data';
    var shift = get_filter('shift');
    var process = get_filter('process');
    var building = get_filter('building');
    var sign_progress = get_filter('sign_progress');
    var GID_search_main = $('#GID_search_main').val();
    var GID_name_main = $('#GID_name_main').val();
    
    $.ajax({
        url: "includes/fetch_data_edit_attendance.inc.php",
        method: "POST",
        data: {action:action,shift:shift,process:process,building:building,sign_progress:sign_progress,
            GID_search_main:GID_search_main,GID_name_main:GID_name_main
        },
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
    
    function get_filter_name(class_name)
    {
    var filter = [];
    $('.'+class_name).each(function(){
      filter.push($(this).val());
    });

    return filter;
    }

    $('.common_selector').click(function(){

        if($('input[name="checkbox_shift_main[]"]:checked').length > 0) {
        $("#shift_main_icon").attr("class", "bi bi-funnel-fill");
        }
        else {
            $("#shift_main_icon").attr("class", "bi bi-caret-down");
        }

        if($('input[name="checkbox_process_main[]"]:checked').length > 0) {
            $("#process_main_icon").attr("class", "bi bi-funnel-fill");
        }
        else {
            $("#process_main_icon").attr("class", "bi bi-caret-down");
        }

        if($('input[name="checkbox_building_main[]"]:checked').length > 0) {
            $("#building_main_icon").attr("class", "bi bi-funnel-fill");
        }
        else {
            $("#building_main_icon").attr("class", "bi bi-caret-down");
        }

        if($('input[name="checkbox_position[]"]:checked').length > 0) {
            $("#position_icon").attr("class", "bi bi-funnel-fill");
        }
        else {
            $("#position_icon").attr("class", "bi bi-caret-down");
        }

        if($('input[name="checkbox_sign_progress[]"]:checked').length > 0) {
            $("#sign_progress_icon").attr("class", "bi bi-funnel-fill");
        }
        else {
            $("#sign_progress_icon").attr("class", "bi bi-caret-down");
        }

        filter_data();

    });

    $('#GID_search_main').keyup(function(event){

    if($("#GID_search_main").val() !== "") {
    $("#GID_search_main_icon").attr("class","bi bi-funnel-fill");
    }
    else {
        $("#GID_search_main_icon").attr("class","bi bi-caret-down");
    }
    event.preventDefault();
    filter_data();
    });

    $('#GID_name_main').keyup(function(event){

    if($("#GID_name_main").val() !== "") {
        $("#GID_name_main_icon").attr("class","bi bi-funnel-fill");
    }
    else {
        $("#GID_name_main_icon").attr("class","bi bi-caret-down");
    }
    event.preventDefault();
    filter_data();
    });

   
    //add participants

    $('.common_selector_add').click(function(){

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

        filter_add_data();

    });

    $('#GID_search').keyup(function(event){

        if($("#GID_search").val() !== "") {
            $("#GID_search_icon").attr("class","bi bi-funnel-fill");
        }
        else {
            $("#GID_search_icon").attr("class","bi bi-caret-down");
        }

        event.preventDefault();
        filter_add_data();

    });

    $('#GID_name').keyup(function(event){

        if($("#GID_name").val() !== "") {
            $("#GID_name_icon").attr("class","bi bi-funnel-fill");
        }
        else {
            $("#GID_name_icon").attr("class","bi bi-caret-down");
        }

        event.preventDefault();
        filter_add_data();

    });

    filter_add_data();
    function filter_add_data() {
      //$('#post_list').html();
      var action = 'fetch_data';
      var shift_add = get_filter('shift_add');
      console.log(shift_add);
      var process_add = get_filter('process_add');
      console.log(process_add)
      var building_add = get_filter('building_add');
      var GID_search = $('#GID_search').val();
      var GID_name = $('#GID_name').val();

      $.ajax({
          url: "includes/fetch_data_add_participants.inc.php",
          method: "POST",
          data: {action:action,shift_add:shift_add,process_add:process_add,building_add:building_add,GID_search:GID_search,GID_name:GID_name},
          success:function(data){
            $('#post_list_add').html(data);
          }
      });
    }

    
    $('#submit_add').click(function(){
        submit_data();

    });

    function submit_data(){

        var action = 'fetch_data';
        var GIDcheck_add = get_filter('GIDcheck'); 
        var GIDname_add = get_filter_name('GIDname');
        var name_add = get_filter_name('name_');
        var department_name_add = get_filter_name('department_name');
         
        console.log(GIDcheck_add);
        console.log(GIDname_add);
        console.log(name_add);
        console.log(department_name_add);
    
        $.ajax({
            url: "includes/add_participants.inc.php",
            method: "POST",
            data: {GIDcheck_add:GIDcheck_add,
            GIDname_add:GIDname_add,
            name_add:name_add,
            department_name_add:department_name_add},
                success:function(data){ 
                console.log("success");
                filter_data();
                filter_add_data();
            },
                error:function(data){
                console.log("error");
            } 
        });

    }  

    //add files

    var file_count;
    function add_files_data() {

    //$('#post_list_add_files').html();

    var action ='fetch_data';

    $.ajax({
    url: "includes/fetch_data_add_files.inc.php",
    method: "POST",
    data: {action:action},
    success:function(data){ 
        console.log("success");
        $('#post_list_add_files').html(data);
        file_count = $('#post_list_add_files').html(data).find('tr').length;
        console.log(file_count);
        check_file();
    },
      error:function(data){
        console.log("error");
    }
    });

    }

    var file_id_delete;

    $('#files_table tbody').on('click', 'button', function(){
        
        file_id_delete = $(this).val();
        delete_file();
                
    });

    function delete_file() {
        var file_id = file_id_delete;

        $.ajax({
        url: "includes/delete_file.inc.php",
        method: "POST",
        data: {file_id:file_id},
        success:function(data){ 
            add_files_data();
            check_file();
            
        },
        error:function(data){
            console.log("error");
        }

    }); 

    }

    // end add files

    //Check if files exist
    $("#file-upload").change(function() {
        if ($('#file-upload').get(0).files.length === 0) {
            $("#usage-materials").attr("required", true);
        }

        else {
            $("#usage-materials").attr("required", false);
        }
    });

    check_file();

    function check_file() {
        if(file_count > 0) {
            $("#usage-materials").attr("required", false);
        }

        else {
            $("#usage-materials").attr("required", true);
        }
    }

    //delete participant
    var fired_button;

    $('#participantsTable tbody').on('click', '.delete_trainee', function(){
        
        fired_button = $(this).val();
        console.log(fired_button)
        $('#delete_participant').html(fired_button);
       // delete_data();
      //  check_file();
        
    });

    $("#delete_trainee_ajax").on("click", function () {
       console.log("success_toggle");
       
        delete_data();
    });



    function delete_data() {
        var GID_delete = fired_button;

        $.ajax({
            url: "includes/delete_trainee.inc.php",
            method: "POST",
            data: {GID_delete:GID_delete},
            success:function(data){ 
            filter_data();
            filter_add_data();
            },
          error:function(data){
            console.log("error");
            }
        }); 

    }

    //

    var download_button;
    $('button_download').click(function() {
    download_button = $(this).val();
    
    alert(download_button);
    //console.log(fired_button);
    });

});

  
function toggle(source) {
    checkboxes = document.getElementsByName('GIDcheck_add[]');
    for(var i=0, n=checkboxes.length;i<n;i++) {    
    checkboxes[i].checked = source.checked;  
    }
}

function toggle_judgement(source) {
    var judgement = document.getElementsByClassName("judgement") 
    judgement.addClass("disabled", true);
}

function count() {
var checkedboxes = $('input[name="GIDcheck[]"]:checked').length;
$('.jqValue').html(checkedboxes);
}

setTimeout(function () {
    var x = document.getElementById("participantsTable").rows.length;
document.getElementById('count_value').innerHTML = x-1;
document.getElementById('count_value_input').value = x-1;

}, 500)


function checker_date_regular_auto() {
    var now = new Date();
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
    document.getElementById('checker_date_regular').value = now.toISOString().slice(0,16);
    var comment = "<?php echo $checker_comment_regular;?>"; 
    document.getElementById("checker_comment_regular").value = comment;   
    
}

function checker_date_a_auto() {
    var now = new Date();
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
    document.getElementById('checker_date_a').value = now.toISOString().slice(0,16);
    var comment = "<?php echo $checker_comment_a;?>"; 
    document.getElementById("checker_comment_a").value = comment;   
}

function checker_date_b_auto() {
    var now = new Date();
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
    document.getElementById('checker_date_b').value = now.toISOString().slice(0,16);
    var comment = "<?php echo $checker_comment_b;?>"; 
    document.getElementById("checker_comment_b").value = comment;   
}

function checker_date_c_auto() {
    var now = new Date();
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
    document.getElementById('checker_date_c').value = now.toISOString().slice(0,16);
    var comment = "<?php echo $checker_comment_c;?>"; 
    document.getElementById("checker_comment_c").value = comment;    
}

function checker_date_d_auto() {
    var now = new Date();
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
    document.getElementById('checker_date_d').value = now.toISOString().slice(0,16);    
    var comment = "<?php echo $checker_comment_d;?>"; 
    document.getElementById("checker_comment_d").value = comment;
}

//VALIDATE INPUTS

$("#update-form").on("submit", function() {
      
    //Check if there is a category selected
    checked_category = $('input[name="category[]"]:checked').length;
    if(!checked_category) {
        alert("You must select at least one category!");
        return false;
    }

    else {
        //continue
    }

    //Check the digits of the training ID, should be 3 digit numbers

    var training_id_digit = $("#process_suffix_id").val();
    console.log(training_id_digit);
    function isEmail(training_id_digit) {
        var regex = /^\d{3}$/;
        return regex.test(training_id_digit);
    }
    
    if(training_id_digit !== "") {
        if(isEmail(training_id_digit) === true) {        
            //continue
        }
        else {      
            alert("半角かつ3桁でお願いします。");
            return false;
        }
    }
    else {
        alert("半角かつ3桁でお願いします。");
        return false;
    }       

    var term_id_digit = $("#term").val();
    function is_two_digit(term_id_digit) {
        var regex = /^\d{2}$/;
        return regex.test(term_id_digit);
    }

    if(term_id_digit !== "") {
        if(is_two_digit(term_id_digit) === true) {
            //continue
        }

        else {
            alert("半角でお願いします。");
            return false;
        }
    }

    else {
        alert("Y半角でお願いします。");
        return false;
    }


});

</script>



</body>
</html>