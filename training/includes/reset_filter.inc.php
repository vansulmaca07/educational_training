<?php

session_start();

unset($_SESSION['training_id_filter']);
unset($_SESSION['training_name_filter']);
unset($_SESSION['training_creator_filter']);
unset($_SESSION['category_filter']);
unset($_SESSION['department_main_filter']);
unset($_SESSION['status_filter']);
unset($_SESSION['term_filter']);
unset($_SESSION["group_main_filter"]);
unset($_SESSION["start_date_filter"]);
unset($_SESSION["end_date_filter"]);


header("location: ../progress_test.php");

exit();