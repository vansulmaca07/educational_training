<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $bar_code = ($_POST["bar_code"]);
    $GIDfetch  = ($_POST["GID_register"]);
    
    try {
        require_once "dbh2.inc.php";

       
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);

        //Check for Duplicate
        $query_check = "SELECT bar_code FROM users
            where bar_code = :bar_code
        ";

        $stmt_check = $pdo->prepare($query_check);
        $stmt_check->bindParam(":bar_code", $bar_code);
        $stmt_check->execute();

        $exist = $stmt_check->rowCount();
        if ($exist >= 1) {
            echo "
            <div class='alert alert-danger alert-dismissible fade show pt-2 pb-2' style='bottom: 45px;' role='alert'>
                重複です!
                    <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>       
            ";
            die();
        }        

        //Update bar code

        $query ="UPDATE users
                        
        SET
            bar_code = :bar_code    
        WHERE
            GID = :GIDfetch;";
    
        $stmt = $pdo->prepare($query);
        
        $stmt->bindParam(":bar_code", $bar_code);
        $stmt->bindParam(":GIDfetch", $GIDfetch);
        $stmt->execute();

        echo "
             <div class='alert alert-success alert-dismissible fade show pt-2 pb-2' style='bottom: 45px;' role='alert'>
            BAR CODE REGISTRATION SUCCESS FOR $GIDfetch
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