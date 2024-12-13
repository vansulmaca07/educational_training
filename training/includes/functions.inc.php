<?php 


function emptyInputLogin($username, $pwd) {
    $result;
    if (empty($username) || empty($pwd)) {
        $result = true;
    }
    else {
        $result = false;
    }

    return $result;
}

function uidExists($conn, $username) {

  //  $sql = "SELECT * FROM users WHERE GID = ?;";

    $sql = "SELECT users.userlevel, users.GID, users.name_, users.RFID, users.pwd, users.department_id, dept.department_name, users.group_id, users.shift_id, position_level, group_name
    FROM 
        users
    INNER JOIN
        department AS dept
    ON
        users.department_id = dept.department_id
    INNER JOIN
        position ON position.position_id = users.position_id
    INNER JOIN
        group_ ON group_.group_id = users.group_id
    WHERE 
        users.GID =?
    AND
        users.account_activation = 1;
    
    "; 

 /*   $sql = "SELECT backup_user.userlevel, backup_user.GID, backup_user.name_, backup_user.RFID, backup_user.pwd, backup_user.department_id, dept.department_name, backup_user.group_id
    FROM backup_user
    INNER JOIN
    department AS dept
    ON
    backup_user.department_id = dept.department_id
    where 
    backup_user.GID =?;"; */

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../loginpage.php?error=stmtfailed"); 
        exit();
    } 

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }

    else {
        $result = false;
        return $result;
    }
}

function loginUser ($conn, $username, $pwd) {
    $uidExists = uidExists($conn, $username);

    if ($uidExists === false) {
        header(("location: ../loginpage.php?error=wronglogin"));
        exit();
    }

    $pwdDB = $uidExists["pwd"];
    
    if ($pwdDB !== $pwd) {
        header("location: ../loginpage.php?error=wronglogin");
        exit();
    }

    else if ($pwdDB === $pwd ) {

        session_start();
        $_SESSION["userlevel"] = $uidExists["userlevel"];
        $_SESSION["GID"] = $uidExists["GID"];
        $_SESSION["name_"] = $uidExists["name_"];
        $_SESSION["rfid"] = $uidExists["RFID"];
        $_SESSION["department_name"] = $uidExists["department_name"];
        $_SESSION["department"] = $uidExists["department_id"];
        $_SESSION["group_id"] = $uidExists["group_id"];
        $_SESSION["shift_id"] = $uidExists["shift_id"];
        $_SESSION["position_level"] = $uidExists["position_level"];
        $_SESSION["group_name"] = $uidExists["group_name"];
        //$_SESSION["group_"] = $uidExists["group_id"];
        
        if ($_SESSION["userlevel"] === "1") {
        header("location: ../progress_test.php");
        }
        else if ($_SESSION["userlevel"] === "2") {
            header("location: ../progress_test.php");
            }
        else if ($_SESSION["userlevel"] === "4") {
            header("location: ../progress_test.php");
            }
        else if ($_SESSION["userlevel"] === "3") {
        header("location: ../training.php");
        }

        exit();
        }
    }
