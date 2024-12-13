<?php  
//fetch.php  
//Fetch data for popover window on incomplete trainees


include('includes/dbh2.inc.php');

    $column1 = "";
    $column2 = "";
    $column3 = "";
    $column4 = "";

    if($_POST["shift"] === "5") {
       
        $query = "SELECT * FROM attendance
        INNER JOIN
            users ON users.GID = attendance.GIDh
        WHERE
            training_id = :training_id
        AND 
            shift_id = '5'
        AND
            sign_progress = 1
        LIMIT 20    
            ";
    
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":training_id", $_POST["id"]);
        $stmt->execute();

        $result = $stmt->fetchAll();
        $count_a = $stmt->rowCount();

        $column1 = "
        <div class= 'row text-center form-inline' style='position:relative;'>
            <b>日勤者</b> 
        </div>
        <div class='row'>
                        ";

        if($count_a >= 1) {

            $column1 .= "    
                    <div class='col'>           
            ";

            $column1 .= "<table style='overflow-auto' >  
                            ";
        
            foreach($result as $row) {
                $column1 .= "<tr><td>$row[name_]</td></tr>";
            }

            $column1 .= "</table>
                    </div>";
        } 

        else {

        }

        $query_b = "SELECT * FROM attendance
        INNER JOIN
            users ON users.GID = attendance.GIDh
        WHERE
            training_id = :training_id
        AND 
            shift_id = '5'
        AND
            sign_progress = 1
        LIMIT 20, 20    
            ";

        $stmt_b = $pdo->prepare($query_b);
        $stmt_b->bindParam(":training_id", $_POST["id"]);
        $stmt_b->execute();

        $result_b = $stmt_b->fetchAll();
        $count_b = $stmt_b->rowCount();

     
        if($count_b >= 1) {
            $column1 .= "    
                    <div class='col''>
            ";

            $column1 .= "<table style='overflow-auto' >  
                            ";

            foreach($result_b as $row) {
                $column1 .= "<tr><td>$row[name_]</td></tr>";
            }

            $column1 .= "</table>
                    </div>";
        }

        $query_c = "SELECT * FROM attendance
        INNER JOIN
            users ON users.GID = attendance.GIDh
        WHERE
            training_id = :training_id
        AND 
            shift_id = '5'
        AND
            sign_progress = 1
        LIMIT 40, 20    
            ";

        $stmt_c = $pdo->prepare($query_c);
        $stmt_c->bindParam(":training_id", $_POST["id"]);
        $stmt_c->execute();

        $result_c = $stmt_c->fetchAll();
        $count_c = $stmt_c->rowCount();

     
        if($count_c >= 1) {
            $column1 .= "    
                    <div class='col''>
            ";

            $column1 .= "<table style='overflow-auto' >  
                            ";

            foreach($result_c as $row) {
                $column1 .= "<tr><td>$row[name_]</td></tr>";
            }

            $column1 .= "</table>
                    </div>";
        }

        $column1 .= "</div>";

        echo $column1; 

    }

    if($_POST["shift"] === "1") {
        
        $query = "SELECT * FROM attendance
        INNER JOIN
            users ON users.GID = attendance.GIDh
        WHERE
            training_id = :training_id
        AND 
            shift_id = '1'
        AND
            sign_progress = 1
        LIMIT 20    
            ";
    
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":training_id", $_POST["id"]);
        $stmt->execute();

        $result = $stmt->fetchAll();
        $count_a = $stmt->rowCount();

        $column1 = "
        
        <div class= 'row text-center'>
            <caption><b>A班者</b></caption>
        </div>
        <div class='row'>
                        ";

        if($count_a >= 1) {

            $column1 .= "    
                    <div class='col text-center'>
                        
            ";

            $column1 .= "<table style='overflow-auto' >  
                            ";
        
            foreach($result as $row) {
                $column1 .= "<tr><td class='text-center'>$row[name_]</td></tr>";
            }

            $column1 .= "</table>
                    </div>";
        } 

        else {

        }

        $query_b = "SELECT * FROM attendance
        INNER JOIN
            users ON users.GID = attendance.GIDh
        WHERE
            training_id = :training_id
        AND 
            shift_id = '1'
        AND
            sign_progress = 1
        LIMIT 20, 20    
            ";

        $stmt_b = $pdo->prepare($query_b);
        $stmt_b->bindParam(":training_id", $_POST["id"]);
        $stmt_b->execute();

        $result_b = $stmt_b->fetchAll();
        $count_b = $stmt_b->rowCount();

     
        if($count_b >= 1) {
            $column1 .= "    
                    <div class='col''>
            ";

            $column1 .= "<table style='overflow-auto' >  
                            ";

            foreach($result_b as $row) {
                $column1 .= "<tr><td>$row[name_]</td></tr>";
            }

            $column1 .= "</table>
                    </div>";
        }

        $query_c = "SELECT * FROM attendance
        INNER JOIN
            users ON users.GID = attendance.GIDh
        WHERE
            training_id = :training_id
        AND 
            shift_id = '1'
        AND
            sign_progress = 1
        LIMIT 40, 20    
            ";

        $stmt_c = $pdo->prepare($query_c);
        $stmt_c->bindParam(":training_id", $_POST["id"]);
        $stmt_c->execute();

        $result_c = $stmt_c->fetchAll();
        $count_c = $stmt_c->rowCount();

     
        if($count_c >= 1) {
            $column1 .= "    
                    <div class='col''>
            ";

            $column1 .= "<table style='overflow-auto' >  
                            ";

            foreach($result_c as $row) {
                $column1 .= "<tr><td>$row[name_]</td></tr>";
            }

            $column1 .= "</table>
                    </div>";
        }

        $column1 .= "</div>";

        echo $column1;
    }

    if($_POST["shift"] === "2") {
       
        $query = "SELECT * FROM attendance
        INNER JOIN
            users ON users.GID = attendance.GIDh
        WHERE
            training_id = :training_id
        AND 
            shift_id = '2'
        AND
            sign_progress = 1
        LIMIT 20    
            ";
    
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":training_id", $_POST["id"]);
        $stmt->execute();

        $result = $stmt->fetchAll();
        $count_a = $stmt->rowCount();

        $column1 = "<div class='row text-center'>
                        <caption><b>B班者</b></caption>";

        if($count_a >= 1) {

            $column1 .= "    
                    <div class='col'>
                        
            ";

            $column1 .= "<table style='overflow-auto' >  
                            ";
        
            foreach($result as $row) {
                $column1 .= "<tr><td>$row[name_]</td></tr>";
            }

            $column1 .= "</table>
                    </div>";
        } 

        else {

        }

        $query_b = "SELECT * FROM attendance
        INNER JOIN
            users ON users.GID = attendance.GIDh
        WHERE
            training_id = :training_id
        AND 
            shift_id = '2'
        AND
            sign_progress = 1
        LIMIT 20, 20    
            ";

        $stmt_b = $pdo->prepare($query_b);
        $stmt_b->bindParam(":training_id", $_POST["id"]);
        $stmt_b->execute();

        $result_b = $stmt_b->fetchAll();
        $count_b = $stmt_b->rowCount();

     
        if($count_b >= 1) {
            $column1 .= "    
                    <div class='col''>
            ";

            $column1 .= "<table style='overflow-auto' >  
                            ";

            foreach($result_b as $row) {
                $column1 .= "<tr><td>$row[name_]</td></tr>";
            }

            $column1 .= "</table>
                    </div>";
        }

        $query_c = "SELECT * FROM attendance
        INNER JOIN
            users ON users.GID = attendance.GIDh
        WHERE
            training_id = :training_id
        AND 
            shift_id = '2'
        AND
            sign_progress = 1
        LIMIT 40, 20    
            ";

        $stmt_c = $pdo->prepare($query_c);
        $stmt_c->bindParam(":training_id", $_POST["id"]);
        $stmt_c->execute();

        $result_c = $stmt_c->fetchAll();
        $count_c = $stmt_c->rowCount();

     
        if($count_c >= 1) {
            $column1 .= "    
                    <div class='col''>
            ";

            $column1 .= "<table style='overflow-auto' >  
                            ";

            foreach($result_c as $row) {
                $column1 .= "<tr><td>$row[name_]</td></tr>";
            }

            $column1 .= "</table>
                    </div>";
        }

        $column1 .= "</div>";

        echo $column1;


    }

    if($_POST["shift"] === "3") {
       
        $query = "SELECT * FROM attendance
        INNER JOIN
            users ON users.GID = attendance.GIDh
        WHERE
            training_id = :training_id
        AND 
            shift_id = '3'
        AND
            sign_progress = 1
        LIMIT 20    
            ";
    
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":training_id", $_POST["id"]);
        $stmt->execute();

        $result = $stmt->fetchAll();
        $count_a = $stmt->rowCount();

        $column1 = "<div class='row text-center'>
                        <caption><b>C班者</b></caption>";

        if($count_a >= 1) {

            $column1 .= "    
                    <div class='col'>
                        
            ";

            $column1 .= "<table style='overflow-auto' >  
                            ";
        
            foreach($result as $row) {
                $column1 .= "<tr><td>$row[name_]</td></tr>";
            }

            $column1 .= "</table>
                    </div>";
        } 

        else {

        }

        $query_b = "SELECT * FROM attendance
        INNER JOIN
            users ON users.GID = attendance.GIDh
        WHERE
            training_id = :training_id
        AND 
            shift_id = '3'
        AND
            sign_progress = 1
        LIMIT 20, 20    
            ";

        $stmt_b = $pdo->prepare($query_b);
        $stmt_b->bindParam(":training_id", $_POST["id"]);
        $stmt_b->execute();

        $result_b = $stmt_b->fetchAll();
        $count_b = $stmt_b->rowCount();

     
        if($count_b >= 1) {
            $column1 .= "    
                    <div class='col''>
            ";

            $column1 .= "<table style='overflow-auto' >  
                            ";

            foreach($result_b as $row) {
                $column1 .= "<tr><td>$row[name_]</td></tr>";
            }

            $column1 .= "</table>
                    </div>";
        }

        $query_c = "SELECT * FROM attendance
        INNER JOIN
            users ON users.GID = attendance.GIDh
        WHERE
            training_id = :training_id
        AND 
            shift_id = '3'
        AND
            sign_progress = 1
        LIMIT 40, 20    
            ";

        $stmt_c = $pdo->prepare($query_c);
        $stmt_c->bindParam(":training_id", $_POST["id"]);
        $stmt_c->execute();

        $result_c = $stmt_c->fetchAll();
        $count_c = $stmt_c->rowCount();

     
        if($count_c >= 1) {
            $column1 .= "    
                    <div class='col''>
            ";

            $column1 .= "<table style='overflow-auto' >  
                            ";

            foreach($result_c as $row) {
                $column1 .= "<tr><td>$row[name_]</td></tr>";
            }

            $column1 .= "</table>
                    </div>";
        }

        $column1 .= "</div>";

        echo $column1;

    }

    if($_POST["shift"] === "absent") {
       
        $query = "SELECT * FROM attendance
        INNER JOIN
            users ON users.GID = attendance.GIDh
        WHERE
            training_id = :training_id
        AND
            attendance = '2'
        LIMIT 20    
            ";
    
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":training_id", $_POST["id"]);
        $stmt->execute();

        $result = $stmt->fetchAll();
        $count_a = $stmt->rowCount();

        $column1 = "<div class='row text-center'>
                        <caption><b>未受講</b></caption>";

        if($count_a >= 1) {

            $column1 .= "    
                    <div class='col'>
                        
            ";

            $column1 .= "<table style='overflow-auto' >  
                            ";
        
            foreach($result as $row) {
                $column1 .= "<tr><td>$row[name_]</td></tr>";
            }

            $column1 .= "</table>
                    </div>";
        } 

        else {

        }

        $query_b = "SELECT * FROM attendance
        INNER JOIN
            users ON users.GID = attendance.GIDh
        WHERE
            training_id = :training_id
        AND
            attendance = '2'
        LIMIT 20, 20    
            ";

        $stmt_b = $pdo->prepare($query_b);
        $stmt_b->bindParam(":training_id", $_POST["id"]);
        $stmt_b->execute();

        $result_b = $stmt_b->fetchAll();
        $count_b = $stmt_b->rowCount();

     
        if($count_b >= 1) {
            $column1 .= "    
                    <div class='col''>
            ";

            $column1 .= "<table style='overflow-auto' >  
                            ";

            foreach($result_b as $row) {
                $column1 .= "<tr><td>$row[name_]</td></tr>";
            }

            $column1 .= "</table>
                    </div>";
        }

        $query_c = "SELECT * FROM attendance
        INNER JOIN
            users ON users.GID = attendance.GIDh
        WHERE
            training_id = :training_id
        AND
            attendance = '2'
        LIMIT 40, 20    
            ";

        $stmt_c = $pdo->prepare($query_c);
        $stmt_c->bindParam(":training_id", $_POST["id"]);
        $stmt_c->execute();

        $result_c = $stmt_c->fetchAll();
        $count_c = $stmt_c->rowCount();

     
        if($count_c >= 1) {
            $column1 .= "    
                    <div class='col''>
            ";

            $column1 .= "<table style='overflow-auto' >  
                            ";

            foreach($result_c as $row) {
                $column1 .= "<tr><td>$row[name_]</td></tr>";
            }

            $column1 .= "</table>
                    </div>";
        }

        $column1 .= "</div>";

        echo $column1;

    }

  
/*
    $query = "SELECT * FROM attendance
        INNER JOIN
            users ON users.GID = attendance.GIDh
        WHERE
            training_id = :training_id
        AND 
            shift_id = '2'
        AND
            sign_progress = 1
            ";
    
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":training_id", $_POST["id"]);
    $stmt->execute();

    $result = $stmt->fetchAll();

    $count_b = $stmt->rowCount();

    if($count_b >= 1) {

        $column2 = "<table style='overflow-auto'>";  
        $column2 .= "<thead><th>B班者: $count_b</th></thead>";
        
        foreach($result as $row) {
    
            $column2 .= "<tr><td>$row[name_]</td></tr>";
    
        }
    
        $column2 .= "</table>";
    }

    $query = "SELECT * FROM attendance
        INNER JOIN
            users ON users.GID = attendance.GIDh
        WHERE
            training_id = :training_id
        AND 
            shift_id = '3'
        AND
            sign_progress = 1
            ";
    
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":training_id", $_POST["id"]);
    $stmt->execute();

    $result = $stmt->fetchAll();
    $count_c = $stmt->rowCount();

    if($count_c >= 1) {

        $column3 = "<table style='height:50px; overflow-y:scroll;'>";  
        $column3 .= "<thead><th>C班者: $count_c</th></thead>";
    
        foreach($result as $row) {
            $column3 .= "<tr><td>$row[name_]</td></tr>";
        }

        $column3 .= "</table>";
    } 

    else {

    }

    $query = "SELECT * FROM attendance
    INNER JOIN
        users ON users.GID = attendance.GIDh
    WHERE
        training_id = :training_id
    AND 
        shift_id = '5'
    AND
        sign_progress = 1
        ";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":training_id", $_POST["id"]);
    $stmt->execute();

    $result = $stmt->fetchAll();
    $count_d = $stmt->rowCount();

    if($count_d >= 1) {

        $column4 = "<table style='overflow-auto'>";  
        $column4 .= "<thead><th>日勤者: $count_d</th></thead>";

        foreach($result as $row) {
            $column4 .= "<tr><td>$row[name_]</td></tr>";
        }

        $column4 .= "</table>";
    } 

    else {

    }
   
    echo $column1 . $column2 . $column3 . $column4;
     */
  
 