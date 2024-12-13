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
    $category = array ();

if(isset($_GET["training_id"])) {
    $training_id = $_GET["training_id"];
    $query_copy = "SELECT * FROM training_form
    where training_id = :training_id
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
        $audience = $copy_data["audience"];
        $contents = $copy_data["contents"];
        $usage_id = $copy_data["usage_id"];
        $start_time_regular = $copy_data["start_time_regular"];
        $start_time_a = $copy_data["start_time_a"];
        $start_time_b = $copy_data["start_time_b"];
        $start_time_c = $copy_data["start_time_c"];
        $start_time_d = $copy_data["start_time_d"];
        $end_time_regular = $copy_data["end_time_regular"];
        $end_time_a = $copy_data["end_time_a"];
        $end_time_b = $copy_data["end_time_b"];
        $end_time_c = $copy_data["end_time_c"];
        $end_time_d = $copy_data["end_time_d"];
        $creation_department = $copy_data["creation_department"];
        $confirmation_date = $copy_data["confirmation_date"];
    }

    if($creation_department !== $_SESSION["department"]) {
        $query_copy_same_process = "SELECT * FROM training_form
            WHERE 
                creator = :GID_creator
            ORDER BY 
                date_created 
            DESC LIMIT 1";
        $stmt_copy_same_process = $pdo->prepare($query_copy_same_process);
        //$stmt_copy_same_process->bindParam(":training_id", $training_id);
        $stmt_copy_same_process->bindParam(":GID_creator", $GID_creator);
        $stmt_copy_same_process->execute();

        $result_copy_same_process = $stmt_copy_same_process->fetchAll();

        $process_prefix = ""; //set process prefix to blank if there is no previous data

        foreach($result_copy_same_process as $copy_data) {
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
            $start_time_regular = $copy_data["start_time_regular"];
            $start_time_a = $copy_data["start_time_a"];
            $start_time_b = $copy_data["start_time_b"];
            $start_time_c = $copy_data["start_time_c"];
            $start_time_d = $copy_data["start_time_d"];
            $end_time_regular = $copy_data["end_time_regular"];
            $end_time_a = $copy_data["end_time_a"];
            $end_time_b = $copy_data["end_time_b"];
            $end_time_c = $copy_data["end_time_c"];
            $end_time_d = $copy_data["end_time_d"];   
            $audience = $copy_data["audience"];
            $term = $copy_data["term"];
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
        $start_time_regular = $prev_data["start_time_regular"];
        $start_time_a = $prev_data["start_time_a"];
        $start_time_b = $prev_data["start_time_b"];
        $start_time_c = $prev_data["start_time_c"];
        $start_time_d = $prev_data["start_time_d"];
        $end_time_regular = $prev_data["end_time_regular"];
        $end_time_a = $prev_data["end_time_a"];
        $end_time_b = $prev_data["end_time_b"];
        $end_time_c = $prev_data["end_time_c"];
        $end_time_d = $prev_data["end_time_d"];
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
        $contents = $prev_data["contents"];
        $usage_id = $prev_data["usage_id"];
        $training_id =$prev_data["training_id"];
        $confirmation_date = $prev_data["confirmation_date"];
        $term = $prev_data["term"];
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

//$participants_selected = $_SESSION["participants_selected"];

?>
    <!-----------REGISTRATION FORM----------->

<style> 

</style>
            <form action="includes/createform.inc.php" id="new-form" method="post" enctype="multipart/form-data">
                <div id="creation-department" class = "header-1" >
                    <h4><b>作成部署: 製造部</b></h4>
                </div> 
                <div id="mainrecord">
                    <table id="mainrecordTable" border="1" class="table table-sm table-hover rounded-3 mainrecordT2 overflow-visible">
                        <tbody>
                            <tr style="width:100%">
                                <td style="width:50%">
                                    <span>名称：</span>
                                    <input type="text"
                                    name="training_name"
                                    id="educationID"
                                    maxlength="49"
                                    value="<?php echo $training_name;?>"
                                    class="input-main-form"   
                                    style="width:80%; font-size: 14px;"
                                    required>
                                </td>
                                <td style="width:15%">
                                    <span>工程：</span>
                                    <select style="height: 30px; font-size: 14px;" name="process_prefix" id="trainingDepartment" class="selectpicker fs-6 w-50" required
                                    data-max-options="1" data-live-search = "true" data-size="6" title="選択">
                                    <option value="" disabled selected hidden>Select</option>
                                        <?php

                                        if ($process_prefix !== '') {
                                            echo "<option value= '$process_prefix' selected>$process_prefix</option>";
                                        }

                                        $query = "SELECT * FROM process_prefix
                                           
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
                                    <!--<input type="text" name="trainingIdentifier" value="" style="width:25%">-->    
                                </td>
                                <td style="width:15%">
                                    
                                    <input type="text" id="term" maxlength="4" name="term" value="<?php echo $term; ?>" style="width: 30%; font-size: 15px;" class="input-main-form" required>
                                    <span>期</span>             
                                </td>
                                <td style="width:10%">
                                    <input type="radio" id="trainingLocInternal" name="training_area" value="1" checked>
                                        <label for="trainingLocInternal" style="vertical-align:middle;">社内</label>
                                </td>
                                <td style="width:10%">
                                    <input type="radio" id="trainingLocExternal" name="trainingLoc" value="2">
                                        <label for="trainingLocExternal">社外</label>
                                </td>
                                
                            </tr>
                        </tbody>
                    </table>
                    <table id="mainrecordTable2" class="table table-hover table-sm rounded-3 overflow-visible mainrecordT2">
                        <tr style="width:100%;">
                            <td style="width:20%;">
                                <span>日勤者実施日時：</span>
                            </td>
                            <td style="vertical-align:middle; width:15%; padding:0;">
                                <input type="datetime-local" name="datetime_regular_start" id="datetimeRegularStart" value="<?php echo $start_time_regular; ?>" class="input-main-form" >
                            </td>
                            <td style="vertical-align:middle; width:15%;">
                                <input type="datetime-local" name="datetime_regular_end" id="datetimeRegularEnd" value="<?php echo $end_time_regular; ?>" class="input-main-form">
                            </td>
                            <td style="width:10%; padding: 0;">
                            場所：
                            </td>
                            <td style="width:10%;">
                                <input type="text" id="location_regular" maxlength="10"
                                
                                name="location_regular" value="<?php echo $location_regular; ?>" class="input-main-form">
                            </td>
                            <td style="width:10%; padding: 0;">
                            講師：
                            </td>
                        
                            <td style="width:20%;">
                            <div class="container" style="overflow:visible;">
                                
                                    <select name="instructor_regular" id="instructor-regular" class="selectpicker instructor-select" data-allow-clear="true"  data-max-options="1" data-live-search = "true" data-size="6" title="講師選択">
                                            
                                        <?php
                                            $query_instructor = "SELECT name_ FROM users
                                            where userlevel = '2'";

                                            $stmt_instructor = $pdo->prepare($query_instructor);
                                            //$stmt_interviewee->bindParam(":training_id", $training_id);
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

                                    
                            </div>           
                            </td>
                        </tr>
                        <tr style="width:100%;">
                            <td style="">
                                <span>Ａ班実施日時：</span>
                            </td>
                            <td style="vertical-align:middle;">
                                <input type="datetime-local" name="datetime_a_start" value = "<?php echo $start_time_a; ?>" id="datetimeAStart" class="input-main-form">
                            </td>
                            <td style="vertical-align:middle;">
                                <input type="datetime-local" name="datetime_a_end" value="<?php echo $end_time_a; ?>" id="datetimeAEnd" class="input-main-form">
                            </td>
                            <td style="padding: 0;">
                            場所：
                            </td>
                            <td style="">
                                <input type="text" id="LocationA" name="location_a" maxlength="10" value="<?php echo $location_a; ?>" class="input-main-form">
                            </td>
                            <td style="padding: 0;">
                            講師：
                            </td>
                            <td>
                        
                            <!--SEARCH INSTRUCTOR-->
                            
                            <div class="container" style="overflow:visible;">
                                    <select name="instructor_a" id=""  class="selectpicker" data-live-search = "true" data-allow-clear="true" data-size="6" data-max-options="1" title="講師選択">
                                    <?php
                                        $query_instructor = "SELECT name_ FROM users
                                        where userlevel = '2'";

                                        $stmt_instructor = $pdo->prepare($query_instructor);
                                        //$stmt_interviewee->bindParam(":training_id", $training_id);
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
                            </div>
                               
                            </td>
                        </tr>

                        <tr style="width:100%;">
                            <td style="">
                                <span>Ｂ班実施日時：</span>
                            </td>
                            <td style="vertical-align:middle;">
                                <input type="datetime-local" name="datetime_b_start" id="datetime_b_start" value="<?php echo $start_time_b; ?>" class="input-main-form">
                            </td>
                            <td style="vertical-align:middle;">
                                <input type="datetime-local" name="datetime_b_end" id="datetime_b_end" value="<?php echo $end_time_b; ?>" class="input-main-form">
                            </td>
                            <td style="padding: 0;">
                            場所：
                            </td>
                            <td style="">
                                <input type="text" id="Location_b" name="location_b" maxlength="10" value="<?php echo $location_b; ?>" class="input-main-form">
                            </td>
                            <td style="padding: 0;">
                            講師：
                            </td>
                            <td>
                                <div class="container" style="overflow:visible;">
                                    <select name="instructor_b" id=""  class="selectpicker" data-live-search = "true" data-allow-clear="true" data-size="6" data-max-options="1" title="講師選択">
                                        <?php
                                            $query_instructor = "SELECT name_ FROM users
                                            where userlevel = '2'";

                                            $stmt_instructor = $pdo->prepare($query_instructor);
                                            //$stmt_interviewee->bindParam(":training_id", $training_id);
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
                                </div>
                            </td>
                        </tr>

                        <tr style="width:100%;">
                            <td>
                                <span>Ｃ班実施日時：</span>
                            </td>
                            <td style="vertical-align:middle;">
                                <input type="datetime-local" name="datetime_c_start" id="datetime_c_start" value="<?php echo $start_time_c; ?>" class="input-main-form">
                            </td>
                            <td style="vertical-align:middle;">
                                <input type="datetime-local" name="datetime_c_end" id="datetime_c_end" value="<?php echo $end_time_c; ?>" class="input-main-form">
                            </td>
                            <td style="padding: 0;">
                            場所：
                            </td>
                            <td style="">
                                <input type="text" id="CRegular" name="location_c" maxlength="10" value="<?php echo $location_c; ?>" class="input-main-form">
                            </td>
                            <td style="padding: 0;">
                            講師：
                            </td>
                            <td>
                                <div class="container" style="overflow:visible;">
                                    <select name="instructor_c" id=""  class="selectpicker" data-live-search = "true" data-allow-clear="true" data-size="6" data-max-options="1" title="講師選択">
                                        <?php
                                            $query_instructor = "SELECT name_ FROM users
                                            where userlevel = '2'";

                                            $stmt_instructor = $pdo->prepare($query_instructor);
                                            //$stmt_interviewee->bindParam(":training_id", $training_id);
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
                                </div>
                            </td>
                        </tr>

                        <tr style="width:100%;">
                            <td>
                                <span>Ｄ班実施日時：</span>
                            </td>
                            <td style="vertical-align:middle;">
                                <input type="datetime-local" name="datetime_d_start" id="datetime_d_start" value="<?php echo $start_time_d; ?>" class="input-main-form">
                            </td>
                            <td style="vertical-align:middle;">
                                <input type="datetime-local" name="datetime_d_end" id="datetime_d_end" value="<?php echo $end_time_d; ?>" class="input-main-form">
                            </td>
                            <td style=" padding: 0;">
                            場所：
                            </td>
                            <td>
                                <input type="text" id="location_d" maxlength="10" name="location_d" value="<?php echo $location_d; ?>" class="input-main-form">
                            </td>
                            <td style="padding: 0;">
                            講師：
                            </td>
                            <td>
                                <div class="container" style="overflow:visible;">
                                        <select name="instructor_d" id=""  class="selectpicker" data-live-search="true" data-allow-clear="true" data-max-options="1" data-size="6" title="講師選択">
                                        <?php
                                            $query_instructor = "SELECT name_ FROM users
                                            where userlevel = '2'";

                                            $stmt_instructor = $pdo->prepare($query_instructor);
                                            //$stmt_interviewee->bindParam(":training_id", $training_id);
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
                                </div>
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
                                        <input type="checkbox" 
                                        id="categoryOther" 
                                        name="category[]"
                                        class="form-check-input" 
                                        value="4"
                                        style="vertical-align: middle;"
                                        <?php if(in_array(4,$category)) {echo 'checked';}?>>
                                        <label for="categoryOther" class="fs-6">その他</label>
                                        <input type="text" 
                                        id="categoryOtherManual" 
                                        value="" 
                                        name="category_others_manual" 
                                        placeholder="PLEASE SPECIFY"
                                        style="width:50%"
                                        class="input-main-form">
                                      
                                    </div>
                                </td> 


                            </tr>
                        </tbody>
                    </table>        
                </div>
                <div id="purposeDIV" class="purposeDIV">
                    <caption><b>目的、対象者</b></caption>
                    <table id="purposeTable" border="1" class="table table-hover rounded-3 overflow-hidden mainrecordT2">
                        <tr>
                            <td colspan="1" style="width:10%">目的：</td>
                            <td colspan="4"><input type="text" name="purpose" id="purposeID" maxlength="50" value="<?php echo $purpose; ?>" style="width:96%" required class="input-main-form"></td>
                        </tr>
                        <tr>
                            <td colspan ="1" style="width:10%">対象者：</td>
                            <td style ="50%"><input type="text" name="audience" id="audienceID" maxlength="50" value="<?php echo $audience;?>" style="width:92%" required class="input-main-form"></td>
                            <td colspan ="1" style="width:2.5%">名:</td>
                            <td style="width:2.5%"><span class="jqValue" id="jqValue"></span><input type="text" id="count_value" name="count_value" hidden class="count_value input-main-form" value=""></td>
                            <td style="width:35%"></td>
                        </tr>
                    </table>
                </div>
                <div id="participantsDIV" class="participantsDIV">
                    <caption><b>受講者（製造）</b></caption>        
                    <table id="participantsTable" class="table table-hover table-bordered rounded-3 table-sm overflow-hidden participantsT">
                        <thead class="table text-center theadstyle participants_thead" style="width: 98.5%;">
                            <tr id="firstrow" style="height: 40px;">
                                <th style="width:5%; vertical-align:middle;height:40px;"><input type="checkbox" class=""  id="select_all" onClick="toggle(this)" onchange="count()" style="vertical-align:middle;"></th>
                                <th style="width:12%; vertical-align:middle;height:40px;">GID
                                    <a href="" role="button" id="dropdown_GID_search" data-bs-toggle="dropdown" aria-expanded="false" style="color:white" ><i id="GID_search_icon" style="float:right;" class="bi bi-caret-down"></i></a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <div class="list-group-item">           
                                                <input type="text" name="GID_search" id="GID_search" class="form-control" 
                                                    value = ""        
                                                    placeholder="Search GID">                                              
                                            </div>              
                                        </ul> 
                                </th>
                                <th style="width:18%; vertical-align:middle;height:40px;">名前
                                    <a href="" role="button" id="drowdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color:white" ><i id= "GID_name_icon" style="float:right;" class="bi bi-caret-down"></i></a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <div class="list-group-item">           
                                                <input type="text" name="GID_name" id="GID_name" class="form-control" 
                                                    value = ""        
                                                    placeholder="名前">                                              
                                            </div>              
                                        </ul> 
                                </th>
                                <th style="width:10%; vertical-align:middle;height:40px;">
                                    <a href="" role="button" id="drowdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color:white">班<i id="shift_icon" style="float:right;" class="bi bi-caret-down"></i></a></a>
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
                                                    <label><input type="checkbox" class="common_selector shift" name="checkbox_shift[]" value="
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
                                </th>
                                <th style="width:18%; vertical-align:middle; height:40px;">
                                    <a href="" role="button" id="drowdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color:white">工程<i id="process_icon" style="float:right;" class="bi bi-caret-down"></i></a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="max-height: 300px; overflow-y:scroll">
                                            <?php
                                                $query = "SELECT DISTINCT(department_name) FROM users
                                                    INNER JOIN department ON users.department_id = department.department_id
                                                    where group_id = '$group_'
                                                    ;";
                                                $stmt = $pdo->prepare($query);
                                                $stmt->execute();
                                                $result = $stmt->fetchAll();
                                                foreach($result as $row)
                                                    {
                                            ?>
                                                <div class="list-group-item checkbox">
                                                    <label><input type="checkbox" name="checkbox_process[]" class="common_selector process" 
                                                       
                                                        value="<?php echo $row["department_name"];
                                                        ?>
                                                        "> <?php echo $row["department_name"];
                                                        ?>
                                                    </label>
                                                </div>
                                                    <?php
                                                    }
                                                    ?> 
                                        </ul>  
                                </th>
                                <th style="width:8%; vertical-align:middle; height:40px;">
                                    <a href="" role="button" id="drowdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color:white">号棟<i id="building_icon" style="float:right;" class="bi bi-caret-down"></i></a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <?php
                                                $query = "SELECT DISTINCT(building_id),building_name FROM buildings
                                                    
                                                    ORDER by building_id ASC
                                                    ;";
                                                $stmt = $pdo->prepare($query);
                                                $stmt->execute();
                                                $result = $stmt->fetchAll();
                                                foreach($result as $row)
                                                    {
                                            ?>
                                                <div class="list-group-item checkbox">
                                                    <label><input type="checkbox" name="checkbox_building[]" class="common_selector building" value="
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
                                <th style="width:10%; vertical-align:middle; height:40px;">
                                    <a href="" role="button" id="drowdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color:white">役職<i id="position_icon" style="float:right;" class="bi bi-caret-down"></i></a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="height: 300px; overflow-y:scroll;">
                                            <?php
                                                $query = "SELECT DISTINCT(users.position_id),position_level, position FROM users
                                                    INNER JOIN
                                                        position ON position.position_id = users.position_id
                                                    ORDER by position_level ASC
                                                    ;";
                                                $stmt = $pdo->prepare($query);
                                                $stmt->execute();
                                                $result = $stmt->fetchAll();
                                                foreach($result as $row)
                                                    {
                                            ?>
                                                <div class="list-group-item checkbox">
                                                    <label><input type="checkbox" name="checkbox_position[]" class="common_selector position" value="
                                                        <?php echo $row["position_id"];
                                                        ?>
                                                        "
                                                        <?php 
                                                            if($_SESSION["position_level"] > $row["position_level"]) {
                                                                echo "checked";
                                                            }
                                                        ?>
                                                        
                                                        
                                                        
                                                        > <?php echo $row["position"];?>
                                                    </label>
                                                </div>
                                                    <?php
                                                    }
                                                    ?> 
                                        </ul>   
                                </th>
                                <th style="width:19%; vertical-align:middle; height:40px;">
                                    <a href="" role="button" id="drowdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color:white">従業員ステータス<i id="employee_status_icon" style="float:right;" class="bi bi-caret-down"></i></a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="height: 300px; overflow-y:scroll;">
                                            <?php
                                                $query = "SELECT DISTINCT(employee_status_id),employee_status_name FROM employee_status
                                                    
                                                    ORDER by employee_status_id ASC;
                                                    ";
                                                $stmt = $pdo->prepare($query);
                                                $stmt->execute();
                                                $result = $stmt->fetchAll();
                                                foreach($result as $row)
                                                    {
                                            ?>
                                                <div class="list-group-item checkbox">
                                                    <label><input type="checkbox" name="checkbox_employee_status[]" class="common_selector employee_status" value="
                                                        <?php echo $row["employee_status_id"];
                                                        ?>
                                                        "

                                                        <?php
                                                             switch($row["employee_status_id"]) {
                                                                case"13":
                                                                    echo "checked";
                                                                    break;
                                                                case"11":
                                                                    echo "checked";
                                                                    break;
                                                                case"12":
                                                                    echo "checked";
                                                                    break;
                                                                case"10":
                                                                    echo "checked";
                                                                    break;
                                                                case"9":
                                                                    echo "checked";
                                                                    break;
                                                                case"7":
                                                                    echo "checked";
                                                                    break;
                                                                case"14":
                                                                    echo "checked";
                                                                    break;
                                                                }
                                                              
                                                        ?>
                                                     
                                                        >
                                                       
                                                        <?php echo $row["employee_status_name"];?>

                                                    </label>
                                                </div>
                                                    <?php
                                                    }
                                                    ?> 
                                        </ul>   
                                </th>
                            </tr>
                        </thead>
                        <tbody id="post_list" class="participants_tbody">
                        </tbody>
                    
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
                    <span style = 'font-size: 10px; text-align:left;'>ファイルタイプ: 'jpg'、'jpeg'、'png'、'pdf'、'xlsx'、'docs'、'xls'、'docx'、'ppt'、'pptx'、'csv'、'doc'</span>
                    <div class='upload_div'>
                    
                        <div class='mb-3'>
                            <input class='form-control' type='file' id='file-upload' name='file[]' style='width:50%; background-color:lightyellow;' multiple>
                        </div>
                    </div>
                    ";
                }

                ?>
                <div id="contentsDIV" class="contentsDIV">
                    <caption><b>内容</b></caption>
                    <table id="contentsTable" border="1" class="contentsT">
                        <tr>
                            <td><textarea type="text" name="contents" id="contentsID" value="" class="contentsInput" rows="3" required><?php  echo $contents; ?></textarea></td>
                        </tr>
                    </table>
                </div>
                <div id="usageDIV">
                <caption><b>使用資料（作業標準がある場合には、作業標準№を記入、ない場合には資料名等を記入）</b></caption>
                    <table id="usageTable" border="1" class="usageT">
                        <tr>
                            <td colspan="4"><textarea type="text" name="usage_" id="usage-materials" value="" rows="3" class="usageInput" required><?php echo $usage_id; ?></textarea></td>
                        </tr>
                        <tr>
                            
                            <!--<td style="justify-tems:center; width:45%;">訓練資料を追加(任意):<input type="file" name="file[]" multiple class="input-main-form"></td>
                        
                            <td style="width: 60%;"></td> -->
                        </tr>
                    </table>
                </div>
                <div id="confirmation_by" class="confirmation_by_div">
                    <caption style="text-align:center;"><b>教育効果の確認方法、確認予定日</b></caption>
                    <table id="confirmation_table" border="1" class="table table-hover rounded-3 overflow-hidden mainrecordT2">
                        <tr>
                            <td colspan="4" style="width:100%"><input type="text" maxlength="50" name="confirmation_by" id="confirmation_by_id" value="インタビュー式による確認" class="input-main-form" style="width:100%" required></td>
                        </tr>
                        <tr>
                            <td colspan="1" style="width:25%; vertical-align:middle;">最終確認予定日：</td>
                            <td colspan="1" style="width:25%"><input type="datetime-local" name="confirmation_date" class="input-main-form" id="confirmation_date_id" value="<?php echo $confirmation_date; ?>" style="width:90%" required></td>
                            <td colspan="1"></td>
                            <td colspan="1"></td>
                        </tr>
                    </table>
                </div>
                <!--<div id="checker_comment_regular" class="checker_comment_regular_div">
                    <caption style="text-align:center;"><b>教育効果の確認結果</b></caption>
                    <table id="confirmation_table" border="1" class="table table-hover rounded-3 overflow-hidden mainrecordT2">
                        <tr>
                            <td colspan="1" style="width:10%">日勤者：</td>
                            <td colspan="2" style="width:65%"><input type="text" class="input-main-form" name="checker_people_regular" id="checker_people_regular" disabled value="" style="width:100%"></td>
                            <td colspan="1" style="width:25%"><input type="datetime-local" class="input-main-form" name="checker_date_regular" id="checker_date_regular" disabled value="" style="width:90%"></td>
                        </tr>
                        <tr>
                            <td colspan="4" style="width:100%"><input type="text" class="input-main-form" name="checker_comment_regular" id="checker_comment_regular"
                             value="上記の人にインタビューを実施し、理解できたことを確認できました。" style="width:100%"></td>
                        </tr>
                    </table>
                </div>-->
             
                    <!--<button type="submit" class = "btn-update" style="text-decoration:none; margin-right:20px;" id="checkBtn"><span>送信&nbsp;&nbsp;&nbsp;<i class="fa-solid fs-6 fa-file-export"></i></span></button>
                    -->
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

    

    //Check the file extension 

    var file_selection;

    $("#file-upload").change(function () {

        file_selection = $("#file-upload");

        var count_files_upload = file_selection[0].files.length;

        if(count_files_upload > 4) {
            alert("Please upload a maximum of 4 files");
            $('#file-upload').val("");
        }
        console.log(count_files_upload);

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


    //Check if there is an upload file

    $("#file-upload").change(function() {
        if ($('#file-upload').get(0).files.length === 0) {
            $("#usage-materials").attr("required", true);
        }
        else {
            $("#usage-materials").attr("required", false);
        }
    });


    $("#btn-try").click(function(){
        $("#instructor-regular").prop("selected, false");
    });

    $('.selectpicker').selectpicker({
      maxOptions:3
  });

   $(".new-form-tab").addClass("active");

    add_files_data();

    $('#submit_button').click(function() {
        checked = $('input[name="GIDcheck[]"]:checked').length;

        checked_2 = $('input[name="category[]"]:checked').length;

        if(!checked) {
            alert("You must select at least one participant");
            return false;
        }
        
        if(!checked_2) {
            alert("You must select at least one category!");
            return false;
        }
    });

    filter_data();
    function filter_data() {
      //$('#post_list').html();
      var action = 'fetch_data';
      var shift = get_filter('shift');
      var process = get_filter('process');
      var building = get_filter('building');
      var participants = get_filter('participants');
      var position = get_filter('position');
      var employee_status = get_filter('employee_status');
      var participants_subtract = get_filter_uncheck('participants');
      var GID_search = $('#GID_search').val();
      var GID_name = $('#GID_name').val();
      

      //console.log(participants);
      

      $.ajax({
          url: "includes/fetch_data.inc.php",
          method: "POST",
          data: {action:action,shift:shift,process:process,building:building,participants:participants,
            position:position,employee_status:employee_status,GID_search:GID_search,GID_name:GID_name},
          success:function(data){
            $('#post_list').html(data);
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

    $('#GID_search').keyup(function(event){

    if($("#GID_search").val() !== "") {
        $("#GID_search_icon").attr("class","bi bi-funnel-fill");
    }
    else {
        $("#GID_search_icon").attr("class","bi bi-caret-down");
    }

    event.preventDefault();
    filter_data();

    });

    $('#GID_name').keyup(function(event){

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
            console.log("success");
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
            console.log("success");
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
            console.log("error");
        }
        });
    }


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
    console.log(checkedboxes);
    document.getElementById("count_value").value = checkedboxes;

}


//function for save filter






</script>

</body>
</html>

