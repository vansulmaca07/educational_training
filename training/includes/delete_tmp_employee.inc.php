<?php

session_start();
include("dbh2.inc.php");

if($_SERVER["REQUEST_METHOD"] === "POST") {
    
    try {
        $query = "DELETE FROM users 
            WHERE GID = :GID;
            W
            DELETE FROM outsourced_users 
                WHERE GID = :GID
         ";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":GID", $_POST["GID_temp_edit"]);
        $stmt->execute();

        $output = "<div class='alert alert-success alert-dismissible fade show pt-2 pb-2' style='bottom: 45px;' role='alert'>
        臨時従業員[$_POST[GID_temp_edit]]が追加されました。
            <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
        
        echo $output;
        

    } catch (\Throwable $th) {
        //throw $th;
    }

}