<?php

session_start();

$_SESSION["userlevel"] = "generaluser";
$_SESSION["document_number"] = "";

header("location: ../attendance.php");
exit();

