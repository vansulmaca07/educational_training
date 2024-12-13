<?php

session_start();


if ($_SESSION["userlevel"] === "generaluser") { 

    session_unset();
    session_destroy();
    header("location: ../loginpage.php");
    exit();
 }

else if ($_SESSION["userlevel"] === "administrator" or "user" or "leader") {

    header("location: ../progress_test.php");
    exit();
}