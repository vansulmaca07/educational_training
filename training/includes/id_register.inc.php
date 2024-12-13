<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $rfid = ($_POST["rfid"]);
    $GIDfetch  = ($_POST["ID_GID_register"]);
    
    try {
        require_once "dbh2.inc.php";

       $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);

          //Check for Duplicate
        $query_check = "SELECT COUNT(RFID) FROM users
            where 
                RFID = :rfid
        ";

        $stmt_check = $pdo->prepare($query_check);
        $stmt_check->bindParam(":rfid", $rfid);
        $stmt_check->execute();

        $exist = $stmt_check->fetchColumn();
 
        if ($exist === 1) {
            echo "
            <div class='alert alert-danger alert-dismissible fade show pt-2 pb-2' style='bottom: 45px;' role='alert'>
                DUPLICATE RFID DATA!
                    <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>       
            ";
            die();
        } 
        
        else {

        } 

        $query ="UPDATE users
                        
        SET
            RFID = :rfid,
            id_registration = '2'    
        WHERE
            GID = :GIDfetch;
            ";
    
        $stmt = $pdo->prepare($query);
        
        $stmt->bindParam(":rfid", $rfid);
        $stmt->bindParam(":GIDfetch", $GIDfetch);
          
        $stmt->execute();

        echo "
            <div class='alert alert-success alert-dismissible fade show pt-2 pb-2' style='bottom: 45px;' role='alert'>
                SUCCESSFUL ID REGISTRATION FOR $GIDfetch!
                    <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>       
            ";
        
        $pdo = null;
        $stmt = null;
       
        //header('location: ../idregistration.php');

        die();        

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
        
    }

}
else {
    header("Location: ../idregistration.php");
}


