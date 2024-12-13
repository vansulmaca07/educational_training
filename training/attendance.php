<?php
session_start();

    include ('includes/dbh2.inc.php');

    date_default_timezone_set("Japan");


    if(isset($_GET["training_id"])) {
        $training_id = $_GET["training_id"];
    }

    else {
        $training_id = $_SESSION["document_number"];
    }
   


    

    $query_contents = "SELECT * from training_form
    where training_id = '$training_id'";
    
    $stmt_contents = $pdo->prepare($query_contents);
    $stmt_contents->execute();

    $result_contents = $stmt_contents->fetchAll();
    $usage_materials = '';
    $training_name = '';
  
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    


    <!--TEST-->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>

    <!--jQuery-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"/>

    <!-- Bootstrap 5 Font Icon CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!--Icon Scout-->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

    <!--Bootstrap/jQuery Select picker-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css"/>

    <!--<link rel="stylesheet" href="home_test.css">-->
    <link rel="stylesheet" href="attendance.css">

    <!--scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

    <!--popper-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
   


    <!--
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>




    <title>Document</title>

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

/***Sign Progress*****/

.sign-progress.bootstrap-select .dropdown-menu { 
    width: auto !important; 
    max-height: 300px;
   /* overflow-y:visible;
    overflow-y: scroll; */
}

.sign-progress.bootstrap-select .dropdown-toggle /*dropdown,*/
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

.none-sign-progress.bootstrap-select .dropdown-toggle::after {
  border: none;
  font: normal normal normal 14px/1;
  font-style: bold;
  font-family: "bootstrap-icons";
  content: "\F22C"; /* the desired FontAwesome icon */
  vertical-align: 0; /* to center vertically */
}

.selected-sign-progress.bootstrap-select .dropdown-toggle::after {
  border: none;
  font: normal normal normal 14px/1;
  font-style: bold;
  font-family: "bootstrap-icons";
  content: "\F3E0"; /* the desired FontAwesome icon */
  vertical-align: 0; /* to center vertically */
}


</style>
    </head>



<body>
    <div class="container my-5">
    
            <div class="all-header" style="position:relative;">
                <div style="height: 20px; width:255px; position:absolute;">
                    <div class="alert alert-primary pt-2 pb-2 mb-2" role="alert">
                        <span class = "align-middle" style="font-size:10px;"><b>テキスト文字が半角に設定されていることを確認します。</b></span>
                    </div>
                </div>
                <div class="main-header">
                    <h4  class="text-center">受講者</h4>
                </div>
            </div>
           
            <div class="row row-cols-auto" style="margin-top: 30px;">
                <div class="col" style="z-index:0;">
                    <div class="new-form-header" id="alert-window-header"  style="position:absolute; z-index:4;">
                            <?php 
                                if(isset($_GET["success"])) {
                                    echo "                               
                                            <div class='alert alert-success alert-dismissible fade show pt-2 pb-2' style='bottom: 45px;' role='alert'>
                                                $_GET[success]の出席完了!
                                                <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>
                                    ";     
                                }
                            ?> 
                    </div>

                    <!--Document No-->
                    <form action="includes/document_number.inc.php" method="post">
                    <div class="input-group mb-3">
                            <input type="text" class="form-control-plaintext docuNo" placeholder="Document No." aria-label="Recipient's username" aria-describedby="button-addon2"
                                value="<?php echo $training_id;  ?>" name ="document_number">
                            <button class="btn btn_search" type="submit" id="button-addon2" name="submit"><span class="bi-search text-white"></span></button>
                    </div>
                    </form>
                    
                  
                </div>            
                <div class="col" style="z-index:0;">
                
                <!--ALERTS-->
                <div class="new-form-header"  style="position:absolute; z-index:4;">
                    <?php 
                        if (isset($_GET["error"])) {
                                if ($_GET["error"] === "rfid_not_exist") {
                                echo "                               
                                <div class='alert alert-danger alert-dismissible fade show pt-2 pb-2' style='bottom: 45px;' role='alert'>
                                    RFIDが登録されていません!
                                    <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>      
                                ";                
                                }
                                if ($_GET["error"] === "user_not_in_list") {
                                    echo "                               
                                    <div class='alert alert-danger alert-dismissible fade show pt-2 pb-2' style='bottom: 45px;' role='alert'>
                                        ユーザーがリストにありません!
                                        <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>      
                                    ";                
                                }
                                if ($_GET["error"] === "bar_code_not_exist") {
                                    echo "                               
                                    <div class='alert alert-danger alert-dismissible fade show pt-2 pb-2' style='bottom: 45px;' role='alert'>
                                        バーコードが登録されていません!
                                        <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>      
                                    ";                
                                    }
                                if ($_GET["error"] === "duplicate_attendance") {
                                    echo "                               
                                    <div class='alert alert-danger alert-dismissible fade show pt-2 pb-2' style='bottom: 45px;' role='alert'>
                                        DUPLICATE ATTENDANCE!
                                        <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>      
                                    ";                
                                }

                        }
                       
                    ?> 
                </div>

                <!--ID TAP-->
                
                     <!--ID TAP-->
                     <form action="includes/attendance_tap.php" method="post" autocomplete="off" id="attendance-id-form" >
                        <div class="input-group mb-3">
                            <input type="text" class="form-control-plaintext docuNo autofocus-id" placeholder="Please TAP your ID" aria-label="Recipient's username" aria-describedby="button-addon2"
                            value="" name ="rfid" id="attendance_input">
                            <button class="btn btn2 rfid-submit-button" type="submit" id="button-addon2" name="submit"><i class="text-white bi bi-person-vcard"></i>
                            </button>
                        </div>
                    </form>    

                </div>

                <!--QR_Barcode-->
                <div class="col">
                    <form action="includes/bar_qr_scan.inc.php" method="post" id="bar-qr-form">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control-plaintext docuNo autofocus-barqr" placeholder="Please scan your QR/Bar code" aria-label="Recipient's username" aria-describedby="button-addon2"
                            value="" name ="bar_qr_input" autocomplete="off" id="bar_qr_input">
                            <button class="btn btn2" type="submit" id="button-addon2" name="submit"><i class="bi bi-qr-code-scan text-white"></i></button>
                        </div>
                    </form>
                </div>
                   <!--Reference Files-->
                <div class="col">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    教育訓練の内容と教材
                    </button>        
                </div>

                    <!--Check Training-->
                <div class="col">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control-plaintext docuNo" placeholder="Please enter your GID" aria-label="Recipient's username" aria-describedby="button-addon2"
                            value="<?php if(isset($_SESSION["GID_attendance"])) { echo $_SESSION["GID_attendance"];} ?>" name ="GID_check" autocomplete="off" id="GID_check">
                            <button class="btn btn2" type="button" data-bs-target="#training_list_modal" data-bs-toggle="modal" id="training_list_button" ><i class="text-white bi bi-person-exclamation"></i></button>
                    </div> 
                </div>
                
                <div class="col">
                    <a class="btn btn-danger" id="reset-filter-btn" style="float:right;">リセット&nbsp;&nbsp;<i class="fa-solid fa-filter-circle-xmark"></i></a>
                </div>
                <br>         
            </div>

            <!-- Modal For Reference Files -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">
                                 <?php 
                                    
                                    foreach($result_contents as $contents_training_name) {

                                            $training_name = $contents_training_name["training_name"]; 
                                        } 
                                    
                                    echo $training_name;

                                ?>
                                </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                            <div class="modal-body">
                                <table class="table-reference-files" style="width:100%; height:50px;">
                                    <thead>
                                        <th style="width:100%;">内容</th>
                                    </thead>
                                        <td style="width:100%; height:50px;">
                                    <?php
                                         foreach ($result_contents as $contents) {
                                    
                                            echo $contents["contents"];
                                            $usage_materials = $contents["usage_id"];                                                                                  
                                            }                                     
                                    ?>
                                        </td>                                          
                                </table>
                                <hr>          
                                <table class="table-reference-files" style="width:100%; height:50px;">
                                    <thead>
                                        <th style="width:100%;">研修教材</th>
                                    </thead>
                                        <td style="width:100%; height:50px;">

                                    <?php
                                        echo $usage_materials . '<br>'; 
                                    ?>
                                        </td>
                                                                    
                                </table>

                                <hr>

                                <table class="table-reference-materials">
                                    <thead>
                                        <tr>
                                            <th>使用資料</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                        
                                        <?php
                                        $query_materials = "SELECT * FROM file_storage 
                                            WHERE 
                                                training_id = :training_id
                                            AND 
                                                active_status = 1
                                        ";
                                        
                                        $stmt_materials = $pdo->prepare($query_materials);
                                        $stmt_materials->bindParam(":training_id", $training_id);
                                        $stmt_materials->execute();

                                        $result_materials = $stmt_materials->fetchAll();

                                       
                                        foreach ($result_materials as $materials) {

                                            $file_path = "includes/uploads/" . $materials['file_name'] . "." . $materials['file_ext'];
                                            echo "<tr>
                                                    <td>
                                                        $materials[file_name]
                                                    </td>
                                                    <td >
                                                        <a href='download.php?file_id=$materials[file_id]' class='btn btn-primary' download style ='vertical-align:middle;'><i style='vertical-align: middle;' class='bi bi-download'></i></a>
                                                        
                                                    </td>
                                                </tr>
                                            ";
                                        }
                                        ?>
                                </table>
                            </div>
                           
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <!--  <button type="button" class="btn btn-primary">Understood</button> -->
                        </div>
                    </div>
                </div>
            </div>
            
             <!-- Modal Training List-->
             <div class="modal fade" id="training_list_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                教育訓練記録リスト
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                            <div class="modal-body">
                                <table class="table table-bordered table-hover rounded-3 overflow-hidden main-T">
                                    <thead class="table text-center theadstyle" style="width: 100%; margin-bottom: 0;">
                                        <th class="w-25">No.</th>
                                        <th class="w-75">ファイル名前</th>
                                    </thead>
                                    <tbody class="text-center" id="post_training_list">

                                    </tbody>
                                    
                                </table>
                            </div>
                           
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--Attendance Table-->

            <div id="table-wrapper">
                <div id="table-scroll"> 
                    <table id="attendanceTable" border="1" class="table table-bordered table-hover rounded-3 main-T">
                        <thead class="table text-center theadstyle" style="width: 100%; margin-bottom: 0;">
                            <th style="width:15%">
                                <div class="shift-process-container p-0" style="width:100%;">
                                    <select data-selected-text-format="static" title="所属" class="process selectpicker form-control" data-size = "6" data-live-search = "true" style=""
                                        multiple id="input-process-select" data-actions-box="true" aria-label="size 3 select example">
                                    <?php
                                        $query = "SELECT DISTINCT(users.department_id), department_name FROM attendance
                                        INNER JOIN
                                            users ON attendance.GIDh = users.GID
                                        INNER JOIN
                                            department ON users.department_id = department.department_id    
                                        WHERE
                                            training_id = :training_id
                                                ";
                                        $stmt = $pdo->prepare($query);
                                        $stmt->bindParam(":training_id", $training_id);
                                        $stmt->execute();
                                        $result = $stmt->fetchAll();
                                        foreach($result as $row)
                                        {
                                            echo "<option name='checkbox_department[]' class='common_selector department' value=' $row[department_id]'>";
                                            echo "$row[department_name]</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </th>
                            <th style="width:15%">
                                <div class="shift-select-container p-0" style="width:100%;">
                                    <select data-selected-text-format="static" title="班" class="shift selectpicker form-control" data-size = "6" data-live-search = "true" style=""
                                        multiple id="input-shift-select" data-actions-box="true" aria-label="size 3 select example">
                                    <?php
                                        $query = 
                                        "SELECT DISTINCT(users.shift_id), shift_description FROM attendance
                                        INNER JOIN
                                            users ON users.GID = attendance.GIDh
                                        INNER JOIN
                                            shift ON shift.shift_id = users.shift_id
                                        WHERE
                                            training_id = :training_id
                                        ORDER BY
                                            shift_id ASC";
                                        $stmt = $pdo->prepare($query);
                                        $stmt->bindParam(":training_id", $training_id);
                                        $stmt->execute();
                                        $result = $stmt->fetchAll();
                                        foreach($result as $row)
                                        {
                                            echo "<option name='checkbox_shift[]' class='common_selector shift' value='$row[shift_id]'>";
                                            echo "$row[shift_description]</option>";
                                        }
                                    ?> 
                            </th>
                                <th style="width:15%" class="">
                                    <div class="dropdown p-0">
                                        <button class="btn btn-GID-search" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">GID<i class="bi bi-caret-down float-right" id="GID_search_icon" style="float: right;"></i></button>
                                        <ul class="dropdown-menu p-2" style="width: 300px;" aria-labelledby="dropdownMenuButton1">
                                            <li><input type="search" name="GID_search" id="GID_search" class="dropdown-item" 
                                                value = "" placeholder="GID入力">
                                            </li>
                                        </ul>
                                    </div>
                                </th>
                                <th style="width:20%">
                                    <div class="dropdown p-0">
                                        <button class="btn btn-name-search" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">名前<i class="bi bi-caret-down float-right" id="name_search_icon" style="float: right;"></i></button>
                                        <ul class="dropdown-menu p-2" style="width: 300px;" aria-labelledby="dropdownMenuButton1">
                                            <li><input type="search" name="name_search" id="name_search" class="dropdown-item" 
                                                value = "" placeholder="名前入力">
                                            </li>
                                        </ul>
                                    </div>
                                </th>
                                <th style="width:15%">
                                    <div class="id-sign-progress-status-select-container p-0" style="width:100%;">
                                        <select data-selected-text-format="static" title="サイン進捗" class="sign-progress selectpicker form-control" data-size = "6" data-live-search = "true" style=""
                                            multiple id="input-sign-progress-select" data-actions-box="true">
                                            <?php
                                                 $query = "SELECT DISTINCT(sign_progress), status_name FROM attendance
                                                 inner join status_ref on status_id = sign_progress
                                                     ;";
                                                 $stmt = $pdo->prepare($query);
                                                 $stmt->execute();
                                                 $result = $stmt->fetchAll();
                                                 foreach($result as $row)
                                                     {
                                                                echo "<option name='checkbox_sign_progress[]' class='common_selector sign_progress' value='$row[status_name]'";
                                                                echo ">$row[status_name]</option>";
                                                            }        
                                            ?>
                                        </select>
                                    </div>   
                                </th>
                                <th style="width:20%;align-items: center;  align-content: center;" class="">
                                    <div class="shift-process-container p-0" style="text-align: center;">完了日</div>
                                </th>                           
                        </thead>
                            <tbody id="post_list2">
                            </tbody>          
                    </table>
                    <div class="back-buttons" <?php if($_SESSION["userlevel"] !== "generaluser") { echo "style='display:none;'";}?> >
                        <a href="progress_test.php" class="btn btn-primary">ログインページ&nbsp;<i class="bi fs-6 bi-box-arrow-left"></i></a>
                    </div>

                    <div class="back-buttons" <?php if($_SESSION["userlevel"] === "generaluser") { echo "style= 'display: none;'";}?>>
                        <a href="progress_test.php" class="btn btn-primary">進捗ページ&nbsp;<i class="bi fs-6 bi-box-arrow-left"></i></a>
                        <a href="editform_test.php?training_id=<?php echo $training_id; ?>" class="btn btn-primary">編集ページ&nbsp;<i class="bi fs-6 bi-box-arrow-left"></i></a>
                    </div>
                </div>
            </div>  
    </div>

<!--Bootstrap 5 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>   --> 

<script type="text/javascript">  

//INTERLOCK FOR ID CARD. DISABLE KEYBOARD INPUT

let inputStart, inputStop;

$("#attendance_input")[0].onpaste = e => e.preventDefault();
// handle a key value being entered by either keyboard or scanner
var lastInput

let checkValidity = () => {
    if ($("#attendance_input").val().length < 10) {
        $("#attendance_input").val('')
    } 
    else {
    // $("body").append($('<div style="background:green;padding: 5px 12px;margin-bottom:10px;" id="msg">ok</div>'))
    }
    timeout = false
}

let timeout = false
$("#attendance_input").keypress(function (e) {
    if (performance.now() - lastInput > 1000) {
        $("#attendance_input").val('')
    }
    lastInput = performance.now();
    if (!timeout) {
        timeout = setTimeout(checkValidity, 200)
    }
});

/****Interlock for Bar and QR Scanner 


$("#bar_qr_input")[0].onpaste = e => e.preventDefault();
// handle a key value being entered by either keyboard or scanner
var lastInput2

let checkValidity2 = () => {
    if ($("#bar_qr_input").val().length < 10) {
      $("#bar_qr_input").val('')
  } else {
   // $("body").append($('<div style="background:green;padding: 5px 12px;margin-bottom:10px;" id="msg">ok</div>'))
  }
  timeout2 = false
}

let timeout2 = false
$("#bar_qr_input").keypress(function (e) {
  if (performance.now() - lastInput2 > 1000) {
    $("#bar_qr_input").val('')
  }
    lastInput2 = performance.now();
    if (!timeout2) {
    timeout2 = setTimeout(checkValidity2, 200)
  }
});  */



//FILTERS

$(document).ready(function() {

change_icon();

function change_icon () {

    if($('#input-shift-select :selected').length > 0) {
        $('.shift').removeClass("none-shift").addClass("selected-shift");
    }
    else {
        $('.shift').removeClass("selected-shift").addClass("none-shift"); 
    }
    if($('#input-process-select :selected').length > 0) {
        $('.process').removeClass("none-process").addClass("selected-process");
    }
    else {
        $('.process').removeClass("selected-process").addClass("none-process"); 
    }
    if($('#input-sign-progress-select :selected').length > 0) {
            $('.sign-progress').removeClass("none-sign-progress").addClass("selected-sign-progress");
        }
    else {
        $('.sign-progress').removeClass("selected-sign-progress").addClass("none-sign-progress"); 
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

    $('#input-sign-progress-select').change(function() {
        change_icon();
        filter_data();
    });


//TRY ASYNCHROUNOUS 

// Variable to hold request


// Bind to the submit event of our form
$("#attendance-id-form").on("submit", function(){

    // Prevent default posting of form - put here to work in case of errors
    event.preventDefault();
   
    // setup some local variables
    var $form = $(this);

    // Serialize the data in the form
    var serializedData = $form.serialize();

    // Let's disable the inputs for the duration of the Ajax request.
    // Note: we disable elements AFTER the form data has been serialized.
    // Disabled form elements will not be serialized.
   // $inputs.prop("disabled", true);

    // Fire off the request to /form.php
    $.ajax({
        url: "includes/attendance_tap.php",
        type: "POST",
        data: serializedData,
        success:function(data){
            $('#alert-window-header').html(data);
            $("#attendance_input").val("");
            filter_data();

            console.log("putangina mo panot");
        }
    });

});

//

$("#bar-qr-form").on("submit", function(){

// Prevent default posting of form - put here to work in case of errors
event.preventDefault();

// setup some local variables
var $form = $(this);

// Serialize the data in the form
var serializedData = $form.serialize();

// Let's disable the inputs for the duration of the Ajax request.
// Note: we disable elements AFTER the form data has been serialized.
// Disabled form elements will not be serialized.
// $inputs.prop("disabled", true);

// Fire off the request to /form.php
$.ajax({
    url: "includes/bar_qr_scan.inc.php",
    type: "POST",
    data: serializedData,
    success:function(data){
        $('#alert-window-header').html(data);
        $("#bar_qr_input").val("");
        filter_data();

        console.log("putangina mo panot");
    }
});

});

//Training List

$("#training_list_button").on("click", function() {
    training_list();
});

function training_list() {
    var GID_check = $("#GID_check").val();

    $.ajax({
        url: "includes/fetch_data_training_list.inc.php",
        method: "POST",
        data: {GID_check:GID_check},
        success:function(data){
            $('#post_training_list').html(data);
        }
    });
}

//Auto Focus

var autofocus;

auto_focus = "<?php if(isset($_SESSION["auto_focus"])) { echo $_SESSION["auto_focus"];  }
?>";

auto_focus_cursor();

function auto_focus_cursor() {
    if(auto_focus === "1") {
        $('#attendance_input').focus();
        console.log("success on attendance input");
    }
    else if (auto_focus === "2") {
        
        $('#bar_qr_input').focus();
        console.log("success on bar and qr input");
    }
}

//FILTERS

filter_data();

function filter_data() {

    $('#post_list2').html();
    var action = 'fetch_data';
    var sign_progress = get_filter('sign_progress');
    var shift = get_filter('shift');
    var department =get_filter('department');
    var GID_search = $("#GID_search").val();
    var name_search = $("#name_search").val();

    $.ajax({
        url: "includes/fetch_data_attendance.inc.php",
        method: "POST",
        data: {action:action, sign_progress:sign_progress, shift:shift, department:department, GID_search:GID_search, name_search:name_search},
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

    if($('input[name="checkbox_shift[]"]:checked').length > 0) {
        $("#shift_icon").attr("class", "bi bi-funnel-fill");
    }
    else {
        $("#shift_icon").attr("class", "bi bi-caret-down");
    }

    if($('input[name="checkbox_department[]"]:checked').length > 0) {
        $("#department_icon").attr("class", "bi bi-funnel-fill");
    }
    else {
        $("#department_icon").attr("class", "bi bi-caret-down");
    }

    if($('input[name="checkbox_sign_progress[]"]:checked').length > 0) {
        $("#sign_progress_icon").attr("class", "bi bi-funnel-fill");
    }
    else {
        $("#sign_progress_icon").attr("class", "bi bi-caret-down");
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

    //CLEAR FILTERS

    $("#reset-filter-btn").on("click", function() {
        //$("input[name='checkbox_shift[]']").prop('checked', false);
        //$("#shift_icon").attr("class", "bi bi-caret-down");
        $("#input-shift-select").val("").trigger("change");
        $("#input-shift-select").selectpicker("val","");
        $("#input-process-select").val("").trigger("change");
        $("#input-process-select").selectpicker("val","");
        $("#input-sign-progress-select").val("").trigger("change");
        $("#input-sign-progress-select").selectpicker("val","");
        
        
        $("#GID_search").val("");
        $("#GID_search_icon").attr("class", "bi bi-caret-down");
        $("input[name='checkbox_department[]']").prop('checked', false);
        $("#department_icon").attr("class", "bi bi-caret-down");
        $("input[name='checkbox_sign_progress[]']").prop('checked', false);
        $("#sign_progress_icon").attr("class", "bi bi-caret-down");
        $("#name_search").val("");
        $("#name_search_icon").attr("class", "bi bi-caret-down");

        filter_data();
    });

});



</script>
</body>
</html>
