<?php

session_start();

include("dbh2.inc.php");

if($_SERVER["REQUEST_METHOD"] === "POST") {

    //Reset Password Table 

    if(isset($_POST["reset_password_GID"])) {

        $query = "SELECT GID, name_ from users 
            WHERE
                GID = :GID
                ";
                
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":GID", $_POST["reset_password_GID"]);
        $stmt->execute();

        $result = $stmt->fetchAll();

        $output = "";
        foreach($result as $row) {
            $output .= "<tr>
                            <td>$row[GID]</td>
                            <td>$row[name_]</td>
                    </tr>
            ";
        }

        echo $output;

        $pdo =null;
        $stmt = null;

        exit();

    }

    //Reset Password 

    if(isset($_POST["GID_reset"])) {

        $GID = $_POST["GID_reset"];

        $query = "UPDATE users
            SET
                pwd = GID
            WHERE
                GID = :GID
        
        ";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":GID", $GID);
        $stmt->execute();

        $output = "
        <div class='alert alert-success alert-dismissible fade show pt-2 pb-2' style='bottom: 45px;' role='alert'>
            RESET PASSWORD SUCCESS FOR $GID
                <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>       
        ";

        echo $output;

        $pdo = null;
        $stmt = null;

        exit();
    }

}