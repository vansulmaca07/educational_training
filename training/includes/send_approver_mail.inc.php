<?php

session_start();
include("dbh2.inc.php");

    $output = "";

    $recipients = ($_POST["GID_approver_mail"]);
    $training_id = $_POST["approver_training_id"];
    $training_name ="";

    //Query neccessary information in the training form

    $query_all = "SELECT * FROM training_form
        WHERE
            training_id = :training_id
        ";

    $stmt_query_all = $pdo->prepare($query_all);
    $stmt_query_all->bindParam(":training_id", $training_id);
    $stmt_query_all->execute();

    $result_query_all = $stmt_query_all->fetchAll();

    foreach($result_query_all as $row) {

        $training_name = $row["training_name"];

    }

    //Send email to each of the participants

    foreach($recipients as $recipients_approver) {

        $query = "SELECT email, name_ FROM users
            WHERE
                GID = :GID
                ";
        
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":GID", $recipients_approver);
        $stmt->execute();
        $result_approver_info = $stmt->fetchAll();

        foreach($result_approver_info as $user_info) {
            $email = $user_info["email"];
            $name_ = $user_info["name_"];

            $subject = "教育訓練の確認をお願いします";
            $from = "From: training-record@jty.yuden.co.jp" . "\r\n";

            $message ="
            <html> 
                <body> 
                    <p style=\"height:300px;background-color:#abc;border:1px solid #456;border-radius:3px;padding:10px;\">
                        差出人: $_SESSION[name_]<br>
                        <br>
                        $user_info[name_] さん<br>
                        <br>
                        教育訓練の確認をお願いします。 <br>
                        
                        <br>    
                        $training_id <br>
                        $training_name <br>
                        <br>
                        <b>[URL]</b><br>
                        <a href='http://172.31.13.112/training/loginpage.php'>http://172.31.13.112/training/loginpage.php</a>
                    </p>
                   
                </body>
            </html>";
    
            $body = $message;
            $from .= "Content-type: text/html\r\n";
    
            (mail($email, $subject, $body, $from)); 

        }

        echo "  <div class='alert alert-success alert-dismissible fade show pt-2 pb-2' role='alert'>
            メール送信は成功しました!
            <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>  ";
    
    }

    /*
    $query = "SELECT * from attendance
        INNER JOIN
            users ON users.GID = attendance.GIDh
        WHERE
            training_id = :training_id
        AND
            attendance = '1'
        AND
            sign_progress = '1'            
            ";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":training_id", $training_id);
    $stmt->execute();

    $result = $stmt->fetchAll();

    $recipients = $_POST["recipients"];

            $email = $row["email"];
            $subject = "教育訓練の実施をお願いします";
            $from = "From: training-record@jty.yuden.co.jp" . "\r\n";
    

            $message ="
            <html> 
              <body> 
                <p style=\"height:300px;background-color:#abc;border:1px solid #456;border-radius:3px;padding:10px;\">
                    差出人: $_SESSION[name_]<br>
                    <br>
                    $row[name_] さん<br>
                    <br>
                    教育訓練の実施をお願いします。 <br>
                    資料確認後、サインをお願いします。<br>
                    <br>    
                    $training_id <br>
                    $training_name <br>
                    <br>
                    <b>[URL]</b><br>
                    <a href='http://172.31.12.101/training_test/loginpage.php'>http://172.31.12.101/training_test/loginpage.php</a>
                </p>
                <br/><br/>HTML FORMAT
                
              </body>
            </html>";
    
            $body = $message;
            $from .= "Content-type: text/html\r\n";
    
            (mail($email, $subject, $body, $from)); 
    
    */



