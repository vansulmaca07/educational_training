<?php
    session_start();
    //returns to login page if accessed without logging in
    if(!isset($_SESSION["GID"])) {
        header("Location: loginpage.php");
    }
    include("includes/dbh2.inc.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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
    <link rel="stylesheet" href="home.css">

    <!--scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

    <!--popper-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
   
    <!--
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>

    <!-- Loading GIF -->
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs"type="module"></script>
   
</head>
<body>
    <div class="container-fluid" style="height:100%;">
        <div class="row" style="height:100%;">
            <div class="col-2 min-vh-100 navigation-menu;" style="background-color: rgba(4, 73, 129, 0.808);">
                <div class="pt-4 pb-1 px-2">
                    <a href="" class="text-white text-decoration-none">
                        <i class="fa-solid fs-2 fa-brands fa-wpforms me-2"></i>
                        <span class="fs-5 d-none d-sm-inline">教育訓練記録</span>
                    </a>
                </div>
                <hr class="text-white">
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item text-white mb-2" style="margin-left:10px;">
                        <i class="fa-solid fa-circle-user fs-5 me-2"></i>
                        <span class="d-none d-sm-inline">
                            <?php echo $_SESSION["name_"] . "<br>";?>        
                        </span>
                    </li>              
                </ul>
                <hr class="text-white">
                <ul class="nav nav-pills flex-column mb-0">
                    <li class="nav-item nav-item-progress <?php if($_SESSION["userlevel"] === '3') { echo "d-none";} ?>">
                        <a href="progress_test.php" class="nav-link progress-tab text-white">
                            <i class="fa-solid fs-5 fa-list-check me-2"></i>
                            <span class="d-none d-sm-inline">進捗状況</span>
                        </a>
                    </li>
                    <li class="nav-item nav-item-new-form <?php if($_SESSION["userlevel"] === '3') { echo "d-none";} ?>">
                        <a href="newform.php" class="nav-link new-form-tab text-white" style="hover:0.5;">
                            <i class="fa-solid fs-5 fa-file-medical me-3"></i>
                            <span class="d-none d-sm-inline">新規作成</span>
                        </a>
                    </li>
                    <li class="nav-item nav-item-training">
                        <a href="training.php" class="nav-link training-tab text-white">
                            <i class="fa-solid fs-6 fa-chalkboard-user me-2"></i>
                            <span class="d-none d-sm-inline">受講者署名</span>
                        </a>
                    </li>
                    <li class="nav-item nav-item-id-card-registration <?php if($_SESSION["userlevel"] === '3') { echo "d-none";} ?>">
                        <a href="idregistration.php" class="nav-link id-registration-tab text-white">
                            <i class="fa-solid fs-5 fa-id-card me-2"></i>
                            <span class="d-none d-sm-inline">IDカード登録</span>
                        </a>
                    </li>
                </ul>
                <hr class="text-white m-0">
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item nav-item-manual <?php if($_SESSION["userlevel"] === '3') { echo "d-none";} ?>">
                        <a href="#" class="nav-link alfresco-tab text-white" target="blank_">
                            <i class="fa-solid fa-person-chalkboard fs-5 me-2"></i>
                            <span class="d-none d-sm-inline">マニュアル</span>
                        </a>
                    </li>
                    <li class="nav-item text-white">
                        <a href="change_password.php" class="nav-link user-settings-tab text-white">
                            <i class="fa-solid fa-gears fs-5 me-2"></i>
                            <span class="d-none d-sm-inline">ユーザー設定</span>
                        </a> 
                    </li>
                </ul>
                <hr class="text-white m-0">
                <ul class="nav nav-pills flex-column mb-0">
                    <li class="nav-item nav-item-alfresco <?php if($_SESSION["userlevel"] === '3') { echo "d-none";} ?>">
                        <a href="http://172.31.28.75:8080/share/page/site/jty" 
                        class="nav-link alfresco-tab text-white" target="blank_">
                            <i class="fa-solid fa-box-archive fs-5 me-2"></i>
                            <span class="d-none d-sm-inline">アルフレスコ</span>
                        </a>
                    </li>
                    <li class="nav-item nav-item-alfresco <?php if($_SESSION["userlevel"] === '3') { echo "d-none";} ?>">
                        <a href="http://172.31.12.206:4040/auth/login" 
                        class="nav-link alfresco-tab text-white" target="blank_">
                            <i class="fa-solid fa-user-group fs-5 me-2"></i>
                            <span class="d-none d-sm-inline">ヒトマトメ</span>
                        </a>
                    </li>  
                </ul>
                <hr class="text-white m-0">
                <ul class="nav nav-pills flex-column mb-0">
                    <li class="nav-item nav-item-user-management <?php if($_SESSION["userlevel"] !== '1') { echo "d-none";} ?>">
                        <a href="administrator_settings.php" class="nav-link text-white administrator-settings-tab">
                            <i class="fa-solid fs-5 fa-gear me-2"></i>
                            <span class="d-none d-sm-inline">管理者設定</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="includes/logout.inc.php" class="nav-link text-white">
                            <i class="bi fs-5 me-2 bi-box-arrow-left"></i>
                            <span class="d-none d-sm-inline">ログアウト</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-10"  style="height:100%;  overflow:scroll;">
                <div class="pt-4 pb-1 px-2 main-page" style="height:100%;">



          
