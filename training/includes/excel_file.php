<?php

session_start();
include('dbh2.inc.php');

$group_ = $_SESSION["group_id"];
$department = $_SESSION["department"]; 

try {

    //Main Query
    $query = "SELECT DISTINCT training_form.training_id, training_name, status_name, creator, 
                term, name_, category, usage_id, date_created, training_form.status_id, pdf_file_name, confirmation_date
        FROM 
            training_form 
        INNER JOIN 
            status_ref ON training_form.status_id = status_ref.status_id
        INNER JOIN 
            users ON training_form.creator = users.GID
        INNER JOIN
            group_ ON group_.group_id = users.group_id
	    INNER JOIN 
            category ON training_form.training_id = category.training_id
        WHERE 
            condition_ ='1'
            ";

    //if group filter is set
    if(isset($_SESSION["group_main_filter"]))
    {   
        $group_filter = $_SESSION["group_main_filter"];
        $group_main_filter_trimmed = array_map('trim',$group_filter);
        $group_main_filter = implode("','",$group_main_filter_trimmed);
        $query .= "AND group_.group_id IN('".$group_main_filter."')";
    }

    else {
        //continue main query
    }

    //if department filter is set
    if(isset($_SESSION["department_main_filter"]))
    {   
        $department_filter = $_SESSION["department_main_filter"];   
        $department_main_filter_trimmed = array_map('trim',$department_filter);
        $department_main_filter = implode("','",$department_main_filter_trimmed);
        $query .= "AND users.department_id IN('".$department_main_filter."')";
    }

    else {
        //continue main query
    }

    //if date range is set
    
    if(isset($_SESSION["end_date_filter"]) AND isset($_SESSION["start_date_filter"])) {
        if((($_SESSION["end_date_filter"]) !== "") AND ($_SESSION["start_date_filter"] !== "")) {
            $start_date = $_SESSION["start_date_filter"];
            $end_date = $_SESSION["end_date_filter"];
            $query .= "AND
                            '$start_date' < date_created
                        AND
                            date_created < '$end_date'
                ";    
        }
    }

    else {
        //continue main query
    }
  
    //if term filter is set
    if(isset($_SESSION["term_filter"]))
    {   
       $term_trimmed = array_map('trim',$_SESSION["term_filter"]);
       $term_filter = implode("','",$term_trimmed);
       $query .= "AND term IN('".$term_filter."')";
    }

    else {
        //continue main query
    }

    //if training id filter is set
    if(isset($_SESSION["training_id_filter"]))
    {   
        $training_id_search = $_SESSION['training_id_filter'];
        $query .= "AND training_form.training_id LIKE ('%$training_id_search%')
        ";
    }

    else {
        //continue main query
    }

    //if file name filter is set
    if(isset($_SESSION["training_name_filter"]))
    {   
        $training_name = $_SESSION['training_name_filter'];
        $query .= "AND pdf_file_name LIKE ('%$training_name%')
        ";
    }

    else {
        //continue main query
    }

    //if category filter is set
    if(isset($_SESSION["category_filter"]))
    {   
       $category_trimmed = array_map('trim',$_SESSION["category_filter"]);
       $category_filter = implode("','",$category_trimmed);
       $query .= "AND category.category_id IN('".$category_filter."')";
    }
    
    else {
        //continue main query
    }

    //if status filter is set
    if(isset($_SESSION["status_filter"]))
    {   
       $status_trimmed = array_map('trim',$_SESSION["status_filter"]);
       $status_filter = implode("','",$status_trimmed);
       $query .= "AND training_form.status_id IN('".$status_filter."')";
    }

    else {
        //continue main query
    }

    $query .= "ORDER BY training_form.date_created DESC";

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $total_row = $stmt->rowCount();
    $output = '';

    $output = "<table style='width:100%;' border=1>
        <thead>
            <th>期</th>
            <th>No</th>
            <th>ファイル</th>
            <th>区分</th>
            <th>全体状態</th>
            <th>日勤者</th>
            <th>A班者</th>
            <th>B班者</th>
            <th>C班者</th>
            <th>未受講</th>
        </thead>
        <tbody>
        ";

    if($total_row > 0)
        {
            foreach($result as $row)
            {   
                /***Incomplete trainee list ***/
    
                $column1 = "";
                $column2 = "";
                $column3 = "";
                $column4 = "";
                $column5 = "";
                
                // Day Shift
                $query_inc = "SELECT * FROM attendance
                    INNER JOIN
                        users ON users.GID = attendance.GIDh
                    WHERE
                        training_id = :training_id
                    AND 
                        shift_id = '5'
                    AND
                        sign_progress = 1
                        ";
                $stmt_inc = $pdo->prepare($query_inc);
                $stmt_inc->bindParam(":training_id", $row["training_id"]);
                $stmt_inc->execute();
             
                $result_inc = $stmt_inc->fetchAll();
                $count_regular = $stmt_inc->rowCount();

                if($count_regular >= 1) {                
                    foreach($result_inc as $row_inc) {
                        $column1 .= $row_inc["name_"] . "<br>";
                    }
                } 
                else {
                }
    
                // A Shift
    
                $query_inc = "SELECT * FROM attendance
                INNER JOIN
                    users ON users.GID = attendance.GIDh
                WHERE
                    training_id = :training_id
                AND 
                    shift_id = '1'
                AND
                    sign_progress = 1
                    ";
                
                $stmt_inc = $pdo->prepare($query_inc);
                $stmt_inc->bindParam(":training_id", $row["training_id"]);
                $stmt_inc->execute();
            
                $result_inc = $stmt_inc->fetchAll();
                $count_a = $stmt_inc->rowCount();
            
                if($count_a >= 1) {
                   
                    foreach($result_inc as $row_inc) {
                        $column2 .= $row_inc["name_"] . "<br>";
                    }
                } 
            
                else {
            
                }

                // B Shift

                $query_inc = "SELECT * FROM attendance
                INNER JOIN
                    users ON users.GID = attendance.GIDh
                WHERE
                    training_id = :training_id
                AND 
                    shift_id = '2'
                AND
                    sign_progress = 1
                    ";
                
                $stmt_inc = $pdo->prepare($query_inc);
                $stmt_inc->bindParam(":training_id", $row["training_id"]);
                $stmt_inc->execute();
            
                $result_inc = $stmt_inc->fetchAll();
                $count_b = $stmt_inc->rowCount();
            
                if($count_b >= 1) {
                    foreach($result_inc as $row_inc) {
                        $column3 .= $row_inc["name_"] . "<br>";
                    }
                } 
            
                else {
            
                }

                 //C Shift

                $query_inc = "SELECT * FROM attendance
                INNER JOIN
                    users ON users.GID = attendance.GIDh
                WHERE
                    training_id = :training_id
                AND 
                    shift_id = '3'
                AND
                    sign_progress = 1
                    ";
                
                $stmt_inc = $pdo->prepare($query_inc);
                $stmt_inc->bindParam(":training_id", $row["training_id"]);
                $stmt_inc->execute();
            
                $result_inc = $stmt_inc->fetchAll();
                $count_c = $stmt_inc->rowCount();
            
                if($count_c >= 1) {
                    foreach($result_inc as $row_inc) {
                        $column4 .= $row_inc["name_"] . "<br>";
                    }
                } 
            
                else {
                    //continue
                }

                //Absent Trainees
                
                $query_inc = "SELECT * FROM attendance
                    WHERE
                        training_id = :training_id
                    AND
                        attendance = '2'
                    ";
                
                $stmt_inc = $pdo->prepare($query_inc);
                $stmt_inc->bindParam(":training_id", $row["training_id"]);
                $stmt_inc->execute();
            
                $result_inc = $stmt_inc->fetchAll();
                $count_absent = $stmt_inc->rowCount();

                $absent_total = "";
                if($count_absent >= 1) {

                    $absent_total = "(未受講: $count_absent)";
                    foreach($result_inc as $row_inc) {
                         $column5 .= $row_inc["name_"] . "<br>";
                    }
                } 
             
                else {
                    //continue
                }
                
                /*****/

                $query_files =  "SELECT * FROM file_storage
                where training_id = '$row[training_id]'";
            
                $stmt2 = $pdo->prepare($query_files);
                $stmt2->execute();
                $result2 = $stmt2->fetchAll();
                $file_name = '';
                $file_path = '';
    
                $query_category = "SELECT category.category_id, category_name FROM category
                inner join category_ref on category_ref.category_id = category.category_id
                where training_id = '$row[training_id]'";
    
                $stmt3 = $pdo->prepare($query_category);
                $stmt3->execute();
                $result3 = $stmt3->fetchAll();
                
                $date_now = date("Y-m-d h:i:sa");

                $output .= 
                "<tr value='$row[training_id]' class='' 
                
                ";

                switch($row["status_id"]) {
                    case("2"):
                        $output .= " style='background-color:lightgray; white-space: nowrap;'";
                        break;
                    case($row["confirmation_date"] < $date_now):
                        $output .=  " style='background-color:lightpink; white-space: nowrap;'";
                        break;
            
                }
                     
                $output .="    >
                        <td style='vertical-align: middle; width: 5.1%;'>" . $row["term"] .  "</td>
                        <td style='vertical-align: middle; width: 8.1%;'>
                            $row[training_id]
                        </td>  
                        <td style='vertical-align: middle; width: 40.6%; word-break: break-all'>" . $row["pdf_file_name"] .  "</td>
                        <td style='vertical-align: middle; width: 10.2%; word-break: break-all'>  
                    "; 

                        foreach($result3 as $row_file) {            
                            $output .= "$row_file[category_name]<br>";
                                }
                
                $output .= "</td> 

                            ";
                $output .= "<td>$row[status_name]" . $absent_total . "</td>";

                //output for incomplete trainees day shift
                $output .= "<td class='block' style='height=40px;white-space: nowrap;'>" . $column1 . "</td>" ;
                //output for incomplete trainees A shift
                $output .= "<td class='block' style='height=40px;white-space: nowrap;'>" . $column2 . "</td>" ;
                //output for incomplete trainees B shift
                $output .= "<td class='block' style='height=40px;white-space: nowrap;'>" . $column3 . "</td>" ;
                //output for incomplete trainees C shift
                $output .= "<td class='block' style='height=40px;white-space: nowrap;'>" . $column4 . "</td>" ;
                //output for Absentees
                $output .= "<td class='block' style='height=40px;white-space: nowrap;'>" . $column5 . "</td>" ;

                $output .= "                      
                    </tr>";
            }
    
        }
        else {
                $output = '<h3>No Data Found </h3>';
        }

    $output .= "</tbody>
    </table>";

   //print_r($output);


} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
} 

  //echo $output;   
    
    header('Content-Type: application/xls');
    header('Content-Disposition: attachment; filename=進捗.xls');
    echo $output;
