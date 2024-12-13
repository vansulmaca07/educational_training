<?php

session_start();

include("dbh2.inc.php");

    //Show Approver Information

    $output = "";

    if(isset($_POST["GID_approver_mail"])) {
        
        $GID_approver = $_POST["GID_approver_mail"];
        //$test = $_POST["test"];

        foreach($GID_approver as $recipients) {
            $query = "SELECT * from users 
            WHERE
                GID = :GID
                ";
                
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":GID", $recipients);
            $stmt->execute();

            $result = $stmt->fetchAll();

            
            foreach($result as $row) {
                $output .= "<tr>
                                <td>$row[GID]</td>
                                <td>$row[name_]</td>
                                <td>$row[email]</td>
                        </tr>
                ";
            }

        }

    }

      

        echo $output;

        //echo "success";
        $pdo =null;
        $stmt = null;

        exit();

    
    
