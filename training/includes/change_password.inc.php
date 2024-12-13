<?php
session_start();

include('dbh2.inc.php');
if($_SERVER['REQUEST_METHOD']=== "POST" ) {

    $old_password = $_POST["old_password"];
    $new_password = $_POST["new_password"];
    $new_password_confirmation = $_POST["new_password_confirmation"];
    $GID = $_SESSION["GID"]; 

    switch($new_password) {
        case($new_password !== $new_password_confirmation):
            header("Location: ../change_password.php?error=password_not_matched");
            exit();
        case($new_password ===""):
            header("Location: ../change_password.php?error=password_blank");
            exit();
        case(strlen($new_password) < 5);
            header("Location: ../change_password.php?error=password_too_short");
            exit();
        case($new_password === $GID):
            header("Location: ../change_password.php?error=password_GID");
            exit();
    }

    $query_old_password = "SELECT pwd FROM users WHERE GID = :GID";
    
    $stmt=$pdo->prepare($query_old_password);
    $stmt->bindParam(":GID", $GID);
    $stmt->execute();
    
    $result=$stmt->fetchAll();

    $old_password_database = "";
    foreach($result as $row_){
        $old_password_database = $row["pwd"];
    }

    switch($old_password_database) {
        case($old_password !== $old_password_database):
            header("Location: ../change_password.php?error=old_password_not_matched");
            exit();
    }

    $query = "UPDATE users
        SET pwd = :new_password
        WHERE GID = :GID";
    
    $stmt_update = $pdo->prepare($query);
    $stmt_update->bindParam(":new_password", $new_password);
    $stmt_update->bindParam(":GID", $GID);
    $stmt_update->execute();
    
    header("Location: ../change_password.php?success=password_changed");

    exit();
    
}