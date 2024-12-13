<?php

session_start();

//returns to login page if accessed without logging in

if(!isset($_SESSION["GID"])) {
    header("Location: loginpage.php");
}

//includes mysql database using PDO
include('includes/dbh2.inc.php');

$training_id = '';
if(isset($_GET["training_id"])) {
    $training_id = $_GET["training_id"];
}
else if(!isset($_GET["training_id"])) {
    $training_id = $_SESSION["training_id"];
}

$query = "SELECT date_id, affiliation, GIDh, name_, judgement_name, attendance, department_name, sign_progress FROM attendance
INNER JOIN 
    judgement ON attendance.judgement = judgement.id
INNER JOIN 
    department ON department.department_id = attendance.affiliation
WHERE 
    training_id = :training_id
ORDER BY
    department.department_id DESC
LIMIT 35

    
;";

$stmt = $pdo->prepare($query);
$stmt->bindParam(":training_id", $training_id);
$stmt->execute();

$result = $stmt->fetchAll();
$total_row = $stmt->rowCount();

$query_02 = "SELECT date_id, affiliation, GIDh, name_, judgement_name, attendance, department_name, sign_progress  FROM attendance
INNER JOIN 
    judgement ON attendance.judgement = judgement.id
INNER JOIN 
    department ON department.department_id = attendance.affiliation
where 
    training_id = :training_id 
ORDER BY
    department_id DESC
limit 35, 35

";

$stmt_02 = $pdo->prepare($query_02);
$stmt_02->bindParam(":training_id", $training_id);
$stmt_02->execute();

$result_02 = $stmt_02->fetchAll();

$total_row_02 = $stmt_02->rowCount(); 

$query_03 = "SELECT date_id, affiliation, GIDh, name_, judgement_name, attendance, department_name, sign_progress  FROM attendance
INNER JOIN 
    judgement ON attendance.judgement = judgement.id
INNER JOIN 
    department ON department.department_id = attendance.affiliation
WHERE 
    training_id = :training_id
ORDER BY
    department_id DESC
limit 70, 35
";

$stmt_03 = $pdo->prepare($query_03);
$stmt_03->bindParam(":training_id", $training_id);
$stmt_03->execute();
$total_row_03 = $stmt_03->rowCount(); 

$result_03 = $stmt_03->fetchAll();

$query_04 = "SELECT date_id, affiliation, GIDh, name_, judgement_name, attendance, department_name, sign_progress  FROM attendance
INNER JOIN 
    judgement ON attendance.judgement = judgement.id
INNER JOIN 
    department ON department.department_id = attendance.affiliation
WHERE  
    training_id = :training_id 
ORDER BY
    department_id DESC
limit 105, 35

";

$stmt_04 = $pdo->prepare($query_04);
$stmt_04->bindParam(":training_id", $training_id);
$stmt_04->execute();
$total_row_04 = $stmt_04->rowCount(); 
$result_04 = $stmt_04->fetchAll();

$query_05 = "SELECT date_id, affiliation, GIDh, name_, judgement_name, attendance, department_name, sign_progress  FROM attendance
INNER JOIN 
    judgement ON attendance.judgement = judgement.id
INNER JOIN 
    department ON department.department_id = attendance.affiliation
WHERE 
    training_id = :training_id 
ORDER BY
    department_id DESC
limit 140, 35

";

$stmt_05 = $pdo->prepare($query_05);
$stmt_05->bindParam(":training_id", $training_id);
$stmt_05->execute();
$total_row_05 = $stmt_05->rowCount(); 
$result_05 = $stmt_05->fetchAll();

$query_06 = "SELECT date_id, affiliation, GIDh, name_, judgement_name, attendance, department_name, sign_progress  FROM attendance
INNER JOIN 
    judgement ON attendance.judgement = judgement.id
INNER JOIN 
    department ON department.department_id = attendance.affiliation
WHERE 
    training_id = :training_id 
ORDER BY
    department_id DESC
limit 175, 35

";

$stmt_06 = $pdo->prepare($query_06);
$stmt_06->bindParam(":training_id", $training_id);
$stmt_06->execute();
$total_row_06 = $stmt_06->rowCount(); 

$result_06 = $stmt_06->fetchAll();

$query_07 = "SELECT approval, approval_date, modified_date, status_id, creator, training_name, area, start_time_regular, end_time_regular, location_regular, instructor_regular,
        category_quality, category_environment, category_safety_and_hygiene, category_others, category_others_manual, purpose, count_, audience, contents, usage_id, confirmation_by,
        confirmation_date, checker_people_regular, checker_comment_regular, name_, checker_date_regular, approved_by, location_a, location_b, location_c, location_d, instructor_a, instructor_b,
        instructor_c, instructor_d, start_time_a, start_time_b, start_time_c, start_time_d, end_time_a, end_time_b, end_time_c, end_time_d, checker_comment_a, checker_comment_b,
        checker_comment_c, checker_comment_d, checker_date_a, checker_date_b, checker_date_c, checker_date_d, date_created, pdf_approver, pdf_creator, judgement, creator_stamp_color, approver_stamp_color
    FROM training_form

    INNER JOIN 
        users ON users.GID = training_form.creator
    WHERE 
        training_id = :training_id";

$stmt_07 = $pdo->prepare($query_07);
$stmt_07->bindParam(":training_id", $training_id);
$stmt_07->execute();

$result_07 = $stmt_07->fetchAll();

$approval ='';
$approval_date = '';
$approved_by = '';
$modified_date= '';
$status_id = '';
$creator = '';

$judgement;


foreach ($result_07 as $result_approval) {
    $creator = $result_approval["creator"];
    $approval = $result_approval["approval"];
    $approval_date = $result_approval["approval_date"];
    $modified_date = $result_approval["modified_date"];
    $status_id = $result_approval["status_id"];
    $training_creator = $result_approval["name_"];
    $training_name = $result_approval["training_name"];
    $area = $result_approval["area"];
    $start_time_regular = $result_approval["start_time_regular"];
    $end_time_regular = $result_approval["end_time_regular"];
    $location_regular = $result_approval["location_regular"];
    $instructor_regular = $result_approval["instructor_regular"];
    $start_time_a = $result_approval["start_time_a"];
    $end_time_a = $result_approval["end_time_a"];
    $location_a = $result_approval["location_a"];
    $instructor_a = $result_approval["instructor_a"];
    $start_time_b = $result_approval["start_time_b"];
    $end_time_b = $result_approval["end_time_b"];
    $location_b = $result_approval["location_b"];
    $instructor_b = $result_approval["instructor_b"];
    $start_time_c = $result_approval["start_time_c"];
    $end_time_c = $result_approval["end_time_c"];
    $location_c = $result_approval["location_c"];
    $instructor_c = $result_approval["instructor_c"];
    $start_time_d = $result_approval["start_time_d"];
    $end_time_d = $result_approval["end_time_d"];
    $location_d = $result_approval["location_d"];
    $instructor_d = $result_approval["instructor_d"];
    $category_quality = $result_approval["category_quality"];
    $category_environment = $result_approval["category_environment"];
    $category_safety_and_hygiene = $result_approval["category_safety_and_hygiene"];
    $category_others = $result_approval["category_others"];
    $category_others_manual = $result_approval["category_others_manual"];
    $purpose = $result_approval["purpose"];
    $count_ = $result_approval["count_"];
    $audience = $result_approval["audience"];
    $contents = $result_approval["contents"];
    $usage_id = $result_approval["usage_id"];
    $usage_id = preg_replace('#\s+#',', ',trim($usage_id));
    $confirmation_by = $result_approval["confirmation_by"];
    $confirmation_date = $result_approval["confirmation_date"];
    $checker_people_regular = $result_approval["checker_people_regular"];
    $checker_comment_regular = $result_approval["checker_comment_regular"];
    $checker_comment_a = $result_approval["checker_comment_a"];
    $checker_comment_b = $result_approval["checker_comment_b"];
    $checker_comment_c = $result_approval["checker_comment_c"];
    $checker_comment_d = $result_approval["checker_comment_d"];
    $checker_date_regular = $result_approval["checker_date_regular"];
    $checker_date_a = $result_approval["checker_date_a"];
    $checker_date_b = $result_approval["checker_date_b"];
    $checker_date_c = $result_approval["checker_date_c"];
    $checker_date_d = $result_approval["checker_date_d"];
    $approved_by = $result_approval["pdf_approver"];
    $date_created = $result_approval["date_created"];
    $pdf_creator = $result_approval["pdf_creator"];
    $judgement = $result_approval["judgement"];
    $creator_stamp_color = $result_approval["creator_stamp_color"];
    $approver_stamp_color = $result_approval["approver_stamp_color"];
}


$query_08 = "SELECT category.category_id, category_name FROM category
    
INNER JOIN 
    category_ref ON category_ref.category_id = category.category_id
WHERE 
    training_id = :training_id";

$stmt_08 = $pdo->prepare($query_08);
$stmt_08->bindParam(":training_id", $training_id);
$stmt_08->execute();

$result_cat = $stmt_08->fetchAll();

$category = array ();

foreach ($result_cat as $categories) {
    $category[] = $categories["category_id"];
}

$query_09 = "SELECT * FROM attendance
        INNER JOIN 
            users ON users.GID = attendance.GIDh
        WHERE 
            users.shift_id = '5'
        AND
            training_id = :training_id
        AND 
            interviewee = 2
        LIMIT 3";

$stmt_09 = $pdo->prepare($query_09);
$stmt_09->bindParam(":training_id", $training_id);
$stmt_09->execute();

$result_09 = $stmt_09->fetchAll();

$interviewees_regular = '';

foreach($result_09 as $result_regular_interviewees) {
    $interviewees_regular .= $result_regular_interviewees["name_"] . ",";
}

$query_10 = "SELECT * FROM attendance
     INNER JOIN users ON users.GID = attendance.GIDh
        WHERE 
            users.shift_id = '1'
        AND
            training_id = :training_id
        AND interviewee = 2
        LIMIT 3";

$stmt_10 = $pdo->prepare($query_10);
$stmt_10->bindParam(":training_id", $training_id);
$stmt_10->execute();

$result_10 = $stmt_10->fetchAll();

$interviewees_a = '';

foreach($result_10 as $result_a_interviewees) {
    $interviewees_a .= $result_a_interviewees["name_"] . ",";
}

$query_11 = "SELECT * FROM attendance
        INNER JOIN 
            users ON users.GID = attendance.GIDh
        WHERE 
            users.shift_id = '2'
        AND
            training_id = :training_id
        AND 
            interviewee = 2
        LIMIT 3";

$stmt_11 = $pdo->prepare($query_11);
$stmt_11->bindParam(":training_id", $training_id);
$stmt_11->execute();

$result_11 = $stmt_11->fetchAll();

$interviewees_b = '';

foreach($result_11 as $result_b_interviewees) {
    $interviewees_b .= $result_b_interviewees["name_"] . ",";
}

$query_12 = "SELECT * FROM attendance
        INNER JOIN 
            users ON users.GID = attendance.GIDh
        WHERE 
            users.shift_id = '3'
        AND
            training_id = :training_id
        AND 
            interviewee = 2
        LIMIT 3";

$stmt_12 = $pdo->prepare($query_12);
$stmt_12->bindParam(":training_id", $training_id);
$stmt_12->execute();

$result_12 = $stmt_12->fetchAll();

$interviewees_c = '';

foreach($result_12 as $result_c_interviewees) {
    $interviewees_c .= $result_c_interviewees["name_"] . ",";
}

$query_13 = "SELECT * FROM attendance
     INNER JOIN users ON users.GID = attendance.GIDh
        WHERE 
            users.shift_id = '4'
        AND
            training_id = :training_id
        AND interviewee = 2
        LIMIT 3";

$stmt_13 = $pdo->prepare($query_13);
$stmt_13->bindParam(":training_id", $training_id);
$stmt_13->execute();

$result_13 = $stmt_13->fetchAll();

$interviewees_d = '';

foreach($result_13 as $result_d_interviewees) {
    $interviewees_d .= $result_d_interviewees["name_"] . ",";
}

$query_files = "SELECT file_name, file_ext FROM file_storage
    WHERE
        training_id = :training_id
    AND
        active_status = 1
    ";

$stmt_14 = $pdo->prepare($query_files);
$stmt_14->bindParam(":training_id",$training_id);
$stmt_14->execute();

$result_14 = $stmt_14->fetchAll();

$related_materials = '';
foreach($result_14 as $file_name) {
    $related_materials = $related_materials . " " . $file_name["file_name"] . "." .$file_name["file_ext"] . ",";
}

$related_materials = rtrim($related_materials, ",");

$query_group_creator = "SELECT group_id FROM users
    WHERE
        GID = :GID
    ";

$stmt_group_creator = $pdo->prepare($query_group_creator);
$stmt_group_creator->bindParam(":GID", $creator); 
$stmt_group_creator->execute();

$result_group_creator = $stmt_group_creator->fetchAll();

$group_creator = "";

foreach($result_group_creator as $row) {
    $group_creator = $row["group_id"];
}

//Count Total Participants

$query_total_participants = 
    "SELECT * FROM attendance
        WHERE
            training_id = :training_id
        AND
            attendance = '1'
    ";

$stmt_total_participants = $pdo->prepare($query_total_participants);
$stmt_total_participants->bindParam(":training_id", $training_id);
$stmt_total_participants->execute();

$count_ = $stmt_total_participants->rowCount();

//Disables stamp color change 

$disabled = "";
switch($_SESSION["userlevel"]) {
    case($_SESSION["userlevel"] === "4"): 
        //continue
        break;
    
    case($group_creator !== $_SESSION["group_id"]):
        $disabled = "style='display:none'";
        break;
    case($group_creator === $_SESSION["group_id"]):
        //continue
        break;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="pdf_preview.css" class="href"> 
 
    <!-- Bootstrap 5 Font Icon CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> 

    <!--jQuery-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"/>

    <!--Icon Scout-->
  

    <!--Bootstrap/jQuery Select picker-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css"/>

    
    <!--scripts -->
    <!--<script src="https://code.jquery.com/jquery-3.7.1.js"></script>-->
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

</head>
<body>
<div class="container" style="width:100%">
    <div class="column" style="float:left; width:20%;">
        <div class="digital-stamp" <?php echo $disabled; ?> style="width:100%;">
            <div class="digital-stamp-creator" style="width: 100%; align-items: center; align-content: center; " >
                <span style="font-size:large"><b>作成 氏名:</b>&nbsp;</span>
                <br>        
                <form action='includes/approval.inc.php' method='POST'>
                <div class="creator-header" style=" display: inline-block; margin-top:10px;">                       
                    <input <?php if($creator_stamp_color === "1") { echo "checked"; } ?> type="radio" style="width:10%; margin: 0px !important;" id="btn-creator-black" class="btn-creator-black" name="creator_stamp_color" value="1">
                    <label for="btn-creator-black" style="margin-left:0 !important; font-size:large;">黒い</label>
                    <input <?php if($creator_stamp_color === "2") { echo "checked"; } ?> type="radio" style="width:10%;" id="btn-creator-red" class="btn-creator-red" name="creator_stamp_color" value="2">
                    <label style="color:red; font-size:large;" for="btn-creator-red">赤い</label>
                    <input type="text" value="<?php if($pdf_creator !== null) { echo $pdf_creator;} else { echo $training_creator; } ?>"
                        id="input-creator" style="font-size:medium" class="input-creator input-left" name="pdf_creator" onkeyup="input_data();">
                </div>
            </div>
            <div class="digital-stamp-approver" style="margin-top: 10px; width: 100%; align-items: center; align-content: center; ">
                <span style="font-size:large"><b>確認 氏名:</b></span>
                <br>
                <div class="creator-header" style="display: inline-block; margin-top:10px;">               
                    <input <?php if($approver_stamp_color === "1") { echo "checked"; } ?> type="radio" style="width:10%; margin: 0px !important;" id="btn-approver-black" class="btn-creator-black" name="approver_stamp_color" value="1">
                    <label for="btn-approver-black" style="margin-left:0 !important; font-size:large;">黒い</label>
                    <input <?php if($approver_stamp_color === "2") { echo "checked"; } ?> type="radio" style="width:10%;" id="btn-approver-red" class="btn-creator-red" name="approver_stamp_color" value="2">
                    <label style="color:red; font-size:large;" for="btn-approver-red">赤い</label>
                    <input type='text' name='pdf_approver' value="<?php  if($approved_by !== null)  { echo $approved_by;} else { echo $_SESSION["name_"];} ?>" 
                    id='input-approver' style="font-size:medium" class="input-creator input-left" >
                </div>    
            </div>
            <div class="approver-stamp">
            <?php
                if ($approval === '1' && $status_id === '4') {
                    
                    echo"<input type='text' hidden name='training_id_approve' value='$training_id'  id='training_id_approve'>
                        <button type='submit' name='submit' class='btn-approve input-left'";
                    switch($_SESSION["userlevel"]) {
                        case($_SESSION["userlevel"] === "4"):
                            //continue
                            break;
                        case($group_creator !== $_SESSION["group_id"]):
                            echo "style='display:none'";
                            break;
                        case($group_creator === $_SESSION["group_id"]):
                            //continue
                            break;
                    }
                    echo "><span>確認</span></button>";
                    echo "<hr>";
                }
                else if ($approval === '2') {
                    echo "<br><span";
                    echo $disabled;
                    echo ">APPROVED DATE:</span><br>";
                    echo "<input ";
                    echo $disabled;
                    echo"type='datetime-local' name='approval_date_edit' id='approval_date_edit' value ='$approval_date'><br><br>";
                    echo "<span>LAST MODIFIED DATE:</span><br>";
                    echo "<span>$modified_date</span>";
                    echo "<hr>";
                }
            ?>
            </div>
            <hr>
            <div class="edit-stamp" style=""> 
                <span><b>押印修正がある場合、</b></span><br>
                <span><b>下記保存ボタンをクリックしてください。</b></span>          
                <button class="btn-pdf" id="edit_stamp_btn"><span>スタンプ保存&nbsp;&nbsp;&nbsp;<i class="bi bi-arrow-clockwise"></i></span></button>
            </div>
            </form>
        </div>
        <div class="pdf-download" style="padding: 5%;">
            <span><b>PDF ファイル:</b></span>
            <button id="download" class="btn-pdf"><span>PDFダウンロード&nbsp;&nbsp;&nbsp;<i class="bi bi-file-earmark-arrow-down"></i></span></button>
        </div>
    </div>
    <div class="column" style="float:right; width:80%;">
        <div class="book" id="test">
            <div class="page" id="page">
                <div class="subpage" id="subpage">
                    <div class="header-container">
                        <div class="header-1" style="width:100%;">
                            <div class="main_title">
                                <h3><b>教育・訓練記録（製造）</b></h3>
                            </div>
                            <div class="creation_department" id="creation_department">
                                <h3><b>作成部署:<?php echo $_SESSION["department_name"];?> </b></h3>
                            </div>
                        </div>
                        <div class="header-2" style="width:27%; text-align:center;">
                            <span style=""><b>NO.<?php echo $training_id;?></b></span>
                            <table style="width:100%; margin-top:5px;">
                                <tr>
                                    <td style="width:50%; text-align:center;">
                                        <span>確　認</span>
                                    </td>
                                    <td style="width:50%; text-align:center;">
                                        <span>作　成</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height:75px;">
                                    <div class="parent"
                                    <?php
                                        if($approval === '1') {
                                            echo "style='display: none;'";
                                        }
                                        else if ($approval === '2') {
                                            echo "style='display:flex;'";
                                        }
                                    ?>                               
                                    id="approver_div">
                                            <div class="child">
                                                <span-a id="deployment_approver">製造部</span-a>
                                                <span-a id="date_approved"></span-a>
                                                <span-a id="approver_stamp"></span-a>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="height:75px;  align-items: center; justify-content: center;">
                                        <div class="parent-creator" style = "display:flex;">
                                            <div class="child-creator">
                                                <span-a-creator id="deployment_creator">製造部</span-a-creator>
                                                <span-a-creator id="date_created"></span-a-creator>
                                                <span-a-creator id="creator_stamp"></span-a-creator>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="main_record" style="margin-top:5px;">
                        <table id="main_record" class="main_record" style="width:100%; margin-top: 10px;">
                            <tr>
                                <td style="width:70%;">
                                    <span>名称：<?php echo $training_name;?></span>
                                </td>
                                <td style="width:15%; text-align:center;"> 
                                    <input type="checkbox" 
                                    <?php if ($area ==='1'){
                                        echo "checked";
                                    }
                                    
                                    ?>
                                    
                                    ><span>社内</span>
                                </td>
                                <td style="width:15%; text-align:center;">
                                <input type="checkbox"
                                    <?php if ($area ==='2'){
                                        echo "checked";
                                    }
                                    
                                    ?>
                                    
                                    >
                                    <span>社外</span>
                                </td>
                            </tr>
                        </table>

                        <table id="main_information" class="main_information" style="width:100%; border-top:0;">
                            <tr <?php if($instructor_regular === "") { echo "class='strikediag_xs'";}?>>
                                <td style="width:17%;">
                                    <span>日勤者実施日時：</span>
                                </td>
                                <td style="width:20%; text-align:center;"> 
                                    <span style="font-size:12px;">
                                        <?php 
                                            if(isset($start_time_regular)) {
                                                echo $start_time_regular; }
                                        ?>
                                    </span>
                                </td>
                                <td style="width:20%; text-align:center;">
                                    <span style="font-size:12px;">
                                        <?php 
                                            if(isset($end_time_regular)) {
                                                echo $end_time_regular; }
                                        ?>
                                    </span>
                                </td>
                                <td style="width:20%;">
                                    <span style="">場所：</span>
                                    <span style="font-size:10px;">
                                        <?php 
                                            if($location_regular !== "") {
                                                echo $location_regular; }
                                        ?>
                                    </span>
                                </td>
                                <td style="width:20%;">
                                    <span style="">講師：</span>
                                    <span style="font-size:12px;">
                                        <?php 
                                            if($instructor_regular !== "") {
                                                echo $instructor_regular; }
                                        ?>
                                    </span>
                                </td>
                            </tr>
                            <tr <?php if($instructor_a === "") { echo "class='strikediag_xs'";}?>>
                                <td style="width:17%;">
                                    <span>Ａ班実施日時： </span>
                                </td>
                                <td style="width:20%; text-align:center;"> 
                                    <span style="font-size:12px;"> 
                                        <?php 
                                            if(isset($start_time_a)) {
                                                echo $start_time_a; }
                                        ?>           
                                    </span>
                                </td>
                                <td style="width:20%; text-align:center;">
                                    <span style="font-size:12px;">
                                        <?php 
                                            if(isset($end_time_a)) {
                                                echo $end_time_a; }
                                        ?>      
                                    </span>
                                </td>
                                <td style="width:20%;">
                                    <span>場所：</span><span style="font-size:10px;">
                                         <?php 
                                            if($location_a !== "") {
                                                echo $location_a; }
                                        ?>     
                                    </span>
                                </td>
                                <td style="width:20%;">
                                    <span>講師：</span><span style="font-size:12px;">
                                    <?php 
                                            if($instructor_a !== "") {
                                                echo $instructor_a; }
                                        ?>
                                    </span>
                                </td>
                            </tr>
                            <tr <?php if($instructor_b === "") { echo "class='strikediag_xs'";}?>>
                                <td style="width:17%;">
                                    <span>Ｂ班実施日時：   </span>
                                </td>
                                <td style="width:20%; text-align:center;"> 
                                    <span style="font-size:12px;">
                                        <?php 
                                            if(isset($start_time_b)) {
                                                echo $start_time_b; }
                                        ?>
                                    </span>
                                </td>
                                <td style="width:20%; text-align:center;">
                                    <span style="font-size:12px;">
                                        <?php 
                                            if(isset($end_time_b)) {
                                                echo $end_time_b; }
                                        ?>
                                    </span>
                                </td>
                                <td style="width:20%;">
                                    <span>場所：</span><span style="font-size:10px;">
                                        <?php 
                                            if($location_b !== "") {
                                                echo $location_b; }
                                      
                                        ?>
                                    </span>
                                </td>
                                <td style="width:20%;">
                                    <span>講師：</span><span style="font-size:12px;">
                                        <?php 
                                            if($instructor_b !== "") {
                                                echo $instructor_b; }
                                          
                                        ?>
                                    </span>
                                </td>
                            </tr>
                            <tr <?php if($instructor_c === "") { echo "class='strikediag_xs'";}?>>
                                <td style="width:17%;">
                                    <span style="font-size:12px;">Ｃ班実施日時：</span>
                                </td>
                                <td style="width:20%; text-align:center;"> 
                                    <span style="font-size:12px;">
                                        <?php 
                                            if(isset($start_time_c)) {
                                                echo $start_time_c; }
                                          
                                        ?>
                                    </span>
                                </td>
                                <td style="width:20%; text-align:center;">
                                    <span style="font-size:12px;">
                                        <?php 
                                            if(isset($end_time_c)) {
                                                echo $end_time_c; }
                                          
                                        ?>
                                    </span>
                                </td>
                                <td style="width:20%;">
                                    <span>場所：</span><span style="font-size:10px;">
                                        <?php 
                                            if($location_c !== "") {
                                                echo $location_c; }
                                         
                                        ?>
                                    </span>
                                </td>
                                <td style="width:20%;">
                                    <span>講師：</span><span style="font-size:12px;">
                                    <?php 
                                            if($instructor_c !== "") {
                                                echo $instructor_c; }
                                      
                                        ?>
                                    </span>
                                </td>
                            </tr>
                            <tr <?php if($instructor_d === "") { echo "class='strikediag_xs'";}?>>
                                <td style="width:17%;">
                                    <span>Ｄ班実施日時：</span>
                                </td>
                                <td style="width:20%; text-align:center;"> 
                                    <span style="font-size:12px;">
                                        <?php 
                                            if(isset($start_time_d)) {
                                                echo $start_time_d; }
                                         
                                        ?>
                                    </span>
                                </td>
                                <td style="width:20%; text-align:center;">
                                    <span style="font-size:12px;">
                                        <?php 
                                            if(isset($end_time_d)) {
                                                echo $end_time_d; }
                                         
                                        ?>
                                    </span>
                                </td>
                                <td style="width:20%;">
                                    <span>場所：</span>
                                    <span style="font-size:10px;" >
                                        <?php 
                                            if($location_d !== "") {
                                                echo $location_d; }
                                   
                                        ?>
                                    </span>
                                </td>
                                <td style="width:20%;">
                                    <span>講師：</span>
                                    <span style="font-size:12px;">
                                        <?php 
                                            if($instructor_d !== "") {
                                                echo $instructor_d; }
                                            
                                        ?>
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="category" style="margin-top:10px;">
                        <caption>区分</caption>
                        <table id="category_table" class="category_table" style="width:100%">
                            <tr>
                                <td style="width:25%; text-align:center;">
                                <input type="checkbox"
                                <?php if(in_array(1,$category)) {echo 'checked';}?>

                                    >
                                    <span>品質</span>
                                </td>
                                <td style="width:25%; text-align:center;">
                                <input type="checkbox"
                                <?php if(in_array(2,$category)) {echo 'checked';}?>
                                    
                                    >
                                    <span>環境</span>                                   
                                </td>
                                <td style="width:25%; text-align:center;">
                                <input type="checkbox"
                                <?php if(in_array(3,$category)) {echo 'checked';}?>
                                    
                                    >
                                <span>安全衛生</span>                               
                                </td>
                                <td style="width:25%; text-align:center;">
                                <input type="checkbox"
                                <?php if(in_array(4,$category)) {echo 'checked';}?>
                                    
                                    >
                                    <span>その他:
                                    <?php if ($category_others ==='1'){
                                        echo $category_others_manual;
                                    }
                                    
                                    ?>
                                    </span>                               
                                </td>
                            </tr>
                        </table>
                        ※安全衛生に関係する教育の場合、原本を総務部門に提出し、作成部署はコピーを保管する。
                    </div>
                    <div class="purpose"  style="margin-top:10px;">
                        <caption>目的、対象者</caption>
                        <table id="purpose_table" class="purpose_table" style="width:100%; overflow: hidden;">
                            <tr>
                                <td colspan="2" style="width:100%;">
                                    <span>目的：<?php echo $purpose; ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:25%;">
                                    <span>対象者：<?php echo $audience; ?></span>
                                </td>
                                <td style="width:25%;">
                                    <span>名：<?php echo $count_; ?></span>                                   
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="contents"  style="margin-top:10px;">
                        <caption>内容</caption>
                        <table id="contents_table" class="contents_table" style="width:100%;">
                            <tr>
                                <td style="width:100%;">
                                    <div style=" height: 51px; overflow: hidden; word-break: break-all;">
                                        <span><?php 
                                             echo $contents; 
                                             ?>
                                        </span>     
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>


                    <div class="usage_materials"  style="margin-top:5px;">
                        <table id="usage_material_table" class="usage_material_table" style="width:100%;">
                            <tr>
                                <td style="width:100%;">
                                    <span>使用資料　（作業標準がある場合には、作業標準№を記入、ない場合には資料名等を記入）</span>
                                </td> 
                            </tr>
                            <tr style="overflow: hidden;">
                                <td style="width:100%;">
                                    <div style=" height: 51px; overflow: hidden; word-break: break-all;">
                                        <span><?php 
                                        
                                            if(($related_materials !== '') AND ($usage_id !== '')) {
                                                $related_materials = $related_materials . ", ";
                                            }
                                            
                                            $materials_combined = $related_materials . $usage_id;
                                            // $materials_combined = rtrim($materials_combined,",");

                                            echo $materials_combined ?>

                                        </span>
                                    </div>
                                    
                                </td>
                            </tr>
                        </table>
                    </div>


                    <div class="methods_schedule"  style="margin-top:10px;">
                        <caption>教育効果の確認方法、確認予定日</caption>
                        <table id="methods_schedule_table" class="methods_schedule_table" style="width:100%">
                            <tr>
                                <td style="width:100%;">
                                    <div style="height: 17px; overflow: hidden;">
                                        <span><?php echo $confirmation_by; ?></span>
                                    </div>
                                </td> 
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <span>最終確認予定日：<?php echo $confirmation_date; ?></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="confirmation" style="width:100%; margin-top:10px;">
                        <div class="column-1" style="width:80%">
                            <caption>教育効果の確認結果</caption>
                            <table class="result_confirmation_regular
                            <?php
                                if($interviewees_regular === "") {
                                    echo "strikediag_s";
                                } 
                            ?>
                            " id="result_confirmation_regular" style="width:100%; margin-top:30px;">
                                <tr>
                                    <td>
                                        <span>日勤者：
                                            <?php 
                                                if($interviewees_regular !== "") {
                                                    echo $interviewees_regular; 
                                                }
                                                else {
                                                
                                                }
                                            ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height:20px;"><span><?php echo $checker_comment_regular; ?></span></td>
                                </tr>
                            </table>
                            <table class="result_confirmation_regular
                            <?php
                                if($interviewees_a === "") {
                                    echo "strikediag_s";
                                } 
                            ?>
                            " id="result_confirmation_regular" style="width:100%;  margin-top:30px;">
                                <tr>
                                    <td >
                                        <span>Ａ班：
                                            <?php                                                
                                                if($interviewees_a !== "") {
                                                    echo $interviewees_a; 
                                                }
                                                else {
                                                    
                                                }              
                                            ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                <td style="height:20px;"><span><?php echo $checker_comment_a; ?></span></td>
                                </tr>
                            </table> 
                            <table class="result_confirmation_regular
                             <?php
                                if($interviewees_b === "") {
                                    echo "strikediag_s";
                                } 
                            ?>
                            " id="result_confirmation_regular" style="width:100%;  margin-top:30px;">
                                <tr>
                                    <td>
                                        <span>Ｂ班：
                                            <?php                                                
                                                if($interviewees_b !== "") {
                                                    echo $interviewees_b; 
                                                }
                                                else {
                                                    
                                                }              
                                            ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                <td style="height:20px;"><span><?php echo $checker_comment_b; ?></span></td>
                                </tr>
                            </table> 
                            <table class="result_confirmation_regular
                             <?php
                                if($interviewees_c === "") {
                                    echo "strikediag_s";
                                } 
                            ?>
                            " id="result_confirmation_regular" style="width:100%; margin-top:30px;">
                                <tr>
                                    <td>
                                        <span>Ｃ班：
                                            <?php 
                                                if($interviewees_c !== "") {
                                                    echo $interviewees_c; 
                                                }
                                                else {
                                                  
                                                }              
                                            ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height:20px;"><span><?php echo $checker_comment_c; ?></span></td>
                                </tr>
                            </table>
                            <table class="result_confirmation_regular
                             <?php
                                if($interviewees_d === "") {
                                    echo "strikediag_s";
                                } 
                            ?>
                            " id="result_confirmation_regular" style="width:100%; margin-top:30px;">
                                <tr>
                                    <td>
                                        <span>Ｄ班：
                                            <?php 
                                                if($interviewees_d !== "") {
                                                    echo $interviewees_d; 
                                                }
                                                else {
                                                  
                                                }              
                                            ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                <td style="height:20px;"><span><?php echo $checker_comment_d; ?></span></td>
                                </tr>
                            </table>    
                        </div>
                        <div class="column-2" style="width:20%">
                            <table class="effect_checker" style="float:right; width: 75%; text-align:center;">
                                <tr>
                                    <td><span>効果確認者</span></td>
                                </tr>
                                <tr>
                                    <td style="height: 75px;"
                                    <?php 
                                         if($interviewees_regular === '') {
                                            echo "class = 'strikediag_s'";
                                        }
                                    ?>
                                    >
                                        <div 
                                        
                                        <?php  
                                            if($interviewees_regular !== '') {
                                                echo "style='display:flex; left:17px;'
                                                class='parent-checker' ";
                                            }

                                            else {
                                                echo "style='display:none;'";
                                            }
                                        ?>
                                        id="checker_regular_div">

                                        <div class='child-checker'>
                                                            <span-a-checker id='deployment_checker_regular'>製造部</span-a-checker>
                                                            <span-a-checker id='date_checker_regular'></span-a-checker>
                                                            <span-a-checker id='checker_regular_stamp'><?php echo $instructor_regular; ?></span-a-checker>
                                                        </div>  
                                        </div>                        
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height: 75px;"
                                    <?php 
                                         if($interviewees_a === '') {
                                            echo "class = 'strikediag_s'";
                                        }
                                    ?>
                                    >
                                        <div
                                        
                                        <?php  
                                            if($interviewees_a !== '') {
                                                echo "style='display:flex; left:17px;'
                                                class='parent-checker'";
                                            }
                                            else {
                                               echo "style='display:none;'";
                                            }
                                        ?>
                
                                        id="checker_a_div">
                                                <div class='child-checker'>
                                                            <span-a-checker id='deployment_checker_a'>製造部</span-a-checker>
                                                            <span-a-checker id='date_checker_a'></span-a-checker>
                                                            <span-a-checker id='checker_a_stamp'><?php echo $instructor_a; ?></span-a-checker>
                                                </div>
                                        </div>      
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height: 75px;"
                                    <?php 
                                         if($interviewees_b === '') {
                                            echo "class = 'strikediag_s'";
                                        }
                                    ?>
                                    >
                                    <div 
                                        
                                        <?php  
                                            if($interviewees_b !== '') {
                                                echo "style='display:flex; left:17px;'
                                                class='parent-checker'";
                                            }                                                                 
                                            else {
                                                echo "style='display:none;'";
                                            }
                                        ?>
                
                                        id="checker_regular_div">
                                                <div class="child-checker">
                                                    <span-a-checker id="deployment_checker_b">製造部</span-a-checker>
                                                    <span-a-checker id="date_checker_b"></span-a-checker>
                                                    <span-a-checker id="checker_b_stamp"><?php echo "$instructor_b";?></span-a-checker>
                                                </div>



                                            </div>     
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height: 75px;"
                                    <?php 
                                         if($interviewees_c === '') {
                                            echo "class = 'strikediag_s'";
                                        }
                                    ?>
                                    >
                                    <div class="parent-checker" 
                                        
                                        <?php  
                                            if($interviewees_c !== '') {
                                                echo "style='display:flex; left:17px;'";
                                            }
                                            else {
                                                echo "style='display:none;'";
                                            }
                                        ?>
                
                                        id="checker_regular_div">
                                                <div class="child-checker">
                                                    <span-a-checker id="deployment_checker_c">製造部</span-a-checker>
                                                    <span-a-checker id="date_checker_c"></span-a-checker>
                                                    <span-a-checker id="checker_c_stamp"><?php echo "$instructor_c";?></span-a-checker>
                                                </div>
                                            </div>     
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height: 75px;"
                                    <?php 
                                         if($interviewees_d === '') {
                                            echo "class = 'strikediag_s'";
                                        }
                                    ?>
                                    >
                                    <div class="parent-checker" 
                                        
                                        <?php  
                                            if($interviewees_d !== '') {
                                                echo "style='display:flex; left:17px;'";
                                            }
                                            else {
                                                echo "style='display:none;'";
                                            }
                                        ?>

                                        id="checker_regular_div">
                                                <div class="child-checker">
                                                    <span-a-checker id="deployment_checker_d">製造部</span-a-checker>
                                                    <span-a-checker id="date_checker_d"></span-a-checker>
                                                    <span-a-checker id="checker_d_stamp"><?php echo $instructor_d; ?></span-a-checker>
                                                </div>
                                            </div>     
                                    </td>
                                </tr> 
                            </table>
                        </div>
                    </div> 
                    
                </div>
             
                <div class="footer" style="text-align:center; align-items:middle; margin-top:85px;">
                        <b>太陽誘電株式会社</b>
                </div> 
            </div>
          
            <div class="page">
                <div class="subpage">
                    <div class="header" style="text-align:center; margin-top:20px;">
                    <h3>受講者（製造）</h3>
                    </div>
                    <div class="attendance">
                        <div class="column-1-b">
                            <table class="attendance-t-a" style="width:100%; margin-top:30px; table-layout:fixed">
                                    <thead>
                                        <th style="width:20%;">
                                        日付
                                        </th>
                                        <th style="width:20%;">
                                        所属
                                        </th>
                                        <th style="width:20%;">
                                        GID
                                        </th>
                                        <th style="width:25%;">
                                        氏名
                                        </th>
                                        <th style="width:15%;">
                                        認定
                                        </th>
                                    </thead>
                                    <tbody>
                                        
                                        <?php 
                                        foreach($result as $row) {

                                            //Remove Time from Datetime data            
                                            if ($row["attendance"] === '1') {

                                                if($row["date_id"] === NULL) {
                                                    echo "
                                                    <tr>
                                                        <td style='font-size:9px;'></td>
                                                ";                                                      
                                                }
                                                else {

                                                    $date_id = new DateTime(($row["date_id"]));
                                                    $date_signed = $date_id->format("Y-m-d");
                                                echo "
                                                    <tr>
                                                        <td style='font-size:9px;'>$date_signed</td>
                                                ";
                                                }
                                            }

                                            else if ($row["attendance"] === '2') {
                                                echo "
                                                    <tr>
                                                        <td style='font-size:7px;' class='strikediag_xs'></td>
                                                ";
                                            }
                                            
                                            echo "
                                                <td style='font-size:7px' padding:0;>$row[department_name]</td>";

                                            if(str_contains($row["GIDh"],"TMP")) {
                                                echo "
                                                    <td class = 'strikediag_xs'></td>
                                                ";
                                            }

                                            else {
                                                echo "<td>$row[GIDh]</td>";
                                            }

                                            echo "      
                                                <td style='font-size:7px;'>$row[name_]</td>
                                            ";

                                            switch($judgement) {
                                                case($judgement === 2):
                                                    echo "
                                                     <td class='strikediag_xs'></td>
                                                </tr>";
                                                break;
                                                case($row["attendance"] === '2'):
                                                    echo "
                                                     <td class='strikediag_xs'></td>
                                                </tr>
                                                ";
                                                break;
                                                case($row["attendance"] === '1' && $row["sign_progress"] === "2"):
                                                    echo "
                                                    <td>$row[judgement_name]</td>
                                                </tr>
                                                ";
                                                break;
                                                default:
                                                    echo "
                                                    <td></td>
                                                </tr>
                                                ";      
                                            }

                                            /*
                                            if ($judgement === 1 && $row["attendance"] === '1') {
                                                echo "
                                                    <td>$row[judgement_name]</td>
                                                </tr>
                                                ";
                                            }

                                            if($judgement === 2 || $row["attendance"] === '2') {
                                                echo "
                                                    <td class='strikediag_xs'></td>
                                                </tr>
                                            ";
                                            } */
                                        }

                                        echo "</tbody>";

                                        
                                        $remainder = 35 - $total_row;
                                        echo "<tbody class='strikediag'>";
                                        for ($i=0; $i<$remainder; $i++) {
                                            echo "
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        ";

                                        }

                                        echo "</tbody>";
                                        ?>

                                        
                                    
                            </table>
                        </div>
                        <div class="column-2-b">
                            <table class="attendance-t-b" style="width:100%; margin-top:30px;">
                                    <thead>
                                        <th style="width:20%;">
                                        日付
                                        </th>
                                        <th style="width:20%;">
                                        所属
                                        </th>
                                        <th style="width:20%;">
                                        GID
                                        </th>
                                        <th style="width:25%;">
                                        氏名
                                        </th>
                                        <th style="width:15%;">
                                        認定
                                        </th>
                                    </thead>
                                    <tbody>
                                        
                                    <?php 
                                        foreach($result_02 as $row) {

                                             //Remove Time from Datetime data


                                            //

                                            if ($row["attendance"] === '1') {

                                                if($row["date_id"] === NULL) {
                                                    echo "
                                                    <tr>
                                                        <td style='font-size:9px;'></td>
                                                ";                                                      
                                                }
                                                else {

                                                    $date_id = new DateTime(($row["date_id"]));
                                                    $date_signed = $date_id->format("Y-m-d");
                                                echo "
                                                    <tr>
                                                        <td style='font-size:9px;'>$date_signed</td>
                                                ";
                                                }
                                            }
                                            //

                                            else if ($row["attendance"] === '2') {
                                                echo "
                                                    <tr>
                                                        <td style='font-size:7px;' class='strikediag_xs'></td>
                                                ";
                                            }

                                            echo "
                                               
                                                    <td style='font-size:7px;'>$row[department_name]</td>";

                                            if(str_contains($row["GIDh"],"TMP")) {
                                                    echo "
                                                        <td class = 'strikediag_xs'></td>
                                                        ";
                                                    }
                                                    else {
                                                        echo "<td>$row[GIDh]</td>";
                                                    }
                                            echo "
                                                    <td style='font-size:7px;'>$row[name_]</td>
                                            ";

                                            switch($judgement) {
                                                case($judgement === 2):
                                                    echo "
                                                     <td class='strikediag_xs'></td>
                                                </tr>";
                                                break;
                                                case($row["attendance"] === '2'):
                                                    echo "
                                                     <td class='strikediag_xs'></td>
                                                </tr>
                                                ";
                                                break;
                                                case($row["attendance"] === '1' && $row["sign_progress"] === "2"):
                                                    echo "
                                                    <td>$row[judgement_name]</td>
                                                </tr>
                                                ";
                                                break;
                                                default:
                                                    echo "
                                                    <td></td>
                                                </tr>
                                                ";      
                                            }

                                            /*
                                            if ($judgement === 1 && $row["attendance"] === '1') {
                                                echo "
                                                    <td>$row[judgement_name]</td>
                                                </tr>
                                                ";
                                            }

                                            if($judgement === 2 || $row["attendance"] === '2') {
                                                echo "
                                                    <td class='strikediag_xs'></td>
                                                </tr>
                                            ";
                                            }

                                            */
                                        }

                                        echo "</tbody>";
                                        
                                        $remainder_02 = 35 - $total_row_02;

                                        echo "<tbody class='strikediag'>";

                                        for ($i=0; $i<$remainder_02; $i++) {
                                            echo "
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        ";

                                        }
                                        echo "</tbody>";
                                        ?>
                                    
                            </table>
                            
                        </div>
                    </div>
                    
                </div>
                <div class="footer" style="text-align:center; margin-top: 50px;">
                            <b><span>太陽誘電株式会社</span></b>
                </div>
            </div>

            <!----- PAGE 2 (IF NECCESSARY)------> 


            <?php 
                if ($total_row_03 !== 0) {

                    echo "
                <div class='page'>
                    <div class='subpage'>
                        <div class='header' style='text-align:center; margin-top:20px;'>
                        <h3>受講者（製造）</h3>
                        </div>
                        <div class='attendance'>
                            <div class='column-1-b'>
                                <table class='attendance-t-a' style='width:100%; margin-top:30px;'>
                                        <thead>
                                            <th style='width:20%;'>
                                            日付
                                            </th>
                                            <th style='width:20%;'>
                                            所属
                                            </th>
                                            <th style='width:20%;'>
                                            GID
                                            </th>
                                            <th style='width:25%;'>
                                            氏名
                                            </th>
                                            <th style='width:15%;'>
                                            認定
                                            </th>
                                        </thead>
                                        <tbody> 

                                        ";

                                    }
            ?>
            <?php 
                                        foreach($result_03 as $row) {
                                            
                                               //Remove Time from Datetime data
                                            if ($row["attendance"] === '1') {

                                                if($row["date_id"] === NULL) {
                                                    echo "
                                                    <tr>
                                                        <td style='font-size:9px;'></td>
                                                ";                                                      
                                                }
                                                else {

                                                    $date_id = new DateTime(($row["date_id"]));
                                                    $date_signed = $date_id->format("Y-m-d");
                                                echo "
                                                    <tr>
                                                        <td style='font-size:9px;'>$date_signed</td>
                                                ";
                                                }
                                            }

                                            else if ($row["attendance"] === '2') {
                                                echo "
                                                    <tr>
                                                        <td style='font-size:7px;' class='strikediag_xs'></td>
                                                ";
                                            }

                                            echo "                                   
                                                    <td style='font-size:7px;'>$row[department_name]</td>
                                                ";

                                            if(str_contains($row["GIDh"],"TMP")) {
                                                echo "
                                                    <td class = 'strikediag_xs'></td>
                                                    ";
                                                }
    
                                            else {
                                                echo "<td>$row[GIDh]</td>";
                                            }


                                            echo "
                                                    <td style='font-size:7px;'>$row[name_]</td>
                                            ";

                                            switch($judgement) {
                                                case($judgement === 2):
                                                    echo "
                                                     <td class='strikediag_xs'></td>
                                                </tr>";
                                                break;
                                                case($row["attendance"] === '2'):
                                                    echo "
                                                     <td class='strikediag_xs'></td>
                                                </tr>
                                                ";
                                                break;
                                                case($row["attendance"] === '1' && $row["sign_progress"] === "2"):
                                                    echo "
                                                    <td>$row[judgement_name]</td>
                                                </tr>
                                                ";
                                                break;
                                                default:
                                                    echo "
                                                    <td></td>
                                                </tr>
                                                ";      
                                            }

                                            /*

                                            if ($judgement === 1 && $row["attendance"] === '1') {
                                                echo "
                                                    <td>$row[judgement_name]</td>
                                                </tr>
                                                ";
                                            }

                                            if($judgement === 2 || $row["attendance"] === '2') {
                                                echo "
                                                    <td class='strikediag_xs'></td>
                                                </tr>
                                            ";
                                            } */
                                        }
                                        echo "</tbody>";
                                        $remainder_03 = 35 - $total_row_03;
                                        echo "<tbody class='strikediag'>";
                                        for ($i=0; $i<$remainder_03; $i++) {
                                            echo "
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        ";
                                        
                                        }
                                        echo "</tbody>";
            ?>

            <?php 
                if ($total_row_03 !== 0) {
                                        echo "
                                    
                                        
                                </table>
                            </div>
                            <div class='column-2-b'>
                                <table class='attendance-t-b' style='width:100%; margin-top:30px;'>
                                        <thead>
                                            <th style='width:20%;'>
                                            日付
                                            </th>
                                            <th style='width:20%;'>
                                            所属
                                            </th>
                                            <th style='width:20%;'>
                                            GID
                                            </th>
                                            <th style='width:25%;'>
                                            氏名
                                            </th>
                                            <th style='width:15%;'>
                                            認定
                                            </th>
                                        </thead>
                                        <tbody>
                                        ";
                                    }                        
            ?>

            <?php 
                                        foreach($result_04 as $row) {

                                            //Remove Time from Datetime data
                                            if ($row["attendance"] === '1') {

                                                if($row["date_id"] === NULL) {
                                                    echo "
                                                    <tr>
                                                        <td style='font-size:9px;'></td>
                                                ";                                                      
                                                }
                                                else {

                                                    $date_id = new DateTime(($row["date_id"]));
                                                    $date_signed = $date_id->format("Y-m-d");
                                                echo "
                                                    <tr>
                                                        <td style='font-size:9px;'>$date_signed</td>
                                                ";
                                                }
                                            }

                                            if ($row["attendance"] === '1') {
                                                echo "
                                                    <tr>
                                                        <td style='font-size:7px;'>$date_signed</td>
                                                ";
                                            }

                                            else if ($row["attendance"] === '2') {
                                                echo "
                                                    <tr>
                                                        <td style='font-size:7px;' class='strikediag_xs'></td>
                                                ";
                                            }

                                            echo "
                                                    <td style='font-size:7px;'>$row[department_name]</td>
                                                ";

                                            if(str_contains($row["GIDh"],"TMP")) {
                                                echo "
                                                    <td class = 'strikediag_xs'></td>
                                                    ";
                                                }
    
                                            else {
                                                    echo "<td>$row[GIDh]</td>";
                                                }

                                            echo "
                                                    <td style='font-size:7px;'>$row[name_]</td>
                                            ";

                                            switch($judgement) {
                                                case($judgement === 2):
                                                    echo "
                                                     <td class='strikediag_xs'></td>
                                                </tr>";
                                                break;
                                                case($row["attendance"] === '2'):
                                                    echo "
                                                     <td class='strikediag_xs'></td>
                                                </tr>
                                                ";
                                                break;
                                                case($row["attendance"] === '1' && $row["sign_progress"] === "2"):
                                                    echo "
                                                    <td>$row[judgement_name]</td>
                                                </tr>
                                                ";
                                                break;
                                                default:
                                                    echo "
                                                    <td></td>
                                                </tr>
                                                ";      
                                            }

                                            /*
                                            if ($judgement === 1 && $row["attendance"] === '1') {
                                                echo "
                                                    <td>$row[judgement_name]</td>
                                                </tr>
                                                ";
                                            }

                                            if($judgement === 2 || $row["attendance"] === '2') {
                                                echo "
                                                    <td class='strikediag_xs'></td>
                                                </tr>
                                            ";
                                            } 

                                            */
                                        }

                                        echo "</tbody>";
                                        
                                        $remainder_04 = 35 - $total_row_04;

                                        echo "<tbody class='strikediag'";
                                        for ($i=0; $i<$remainder_04; $i++) {
                                            echo "
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        ";

                                        }
                                        echo "</tbody>";
            ?>

            <?php 
                if ($total_row_03 !== 0) {

                    echo"
                                
                                        
                                </table>
                            </div>
                            
                            
                        </div>
                        
                    </div>
                    <div class='footer' style='text-align:center;  margin-top: 50px;'>
                        <span><b>太陽誘電株式会社</b></span>
                    </div>
                </div>                
                    
                    
                    ";
                }
                
            ?>

            <!----- PAGE 3 (IF NECCESSARY)------> 

            <?php 
                if ($total_row_05 !== 0) {

                    echo "
                <div class='page'>
                    <div class='subpage'>
                        <div class='header' style='text-align:center; margin-top:20px;'>
                        <h3>受講者（製造）</h3>
                        </div>
                        <div class='attendance'>
                            <div class='column-1-b'>
                                <table class='attendance-t-a' style='width:100%; margin-top:30px;'>
                                        <thead>
                                            <th style='width:20%;'>
                                            日付
                                            </th>
                                            <th style='width:20%;'>
                                            所属
                                            </th>
                                            <th style='width:20%;'>
                                            GID
                                            </th>
                                            <th style='width:25%;'>
                                            氏名
                                            </th>
                                            <th style='width:15%;'>
                                            認定
                                            </th>
                                        </thead>
                                        <tbody> 

                                        ";

                                    }
            ?>
            <?php 
                                        foreach($result_05 as $row) {

                                            //Remove Time from Datetime data
                                            if ($row["attendance"] === '1') {

                                                if($row["date_id"] === NULL) {
                                                    echo "
                                                    <tr>
                                                        <td style='font-size:9px;'></td>
                                                ";                                                      
                                                }
                                                else {

                                                    $date_id = new DateTime(($row["date_id"]));
                                                    $date_signed = $date_id->format("Y-m-d");
                                                echo "
                                                    <tr>
                                                        <td style='font-size:9px;'>$date_signed</td>
                                                ";
                                                }
                                            }

                                            else if ($row["attendance"] === '2') {
                                                echo "
                                                    <tr>
                                                        <td style='font-size:7px;' class='strikediag_xs'></td>
                                                ";
                                            }

                                            echo "                                   
                                                    <td style='font-size:7px;'>$row[department_name]</td>
                                                ";

                                            if(str_contains($row["GIDh"],"TMP")) {
                                                echo "
                                                    <td class = 'strikediag_xs'></td>
                                                    ";
                                                }
    
                                            else {
                                                echo "<td>$row[GIDh]</td>";
                                            }


                                            echo "
                                                    <td style='font-size:7px;'>$row[name_]</td>
                                            ";

                                            switch($judgement) {
                                                case($judgement === 2):
                                                    echo "
                                                     <td class='strikediag_xs'></td>
                                                </tr>";
                                                break;
                                                case($row["attendance"] === '2'):
                                                    echo "
                                                     <td class='strikediag_xs'></td>
                                                </tr>
                                                ";
                                                break;
                                                case($row["attendance"] === '1' && $row["sign_progress"] === "2"):
                                                    echo "
                                                    <td>$row[judgement_name]</td>
                                                </tr>
                                                ";
                                                break;
                                                default:
                                                    echo "
                                                    <td></td>
                                                </tr>
                                                ";      
                                            }

                                            /*

                                            if ($judgement === 1 && $row["attendance"] === '1') {
                                                echo "
                                                    <td>$row[judgement_name]</td>
                                                </tr>
                                                ";
                                            }

                                            if($judgement === 2 || $row["attendance"] === '2') {
                                                echo "
                                                    <td class='strikediag_xs'></td>
                                                </tr>
                                            ";
                                            } */
                                        }
                                        echo "</tbody>";
                                        $remainder_05 = 35 - $total_row_05;
                                        echo "<tbody class='strikediag'>";
                                        for ($i=0; $i<$remainder_05; $i++) {
                                            echo "
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        ";
                                        
                                        }
                                        echo "</tbody>";
            ?>

            <?php 
                if ($total_row_05 !== 0) {
                                        echo "
                                    
                                        
                                </table>
                            </div>
                            <div class='column-2-b'>
                                <table class='attendance-t-b' style='width:100%; margin-top:30px;'>
                                        <thead>
                                            <th style='width:20%;'>
                                            日付
                                            </th>
                                            <th style='width:20%;'>
                                            所属
                                            </th>
                                            <th style='width:20%;'>
                                            GID
                                            </th>
                                            <th style='width:25%;'>
                                            氏名
                                            </th>
                                            <th style='width:15%;'>
                                            認定
                                            </th>
                                        </thead>
                                        <tbody>
                                        ";
                                    }                        
            ?>

            <?php 
                                        foreach($result_06 as $row) {

                                               //Remove Time from Datetime data
                                            if ($row["attendance"] === '1') {

                                                if($row["date_id"] === NULL) {
                                                    echo "
                                                    <tr>
                                                        <td style='font-size:9px;'></td>
                                                ";                                                      
                                                }
                                                else {

                                                    $date_id = new DateTime(($row["date_id"]));
                                                    $date_signed = $date_id->format("Y-m-d");
                                                echo "
                                                    <tr>
                                                        <td style='font-size:9px;'>$date_signed</td>
                                                ";
                                                }
                                            }

                                            if ($row["attendance"] === '1') {
                                                echo "
                                                    <tr>
                                                        <td style='font-size:7px;'>$date_signed</td>
                                                ";
                                            }

                                            else if ($row["attendance"] === '2') {
                                                echo "
                                                    <tr>
                                                        <td style='font-size:7px;' class='strikediag_xs'></td>
                                                ";
                                            }

                                            echo "
                                                    <td style='font-size:7px;'>$row[department_name]</td>
                                                ";

                                            if(str_contains($row["GIDh"],"TMP")) {
                                                echo "
                                                    <td class = 'strikediag_xs'></td>
                                                    ";
                                                }
    
                                            else {
                                                    echo "<td>$row[GIDh]</td>";
                                                }

                                            echo "
                                                    <td style='font-size:7px;'>$row[name_]</td>
                                            ";

                                            switch($judgement) {
                                                case($judgement === 2):
                                                    echo "
                                                     <td class='strikediag_xs'></td>
                                                </tr>";
                                                break;
                                                case($row["attendance"] === '2'):
                                                    echo "
                                                     <td class='strikediag_xs'></td>
                                                </tr>
                                                ";
                                                break;
                                                case($row["attendance"] === '1' && $row["sign_progress"] === "2"):
                                                    echo "
                                                    <td>$row[judgement_name]</td>
                                                </tr>
                                                ";
                                                break;
                                                default:
                                                    echo "
                                                    <td></td>
                                                </tr>
                                                ";      
                                            }

                                            /*
                                            if ($judgement === 1 && $row["attendance"] === '1') {
                                                echo "
                                                    <td>$row[judgement_name]</td>
                                                </tr>
                                                ";
                                            }

                                            if($judgement === 2 || $row["attendance"] === '2') {
                                                echo "
                                                    <td class='strikediag_xs'></td>
                                                </tr>
                                            ";
                                            } 

                                            */
                                        }

                                        echo "</tbody>";
                                        
                                        $remainder_06 = 35 - $total_row_06;

                                        echo "<tbody class='strikediag'";
                                        for ($i=0; $i<$remainder_04; $i++) {
                                            echo "
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        ";

                                        }
                                        echo "</tbody>";
            ?>

            <?php 
                if ($total_row_05 !== 0) {

                    echo"
                                
                                        
                                </table>
                            </div>
                            
                            
                        </div>
                        
                    </div>
                    <div class='footer' style='text-align:center;  margin-top: 50px;'>
                        <span><b>太陽誘電株式会社</b></span>
                    </div>
                </div>                
                    
                    
                    ";
                }
                
            ?>
        
        </div>   
    </div>
    
</div>   
</body>


<script type="text/javascript">

//jquery script 


$(document).ready(function() {

//STAMP COLOR
var creator_stamp ="<?php echo $creator_stamp_color; ?>";
var approver_stamp ="<?php echo $approver_stamp_color; ?>";
$("#btn-creator-black").on("click", function (){
    creator_stamp = "1";
    stamp_color_update();
})
$("#btn-creator-red").on("click", function (){
    creator_stamp = "2";
    stamp_color_update();
})
$("#btn-approver-black").on("click", function (){
    approver_stamp = "1";
    stamp_color_update();
})
$("#btn-approver-red").on("click", function (){
    approver_stamp = "2";
    stamp_color_update();
})

function stamp_color_update() {

    var training_id_stamp = "<?php echo $training_id;?>";

    console.log(training_id_stamp);
    $.ajax({
        url: "includes/update_stamp_color_pdf.inc.php",
        method: "POST",
        data: {creator_stamp:creator_stamp,approver_stamp:approver_stamp,training_id_stamp:training_id_stamp},
        success:function(data){
            
            console.log(data);
           location.reload();
        }
    });  

}

stamp_color();

function stamp_color() {

    var creator_stamp_color = "<?php echo $creator_stamp_color; ?>";
    var approver_stamp_color ="<?php echo $approver_stamp_color?>";

    if(approver_stamp_color === "1") {
        $(".parent").css("border", "1px solid black");
        $("#deployment_approver").css("color", "black");
        $("#date_approved").css("color", "black");
        $("#approver_stamp").css("color", "black");
        $( "<style>.parent::before, .parent::after {content: '';position: absolute;width: 100%;height: 1px;background: black;}</style>" ).appendTo( "head" );
        
    }

    else if(approver_stamp_color === "2") {
        $(".parent").css("border", "1px solid red");
        $("#deployment_approver").css("color", "red");
        $("#date_approved").css("color", "red");
        $("#approver_stamp").css("color", "red");
        $( "<style>.parent::before, .parent::after {content: '';position: absolute;width: 100%;height: 1px;background: red;}</style>" ).appendTo( "head" );
    }

    else {
        //continue..
    }
   
    if(creator_stamp_color === "1") {
        $(".parent-creator").css("border", "1px solid black");
        $("#deployment_creator").css("color", "black");
        $("#date_created").css("color", "black");
        $("#creator_stamp").css("color", "black");
        $( "<style>.parent-creator::before, .parent-creator::after {content: '';position: absolute;width: 100%;height: 1px;background: black;}</style>" ).appendTo( "head" );
    }

    else if(creator_stamp_color === "2") {
        $(".parent-creator").css("border", "1px solid red");
        $("#deployment_creator").css("color", "red");
        $("#date_created").css("color", "red");
        $("#creator_stamp").css("color", "red");
        $( "<style>.parent-creator::before, .parent-creator::after {content: '';position: absolute;width: 100%;height: 1px;background: red;}</style>" ).appendTo( "head" );
    }

    else {
        //continue..
    }
    
}

$("#approval_date_edit").on("change", function() {
    change_approval_date();
});

function change_approval_date() {
    var edit_approval_date = $("#approval_date_edit").val();
    var training_id = "<?php echo $training_id;?>";

    console.log(edit_approval_date);

    $.ajax({
        url: "includes/update_pdf_stamp.inc.php",
        method: "POST",
        data: {edit_approval_date:edit_approval_date,training_id:training_id},
        success:function(data){
            alert(data);
            location.reload();
        }
    }); 
}


$('#edit_stamp_btn').click(function(){
        edit_stamp();
});

function edit_stamp() {

    //$('#post_list').html();
    var action = 'fetch_data';
    var creator = $("#input-creator").val();
    var approver = $("#input-approver").val();
    var training_id = "<?php echo $training_id;?>";

    $.ajax({
        url: "includes/update_pdf_stamp.inc.php",
        method: "POST",
        data: {action:action,creator:creator,approver:approver,training_id:training_id},
        success:function(data){
          alert("スタンプが正常に更新されました");
          location.reload();
        }
    }); 

    }

});

//GET THE FILE NAME

//Datetime

window.onload =function() {
    input_data();

//get the date checker regular
    
    var checker_date_regular = new Date('<?php echo $checker_date_regular;?>');
    var checker_date_regular_day = String(checker_date_regular.getDate()).padStart(2, '0');
    var checker_date_regular_month = String(checker_date_regular.getMonth() + 1).padStart(2, '0');
    var checker_date_regular_year = checker_date_regular.getFullYear();
    var checker_date_regular_stamp = checker_date_regular_year + "." + checker_date_regular_month + "." + checker_date_regular_day;

    document.getElementById('date_checker_regular').innerHTML =checker_date_regular_stamp;

//get the date checker a
    var checker_date_a = new Date('<?php echo $checker_date_a;?>');
    var checker_date_a_day = String(checker_date_a.getDate()).padStart(2, '0');
    var checker_date_a_month = String(checker_date_a.getMonth() + 1).padStart(2, '0');
    var checker_date_a_year = checker_date_a.getFullYear();
    var checker_date_a_stamp = checker_date_a_year + "." + checker_date_a_month + "." + checker_date_a_day;

    document.getElementById('date_checker_a').innerHTML =checker_date_a_stamp;

//get the date checker b
    var checker_date_b = new Date('<?php echo $checker_date_b;?>');
    var checker_date_b_day = String(checker_date_b.getDate()).padStart(2, '0');
    var checker_date_b_month = String(checker_date_b.getMonth() + 1).padStart(2, '0');
    var checker_date_b_year = checker_date_b.getFullYear();
    var checker_date_b_stamp = checker_date_b_year + "." + checker_date_b_month + "." + checker_date_b_day;

    document.getElementById('date_checker_b').innerHTML =checker_date_b_stamp;

//get the date checker c
    var checker_date_c = new Date('<?php echo $checker_date_c;?>');
    var checker_date_c_day = String(checker_date_c.getDate()).padStart(2, '0');
    var checker_date_c_month = String(checker_date_c.getMonth() + 1).padStart(2, '0');
    var checker_date_c_year = checker_date_c.getFullYear();
    var checker_date_c_stamp = checker_date_c_year + "." + checker_date_c_month + "." + checker_date_c_day;

    document.getElementById('date_checker_c').innerHTML =checker_date_c_stamp;

//get the date checker d 
/*
    var checker_date_d = new Date('<?php echo $checker_date_d;?>');
    var checker_date_d_day = String(checker_date_d.getDate()).padStart(2, '0');
    var checker_date_d_month = String(checker_date_d.getMonth() + 1).padStart(2, '0');
    var checker_date_d_year = checker_date_d.getFullYear();
    var checker_date_d_stamp = checker_date_d_year + "." + checker_date_d_month + "." + checker_date_d_day;

    document.getElementById('date_checker_d').innerHTML =checker_date_d_stamp; */

// get the date created
    var date_created;

    var date_created = new Date('<?php echo $date_created;?>');
    var date_created_day =String(date_created.getDate()).padStart(2, '0');
    var date_created_month = String(date_created.getMonth() + 1).padStart(2, '0');
    var date_created_year = date_created.getFullYear();
    var date_file_name =date_created_year + date_created_month + date_created_day;
    var date_created_stamp = date_created_year + "." + date_created_month + "." + date_created_day;

    console.log(date_created_stamp);
    console.log(date_file_name);
    
    document.getElementById('date_created').innerHTML =date_created_stamp;

// category script
    var training_id = '<?php echo $training_id; ?>';
    var training_name = '<?php echo $training_name; ?>';
    var category_quality = '<?php echo $category_quality; ?>';
    
    var cat_q = '';
    cat_q = '<?php if(in_array(1,$category))
     {echo '品質';}?>';

    var cat_en = ''; 
    cat_en = '<?php if(in_array(2,$category))
     {echo '環境';}?>';

    var cat_sh = '';
    cat_sh = '<?php if(in_array(3,$category))
     {echo '安全衛生';}?>';

    var cat_o = '';
    cat_o = '<?php if(in_array(4,$category))
     {echo 'その他';}?>';

    var cat_name = '';
    var file_name_try = training_id.concat("_",date_file_name,"_",training_name,"(",cat_q,cat_en,cat_sh,cat_o,cat_name,")"); 

    console.log(file_name_try);

//get the date today

    
    document.getElementById("download")
    .addEventListener("click", () => {
        var test = this.document.getElementById("test");
        console.log(test);
        console.log(window);

        var options = {
            filename: file_name_try,
            image: { type: 'jpeg', quality: 1},
            html2canvas: { scale: 4},
            jsPDF: {putTotalPages: true},
        }; 
        
        html2pdf().set(options).from(test).save();
    })
}

    var input_creator;
    var input_approver;
    function input_data() {
 
    input_creator = document.getElementById('input-creator').value; 
    document.getElementById('creator_stamp').innerHTML = input_creator;

 /*   input_approver = document.getElementById('input-approver').value; 
    document.getElementById('approver_stamp').innerHTML = input_creator; */

    }
    
// function approve_data() {
    
  //  document.getElementByID('approver_db').value = document.getElementById('input-approver').value;
    
    input_approver = document.getElementById('input-approver').value; 
    document.getElementById('approver_stamp').innerHTML = input_approver;

    var date_approved;

    var date_approved= new Date(<?php 
        if(isset($approval_date)){
            echo "'" . $approval_date . "'";
            } ?>);

    console.log();
    var date_approved_day =String(date_approved.getDate()).padStart(2, '0');
    var date_approved_month = String(date_approved.getMonth() + 1).padStart(2, '0');
    var date_approved_year = date_approved.getFullYear();

    var deployment_approver;
    deployment_approver = '製造部';
    document.getElementById('deployment_approver').innerHTML =deployment_approver;

    var date_approved_stamp = date_approved_year + "." + date_approved_month + "." + date_approved_day;

    document.getElementById('date_approved').innerHTML = date_approved_stamp;
    //document.getElementById('approver_div').style.display = 'flex';

    //console.log()


//}

    


</script>

</html>