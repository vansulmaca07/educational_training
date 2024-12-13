<?php  
    
    include_once 'navigation_test.php';
    include("includes/dbh2.inc.php");
   // echo json_encode($_SESSION["department_main_filter"]);

   $group_ = $_SESSION["group_id"];

   if(isset($_SESSION["participants_selected"])) {
        unset($_SESSION["participants_selected"]);
   }
   
?>

<style> 
.bootstrap-select > .dropdown-toggle.bs-placeholder:disabled {
    background-color: gray !important;   
}

/**term icon**/

.term.bootstrap-select .dropdown-menu { width: 220px !important; }

.term.bootstrap-select .dropdown-toggle /*dropdown,*/
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

.none-term.bootstrap-select .dropdown-toggle::after {
  border: none;
  font: normal normal normal 14px/1;
  font-style: bold;
  font-family: "bootstrap-icons";
  content: "\F22C"; /* the desired FontAwesome icon */
  vertical-align: 0; /* to center vertically */
}


.selected-term.bootstrap-select .dropdown-toggle::after {
  border: none;
  font: normal normal normal 14px/1;
  font-style: bold;
  font-family: "bootstrap-icons";
  content: "\F3E0"; /* the desired FontAwesome icon */
  vertical-align: 0; /* to center vertically */
}

/***Category Icon***/

.category.bootstrap-select .dropdown-menu { width: 220px !important; }

.category.bootstrap-select .dropdown-toggle /*dropdown,*/
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

.none-category.bootstrap-select .dropdown-toggle::after {
  border: none;
  font: normal normal normal 14px/1;
  font-style: bold;
  font-family: "bootstrap-icons";
  content: "\F22C"; /* the desired FontAwesome icon */
  vertical-align: 0; /* to center vertically */
}

.selected-category.bootstrap-select .dropdown-toggle::after {
  border: none;
  font: normal normal normal 14px/1;
  font-style: bold;
  font-family: "bootstrap-icons";
  content: "\F3E0"; /* the desired FontAwesome icon */
  vertical-align: 0; /* to center vertically */
}

/**status icon**/

.status.bootstrap-select .dropdown-toggle /*dropdown,*/
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

.none-status.bootstrap-select .dropdown-toggle::after {
  border: none;
  font: normal normal normal 14px/1;
  font-style: bold;
  font-family: "bootstrap-icons";
  content: "\F22C"; /* the desired FontAwesome icon */
  vertical-align: 0; /* to center vertically */
}

.selected-status.bootstrap-select .dropdown-toggle::after {
  border: none;
  font: normal normal normal 14px/1;
  font-style: bold;
  font-family: "bootstrap-icons";
  content: "\F3E0"; /* the desired FontAwesome icon */
  vertical-align: 0; /* to center vertically */
}

/**File No.**/

.btn-training-id-search {
    
    width: 100% !important;
    font-size: 14px !important;
    color: white;
    border: rgba(4, 73, 129, 0.808) !important;  
    text-align: center !important;
    font-style: bold !important;
    
}

/**File Name **/

.btn-training-name-search {
    
    width: 100% !important;
    font-size: 14px !important;
    color: white;
    border: rgba(4, 73, 129, 0.808) !important;  
    text-align: center !important;
    font-style: bold !important;
    
}

/**Creator Name **/

.btn-creator-name {
    
    width: 100% !important;
    font-size: 14px !important;
    color: white;
    border: rgba(4, 73, 129, 0.808) !important;  
    text-align: center !important;
    font-style: bold !important;
    
}

</style>
                    <div class="header-1" style="text-align:center; margin-top:1%;">
                        <h4><b>進捗状況</b></h4>
                        <hr>
                        <div class="new-form-header" id="alert_card_window" style="position:absolute; z-index:4;">
                            <?php 
                                if(isset($_GET["success_delete"])) {
                                    echo "                               
                                        <div class='alert alert-success alert-dismissible fade show pt-2 pb-2' style='bottom: 45px;' role='alert'>
                                            $_GET[success_delete] は正常に削除されました!
                                            <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
                                        </div>
                                            ";     
                                }
                                if(isset($_GET["success_created"])) {
                                    echo "                               
                                        <div class='alert alert-success alert-dismissible fade show pt-2 pb-2' style='bottom: 45px; width:400px;' role='alert'>
                                            $_GET[success_created] が正常に作成されました!
                                            <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
                                        </div>
                                            ";     
                                }
                                if(isset($_GET["error"])) {
                                    if($_GET["error"] === "file_type") { 
                                        echo "
                                            <div class='alert alert-danger alert-dismissible fade show pt-2 pb-2' style='bottom: 45px; width:600px;' role='alert'>
                                                エラー：ファイルはアップロードできません。<br>
                                                ファイル形式： 'jpg','jpeg','png','pdf','xlsx','docs','xls','docx','ppt','pptx','csv', 'doc'
                                                <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>
                                            ";
                                    }
                                }
                            ?> 
                    </div>
                    </div>
                    <div class="container-filters">
                    <table border="1"  class="table table-sm table-hover rounded-3 mainrecordT2 overflow-visible" style="width:100%; table-layout:fixed;">
                        <tbody>
                            <tr style="width:100%">
                                <td style="width:20%">
                                   
                                    <div class="input-group" style = "width:100%;">
                                    <span class="input-group-text">所属G係</span>
                                    <select class="selectpicker form-control" data-size = "6" data-live-search = "true" multiple id="status input-group-select" data-actions-box="true" aria-label="size 3 select example">
                                        <?php

                                            //DEFAULT FILTER

                                            $query_group_filter = "SELECT group_ FROM progress_filters
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
                                                   $saved_group_filter = json_decode($row_group_filter["group_"]);
                                                }    
                                            }
                                        
                                            else {
                                               //continue
                                            }
                                            
                                            $query_group = "SELECT * FROM group_
                                            ORDER by group_name
                                            ";

                                            $stmt_group = $pdo->prepare($query_group);
                                            $stmt_group->execute();
                                            $result_group = $stmt_group->fetchAll();

                                            foreach($result_group as $group_list) {
                                                echo "<option value='$group_list[group_id]' name='group_main_filter[]' id='group_main_filter'";  
                                                
                                                    if(isset($_SESSION["group_main_filter"])) {
                                                        $session_filter = $_SESSION["group_main_filter"];
                                                        if(in_array("$group_list[group_id]", $session_filter)) {
                                                                echo "selected";
                                                            }
                                                    }

                                                    else if(isset($saved_group_filter)) {
                                                        if(in_array("$group_list[group_id]", $saved_group_filter)) {
                                                            echo "selected";
                                                            }
                                                    }

                                                    else {
                                                        if($group_list["group_id"] === $group_) {
                                                            echo "selected";
                                                        }
                                                    } 
                                                        echo " class='group_main_filter'>$group_list[group_name] </option>";                                                               
                                            }        
                                                    ?>
                                    </select>
                                  
                            </div>        
                                </td>
                                <td style="width:20%">
                                <div class="input-group w-100 text-center">
                                <span class="input-group-text">工程</span>
                                <select class="selectpicker form-control" style="" data-size = "6" data-live-search = "true" multiple id="input-department-select" data-actions-box="true" aria-label="size 3 select example">
                                    <?php
                                        
                                        //SAVED FILTER
                                                
                                        $query_department_filter = "SELECT department FROM progress_filters
                                            WHERE
                                               GID = :GID
                                               ";
                                           
                                            $stmt_department_filter = $pdo->prepare($query_department_filter);
                                            $stmt_department_filter->bindParam(":GID", $_SESSION["GID"]);
                                            $stmt_department_filter->execute();
                                            $result_department_filter = $stmt_department_filter->fetchAll();
                                            $result_department_filter_count = $stmt_department_filter->rowCount();
                                           
                                            if($result_department_filter_count > 0) {
                                                foreach($result_department_filter as $row_department_filter) {
                                                   $saved_department_filter = json_decode($row_department_filter["department"]);
                                                }    
                                            }
                                        
                                            else {
                                               //continue
                                            }  
                                        
                                            
                                        $query_department = "SELECT * FROM department";

                                        $stmt = $pdo->prepare($query_department);
                                        $stmt->execute();
                                        $result = $stmt->fetchAll();

                                        foreach($result as $department_list) {
                                            echo "<option value='$department_list[department_id]' name='department_main_filter[]'";              
                                                if(isset($_SESSION["department_main_filter"])) {
                                                    $session_filter = $_SESSION["department_main_filter"];
                                                    if(in_array("$department_list[department_id]", $session_filter)) {
                                                        echo "selected";
                                                        }
                                                }

                                                else if(isset($saved_department_filter)) {
                                                    
                                                    if(in_array("$department_list[department_id]", $saved_department_filter)) {
                                                        echo "selected";
                                                        }
                                                }
                                                
                                                else {
                                                    if($department_list["department_id"] === $_SESSION["department"]) {
                                                        echo "selected";
                                                        }
                                                    } 
                                                    echo " class='department_main_filter'>$department_list[department_name] </option>";                                                                  
                                            }
                                        /*
                                        foreach($result as $department_list) {
                                            echo "<option value='$department_list[department_id]' name='department_main_filter[]'";              
                                               if(isset($_SESSION["department_main_filter"])) {
                                                    $session_filter = $_SESSION["department_main_filter"];
                                                    if(in_array("$department_list[department_id]", $session_filter)) {
                                                        echo "selected";
                                                        }
                                                }                  
                                                else if($department_list["department_id"] === $_SESSION["department"]){
                                                        
                                                        echo "selected";
                                                        
                                                }
                                                
                                                else {
                                                    
                                                }
                                                    echo "class='department_main_filter'>$department_list[department_name] </option>";                                                                  
                                            }*/
                                    ?>
                                </select>
                            </div>
                                </td>
                                <td style="width:18%">
                                    <input id="start_date_filter" class="form-control" type="date" 
                                    <?php if(isset($_SESSION["start_date_filter"])) { echo "value = '$_SESSION[start_date_filter]'"; } ?>> 
                                </td>
                                <td style="width:3%;" class="fs-4">~</td>
                                <td style="width:18%">
                                    <input id="end_date_filter" class="form-control" type="date"
                                    <?php if(isset($_SESSION["end_date_filter"])) { echo "value = '$_SESSION[end_date_filter]'"; } ?>> 
                                </td>
                                <td style="width:8%">
                                    <a href = 'includes/excel_file.php' class='btn btn-primary' style ='vertical-align:middle;'>.xls&nbsp;&nbsp;<i style='vertical-align: middle;' class='bi bi-download'></i></a></td>
                                </td>
                                <td style="width:13%">
                                    <a class="btn btn-danger" style="float:right;" href = "includes/reset_filter.inc.php">リセット&nbsp;&nbsp;<i class="fa-solid fa-filter-circle-xmark"></i></a>
                                </td> 
                            </tr>
                        </tbody>
                    </table>

                    </div>

                    <!--Progress Table-->
                    <div class="progress-t-container" style="height:75%;">
                        <table id="progressTable" class="table table-hover table-sm table-bordered rounded-3 overflow-visible progressT word-break" style="height:100%; table-layout:fixed;">
                            <thead >
                                <tr id="firstrow" style="width:100%">
                                    <!--term-->
                                    <th style="width:8%; vertical-align:middle;">
                                        <div class="status-container" style="width:100%;">
                                            <select data-selected-text-format="static" title="期" class="term selectpicker form-control" data-size = "6" data-live-search = "true" style=""
                                                multiple id="input-term-select" data-actions-box="true" aria-label="size 3 select example">
                                                    <?php
                                                        $query_term = "SELECT distinct term FROM training_form              
                                                        ";
                                                        $stmt_term = $pdo->prepare($query_term);
                                                        $stmt_term->execute();
                                                        $result_term = $stmt_term->fetchAll();
                                                        foreach($result_term as $row_term)
                                                        {
                                                            echo "<option name='checkbox_term[]'  value='$row_term[term]' class='common_selector term'
                                                                ";        
                                                            if(isset($_SESSION["term_filter"])) {
                                                                $session_term_filter = $_SESSION["term_filter"];
                                                                if(in_array("$row_term[term]", $session_term_filter)) {
                                                                    echo "selected";
                                                                }
                                                            }  
                                                            echo ">$row_term[term]</option>";
                                                        }
                                                    ?>
                                            </select>
                                        </div> 
                                    </th> 
                                    <!--No-->
                                    <th style="width:8%; vertical-align:middle;">
                                        <div class="dropdown">
                                            <button class="btn btn-training-id-search" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                No. <i class="bi bi-caret-down float-right" id="training_id_icon" style="float: right;"></i>
                                            </button>
                                            <ul class="dropdown-menu p-2" style="width: 250px;" aria-labelledby="dropdownMenuButton1">
                                                <li><input type="search" name="training_id_search" id="training_id_search" class="dropdown-item" 
                                                    value = "<?php if(isset($_SESSION["training_id_filter"])) { echo $_SESSION["training_id_filter"];}?>" 
                                                    placeholder="Search Training ID">
                                                </li>
                                            </ul>
                                        </div>
                                    </th>
                                    <!--PDF-->                                                              
                                    <th style="width:5%; vertical-align:middle;">PDF</th>
                                    <!--Training Creator-->
                                    <th style="width:10%; vertical-align:middle;">
                                        <div class="dropdown">
                                            <button class="btn btn-creator-name" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            作成<i class="bi bi-caret-down float-right" id="creator_name_icon" style="float: right;"></i>
                                            </button>
                                            <ul class="dropdown-menu p-2" style="width: 400px;" aria-labelledby="dropdownMenuButton1">
                                                <li><input type="search" name="creator_name" id="creator_name" class="dropdown-item" 
                                                    value = "<?php if(isset($_SESSION["training_creator_filter"])) { echo $_SESSION["training_creator_filter"]; }?>" 
                                                    placeholder="作成名前を入力">
                                                </li>
                                            </ul>
                                        </div>
                                    </th>
                                    <!--File Name-->
                                    <th style="width:25%; vertical-align:middle;">
                                        <div class="dropdown">
                                            <button class="btn btn-training-name-search" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            ファイル名<i class="bi bi-caret-down float-right" id="training_name_icon" style="float: right;"></i>
                                            </button>
                                            <ul class="dropdown-menu p-2" style="width: 400px;" aria-labelledby="dropdownMenuButton1">
                                                <li><input type="search" name="training_name" id="training_name" class="dropdown-item" 
                                                    value = "<?php if(isset($_SESSION["training_name_filter"])) { echo $_SESSION["training_name_filter"];}?>" 
                                                    placeholder="Search Training Name">
                                                </li>
                                            </ul>
                                        </div>
                                    </th>
                                    <!--Category--> 
                                    <th style="width:10%; vertical-align:middle;">
                                        <div class="category-container" style="width:100%;">
                                            <select data-selected-text-format="static" title="区分" class="category selectpicker form-control" data-size = "6" data-live-search = "true" style=""
                                                multiple id="input-category-select" data-actions-box="true" aria-label="size 3 select example">
                                                    <?php
                                                            $query = "SELECT distinct C.category_id, CR.category_name   FROM category C
                                                                INNER JOIN 
                                                                    (select distinct category_id, category_name from category_ref) CR  
                                                                ON 
                                                                    C.category_id = CR.category_id
                                                                ORDER by 
                                                                    C.category_id ASC;";
                                                            $stmt = $pdo->prepare($query);
                                                            $stmt->execute();
                                                            $result = $stmt->fetchAll();
                                                            foreach($result as $row)
                                                            {
                                                                echo "<option name='checkbox_category[]'  value='$row[category_id]' class='common_selector category'
                                                                    ";        
                                                                if(isset($_SESSION["category_filter"])) {
                                                                    $session_category_filter = $_SESSION["category_filter"];
                                                                    if(in_array("$row[category_id]", $session_category_filter)) {
                                                                        echo "selected";
                                                                    }
                                                                }  
                                                                echo ">$row[category_name]</option>";
                                                            }
                                                        ?>
                                                </select>
                                            </div>          
                                    </th>
                                    <!--status--> 
                                    <th style="width:19%; vertical-align:middle;">                      
                                        <div class="status-container" style="width:100%;">
                                            <select data-selected-text-format="static" title="全体状態" class="status selectpicker form-control" data-size = "6" data-live-search = "true" style="width: 15%;"
                                                multiple id="input-status-select" data-actions-box="true" aria-label="size 3 select example">
                                                    <?php
                                                        $query_status = "SELECT distinct T.status_id, SR.status_name FROM training_form T
                                                        INNER JOIN 
                                                          (select distinct status_id, status_name from status_ref) SR ON T.status_id = SR.status_id
                                                        ORDER by 
                                                            T.status_id ASC
                                                        ";
                                                        $stmt_status = $pdo->prepare($query_status);
                                                        $stmt_status->execute();
                                                        $result_status = $stmt_status->fetchAll();
                                                        foreach($result_status as $row_status)
                                                        {
                                                            echo "<option name='checkbox_status[]'  value='$row_status[status_id]' class='common_selector status' common_selector status
                                                                ";        
                                                            if(isset($_SESSION["status_filter"])) {
                                                                $session_status_filter = $_SESSION["status_filter"];
                                                                if(in_array("$row_status[status_id]", $session_status_filter)) {
                                                                    echo "selected";
                                                                }
                                                            }  
                                                                echo ">$row_status[status_name]</option>";
                                                            }
                                                    ?>
                                            </select>
                                        </div>
                                    </th> 
                                    <th style="width:15%; vertical-align:middle; text-align:center;">サイン進捗</th>
                                </tr>
                            </thead>
                            <tbody id="post_list2">
                                
                            </tbody>
                        </table>    
                    </div>
                    
                    <!---Modal for Approver Mail Participants--->
            
                    <div class="modal fade overflow-auto h-100"  id="mail-approver-modal" style="height: 400px;" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">   
                    <div class="modal-dialog modal-lg ">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <h5 class="modal-title text-center" style="text-align:center;" id="staticBackdropLabel">電子メール</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <select name="approver_GID[]" id="approver_GID" multiple class="selectpicker w-50 overflow-visible" data-actions-box="true" data-live-search = "true" data-size="6" data-allow-clear="true"  title="講師選択">
                                        <?php

                                            //Default Approver
                                            
                                            $query = "SELECT GID, approver FROM progress_filters
                                                WHERE
                                                    GID = :GID
                                                ";

                                            $stmt = $pdo->prepare($query);
                                            $stmt->bindParam(":GID", $_SESSION["GID"]);
                                            $stmt->execute();
                                            
                                            $result = $stmt->fetchAll();

                                            foreach ($result as $default_list) {
                                                $default_approver = json_decode($default_list["approver"]);
                                            }

                                            //Execute query for options
                                            $query_instructor = "SELECT name_, GID FROM users
                                                WHERE
                                                    userlevel = '2'
                                                OR
                                                    userlevel = '1'
                                                OR
                                                    userlevel = '4'
                                                ";

                                            $stmt_instructor = $pdo->prepare($query_instructor);
                                            $stmt_instructor->execute();

                                            $result_query_instructor = $stmt_instructor->fetchAll();

                                            foreach ($result_query_instructor as $instructors) {
                                                echo "<option value ='$instructors[GID]'";
                                                
                                                if($default_approver !== NULL) {
                                                    if(in_array($instructors["GID"], $default_approver)) {
                                                        echo "selected";
                                                    }
                                                }

                                                echo">$instructors[name_]</option>";
                                            }
                                        ?>
                                    </select>
                                    選択した確認者に電子メールを送りますか?<br>
                                    <table class="table text-center">
                                        <thead>
                                            <th>GID</th>
                                            <th>名前</th>
                                            <th>メール</th>
                                        </thead>
                                        <tbody id="post_list_approver_mail">
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
                    <!---Modal for Mail Participants--->
            
                    <div class="modal fade overflow-auto" id="email-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
            </div> <!--paddin-->
        </div> <!--col-->
    </div> <!--row-->
</div> <!--container-fluid-->
    
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script type="text/javascript">



$(document).ready(function() {

    change_icon();

//Mail Button 

//<a data-bs-toggle='modal' id='email-modal-btn' data-bs-target='#email-modal' value='$row[training_id]' class='btn-link mail-btn' >

    var training_id;

    //Send Email Table AJAX

    $("#progressTable tbody").on("click", ".mail-btn", function () {

        training_id = $(this).val();
        console.log(training_id);

        email_table();
    });
   

    function email_table() {
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
        $.ajax({
            url: "includes/test_mail.php",
            method: "POST",
            data: {training_id:training_id},
            success:function(data){
                $('#alert_card_window').html(data);
                console.log(data);
            }
        });
    } 
    
$(".progress-tab").addClass("active");

$("#start_date_filter").on("change", function() {
    filter_data();
});

$("#end_date_filter").on("change", function() {
    filter_data();
});

filter_data();

function filter_data() {
    $('#post_list2').html();
    var action = 'fetch_data';
    var category = get_filter('category');
    var term = get_filter('term');
    var status = get_filter('status');
    var group = get_filter('group_main_filter');
    var department_main_filter = get_filter('department_main_filter');
    var category_main_filter = get_filter('category_main_filter');
    var training_name = $('#training_name').val();
    var training_creator = $('#creator_name').val();
    var training_id_search = $('#training_id_search').val();
    var training_name_main_filter = $('#training_name_main_filter').val();
    var training_id_main_filter = $('#training_id_main_filter').val();
    var training_creator_main_filter = $('#training_creator_main_filter').val();
    var start_date = $("#start_date_filter").val();
    var end_date = $("#end_date_filter").val();

    console.log(start_date);
    console.log(end_date);
  
    $.ajax({
        
        url: "includes/fetch_data_progress.inc.php",
        method: "POST",
        data: {action:action, 
            category:category,
            term:term, 
            status:status, 
            group:group,
            department_main_filter:department_main_filter,
            category_main_filter:category_main_filter, 
            training_name:training_name, 
            training_creator:training_creator,
            training_id_search:training_id_search,
            training_creator_main_filter:training_creator_main_filter,
            training_id_main_filter:training_id_main_filter,
            training_name_main_filter:training_name_main_filter,
            start_date:start_date,
            end_date:end_date},

        success:function(data){
            $('#post_list2').html(data);
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

    if($('input[name="checkbox_term[]"]:checked').length > 0) {
        $("#term_icon").attr("class", "bi bi-funnel-fill");
    }
    else {
        $("#term_icon").attr("class", "bi bi-caret-down");
    }

    if($('input[name="checkbox_category[]"]:checked').length > 0) {
        $("#category_icon").attr("class", "bi bi-funnel-fill");
    }
    else {
        $("#category_icon").attr("class", "bi bi-caret-down");
    }

    if($('#input-status-select :selected').length > 0) {
        $("#status_icon").attr("class", "bi bi-funnel-fill");
    }
    else {
        $("#status_icon").attr("class", "bi bi-caret-down");
    }

    filter_data();   
});

$('.main-filter').click(function(){
    filter_data();
    
});

$('#input-group-select').change(function() {

  
    filter_data();
});

$('#input-department-select').change(function() {
    filter_data();
});


//TEST selectcpiker

$('#input-status-select').change(function() {
    change_icon();
    filter_data();
});

$('#input-term-select').change(function() {
    change_icon();
    filter_data();
});

$('#input-category-select').change(function() {
    change_icon();
    filter_data();
});

//Change Icon

function change_icon() {

    if($('#input-status-select :selected').length > 0) {
        $('.status').removeClass("none-status").addClass("selected-status");
    }
    else {
        $('.status').removeClass("selected-status").addClass("none-status"); 
    }
    if($('#input-term-select :selected').length > 0) {
        $('.term').removeClass("none-term").addClass("selected-term");
    }
    else {
        $('.term').removeClass("selected-term").addClass("none-term");
    }
    if($('#input-category-select :selected').length > 0) {
        $('.category').removeClass("none-category").addClass("selected-category");
    }
    else {
        $('.category').removeClass("selected-category").addClass("none-category");
    }

    if($("#training_name").val() !== "") {
        $("#training_name_icon").attr("class","bi bi-funnel-fill");
    }
    else {
        $("#training_name_icon").attr("class","bi bi-caret-down");
    }

    if($("#training_id_search").val() !== "") {
        $("#training_id_icon").attr("class","bi bi-funnel-fill");
    }
    else {
        $("#training_id_icon").attr("class","bi bi-caret-down");
    }
    if($("#creator_name").val() !== "") {
        $("#creator_name_icon").attr("class","bi bi-funnel-fill");
    }
    else {
        $("#creator_name_icon").attr("class","bi bi-caret-down");
    }

}

//term

$("#input-term-select").change(function() {

    if($("#input-term-select :selected").length > 0) {
        $("term_icon").attr("class", "bi bi-funnel-fill");
    }
    else {
        $("#term_icon").attr("class", "bi bi-caret-down");
    }

});


// search for training name

$('#training_name').on("input",function(){

    if($("#training_name").val() !== "") {
        $("#training_name_icon").attr("class","bi bi-funnel-fill");
    }
    else {
        $("#training_name_icon").attr("class","bi bi-caret-down");
    }
    event.preventDefault();

    filter_data();

});

$('#creator_name').on("input", function(){

    change_icon();
    event.preventDefault();
    filter_data();

});

$('#training_id_search').on("input", function(){

  /*  if($("#training_id_search").val() !== "") {
        $("#training_id_icon").attr("class","bi bi-funnel-fill");
    }
    else {
        $("#training_id_icon").attr("class","bi bi-caret-down");
    }
    */
    change_icon();


  event.preventDefault();
  filter_data();

});


/*
$('#progressTable tbody').on('click', '.hover', function() {
  
    $(this).popover({  
        title:fetchData,  
        html:true,  
        placement:'left',
        sanitize:false      
        })
        $(this).popover("show");
    
});
*/
/*
var shift = '';
$('#progressTable tbody').on('mouseover', '.hover_reg', function() {

       
}); */

//try

$('#progressTable tbody').on('mouseover', '.hover_reg', function() {

   /* 
    setTimeout(() => {
        shift = "5";
        $(this).popover({  
        title:fetchData,  
        html:true,  
        placement:'left',
        sanitize:false      
        });
    $(this).popover("show");
    

    }, 1000);*/

    shift = "5";
        $(this).popover({  
        title:fetchData,  
        html:true,  
        placement:'left',
        sanitize:false      
        });
    $(this).popover("show");

    console.log(this);
}).on("mouseleave", ".hover_reg", function () {
    $(this).popover("hide");
});

//

$('#progressTable tbody').on('mouseover', '.hover_a', function() {
  
shift = "1";
$(this).popover({  
      title:fetchData,  
      html:true,  
      placement:'left',
      sanitize:false      
      })
      $(this).popover("show");

}).on("mouseleave", ".hover_a", function () {
    $(this).popover("hide");
});

$('#progressTable tbody').on('mouseover', '.hover_b', function() {
    
    shift = "2";
    $(this).popover({  
        title:fetchData,  
        html:true,  
        placement:'left',
        sanitize:false      
        })
    $(this).popover("show"); 

}).on("mouseleave", ".hover_b", function () {
    $(this).popover("hide");
});

$('#progressTable tbody').on('mouseover', '.hover_c', function() {
  
    shift = "3";
    $(this).popover({  
        title:fetchData,  
        html:true,  
        placement:'left',
        sanitize:false      
    })
    $(this).popover("show");

}).on("mouseleave", ".hover_c", function () {
    $(this).popover("hide");
});

$('#progressTable tbody').on('mouseover', '.hover_absent', function() {
  
  shift = "absent";
  $(this).popover({  
      title:fetchData,  
      html:true,  
      placement:'left',
      sanitize:false      
  })
  $(this).popover("show");

}).on("mouseleave", ".hover_absent", function () {
    $(this).popover("hide");
});

function fetchData(){  
    var fetch_data = '';  
                 
    var id = $(this).val();  
    $.ajax({  
        url:"fetch.php",  
        method:"POST",  
        async:false,  
        data:{id:id,shift:shift},  
        success:function(data){  
            fetch_data = data;
            }  
        });  
    return fetch_data; 
    }
  
});

//

function get_main_filter(class_name)
{
  var main_filter = [];
  $('.'+class_name+':checked').each(function(){
      main_filter.push($(this).val());
  });

  console.log(main_filter);
  return main_filter;

}

//close any fucking popover in the body
//solution to the bug that the popover immediately show after selecting a date

$('body').on('click', function () {
    $('.bs-popover-start').popover('hide');
}); 

/*
$('body').on('click', function (e) {
    if ($(e.target).data('bs-toggle') !== 'popover'
        && $(e.target).parents('.popover.in').length === 0) {
        $('[data-bs-toggle="popover"]').popover('hide');
    }
}); */

//Get training ID for the approval email

var approver_training_id = "";


$("#progressTable tbody").on("click", ".approver-mail-btn", function () {

    approver_training_id =  $(this).val();
    GID_approver_mail = $("#approver_GID").val();
    table_approver_mail();
}); 



//Approver Mail Table

var GID_approver_mail = "";
$("#approver_GID").on("change", function (){
    GID_approver_mail = $(this).val();
    console.log(GID_approver_mail);
    table_approver_mail();
});

function table_approver_mail () {
     
    $.ajax({
        url: "includes/approver_mail.inc.php",
            method: "POST",
            data: {GID_approver_mail:GID_approver_mail},
            success:function(data){
            $('#post_list_approver_mail').html(data);
            //console.log(data);
            }
    });
}

$("#send-approver-mail-btn").on("click", function () {

    $.ajax({
        url: "includes/send_approver_mail.inc.php",
            method: "POST",
            data: {GID_approver_mail:GID_approver_mail,approver_training_id:approver_training_id},
            success:function(data){
            $('#alert_card_window').html(data);
            //console.log(data);
            console.log(data);
            }
    
    });

})


</script>

</body>
</html>






