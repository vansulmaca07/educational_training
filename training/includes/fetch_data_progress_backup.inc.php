<?php

date_default_timezone_set("Japan");

session_start();
include('dbh2.inc.php');

$group_ = $_SESSION["group_id"];
$department = $_SESSION["department"]; 

if(isset($_POST["action"])) {

    $query = "SELECT DISTINCT training_form.training_id, training_name, status_name, creator, term, name_, category, usage_id, date_created, training_form.status_id, pdf_file_name, confirmation_date
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

    if(isset($_POST["department_main_filter"]))
    {      
        $department_main_filter_trimmed = array_map('trim',$_POST["department_main_filter"]);
        $department_main_filter = implode("','",$department_main_filter_trimmed);
        $query .= "AND training_form.creation_department IN('".$department_main_filter."')";
        $_SESSION["department_main_filter"] =   $department_main_filter_trimmed; //set session filter for main department
    }
    /*
    else {
        $query .= "AND training_form.creation_department IN ('".$department."')";
    } */ 
    
    if(isset($_POST["group"]))
    {   
        $group_main_filter_trimmed = array_map('trim',$_POST["group"]);
        $group_main_filter = implode("','",$group_main_filter_trimmed);
        $query .= "AND group_.group_id IN('".$group_main_filter."')";
        $_SESSION["group_main_filter"] =   $group_main_filter_trimmed; //set session filter for main department
    }

    if(isset($_POST["category_main_filter"]))
    {   
        $category_main_filter_trimmed = array_map('trim',$_POST["category_main_filter"]);
        $category_main_filter = implode("','",$category_main_filter_trimmed);
        $query .= "AND category.category_id IN('".$category_main_filter."')";
        $_SESSION["category_main_filter"] = $category_main_filter_trimmed; //set session filter for category
    }

    if(isset($_POST["term_main_filter"]))
    {   
        $term_main_filter_trimmed = array_map('trim',$_POST["term_main_filter"]);
        $term_main_filter = implode("','",$term_main_filter_trimmed);
        $query .= "AND term IN('".$term_main_filter."')";
        $_SESSION["term_main_filter"] = $term_main_filter_trimmed; //set session filter for term 
    }

    if(isset($_POST["training_name_main_filter"]))
    {
        $training_name_main_filter = $_POST['training_name_main_filter'];
        $query .= "AND training_name LIKE ('%$training_name_main_filter%')";

        $_SESSION["training_name_main_filter"] = $training_name_main_filter;
    }

    if(isset($_POST["training_id_main_filter"]))
    {
        $training_id_main_filter = $_POST['training_id_main_filter'];
        $query .= "AND training_form.training_id LIKE ('%$training_id_main_filter%')
        ";
        $_SESSION["training_id_main_filter"] = $training_id_main_filter;
    }

    if(isset($_POST["training_creator_main_filter"]))
    {
        $training_creator_main_filter = $_POST['training_creator_main_filter'];
        $query .= "AND name_ LIKE ('%$training_creator_main_filter%')
        ";

        $_SESSION["training_creator_main_filter"] = $training_creator_main_filter;
    }
 
    //Search Query

    if(isset($_POST["training_name"]))
    {   
        $training_name = $_POST['training_name'];
        $query .= "AND pdf_file_name LIKE ('%$training_name%')
        ";

        $_SESSION["training_name_filter"] = $training_name;
    }

    if(isset($_POST["training_creator"]))
    {   
        $training_creator = $_POST['training_creator'];
        $query .= "AND name_ LIKE ('%$training_creator%')
        ";

        $_SESSION["training_creator_filter"] = $training_creator;

    }

    if(isset($_POST["training_id_search"]))
    {   
        $training_id_search = $_POST['training_id_search'];
        $query .= "AND training_form.training_id LIKE ('%$training_id_search%')
        ";
        
        $_SESSION["training_id_filter"] = $training_id_search;
    }

    if(isset($_POST["category"]))
    {   
       $category_trimmed = array_map('trim',$_POST["category"]);
       $category_filter = implode("','",$category_trimmed);
       $query .= "AND category.category_id IN('".$category_filter."')";

       $_SESSION["category_filter"] = $category_trimmed;
    }

    if(isset($_POST["term"]))
    {   
       $term_trimmed = array_map('trim',$_POST["term"]);
       $term_filter = implode("','",$term_trimmed);
       $query .= "AND term IN('".$term_filter."')";

       $_SESSION["term_filter"] = $term_trimmed;
    }

    if(isset($_POST["status"]))
    {   
       $status_trimmed = array_map('trim',$_POST["status"]);
       $status_filter = implode("','",$status_trimmed);
       $query .= "AND training_form.status_id IN('".$status_filter."')";

       $_SESSION["status_filter"] = $status_trimmed;
    }

    $query .= "ORDER BY training_form.date_created DESC";

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $total_row = $stmt->rowCount();
    $output = '';
    if($total_row > 0)
    {
        foreach($result as $row)
        {   

            /***Incomplete trainee list ***/

            $column1 = "";
            $column2 = "";
            $column3 = "";
            $column4 = "";
        
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
         
                $column1 = "<b>日勤者:&nbsp;" . $count_regular . "</b><br>";
            
                foreach($result_inc as $row_inc) {
                    $column1 .= $row_inc["name_"] . "<br>";
                }
            } 
        
            else {
        
            }

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
            $count_b = $stmt_inc->rowCount();
        
            if($count_b >= 1) {
        
                $column2 = "<b>A班:&nbsp;" . $count_b . "</b><br>";
            
                foreach($result_inc as $row_inc) {
                    $column2 .= $row_inc["name_"] . "<br>";
                }
            } 
        
            else {
        
            }

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
        
                $column3 = "<b>B班:&nbsp;" . $count_b . "</b><br>";
            
                foreach($result_inc as $row_inc) {
                    $column3 .= $row_inc["name_"] . "<br>";
                }
            } 
        
            else {
        
            }

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
        
                $column4 = "<b>C班:&nbsp;" . $count_c . "</b><br>";
            
                foreach($result_inc as $row_inc) {
                    $column4 .= $row_inc["name_"] . "<br>";
                }
            } 
        
            else {
        
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
                        $output .= " style='background-color:lightgray;'";
                        break;
                    case($row["confirmation_date"] < $date_now):
                        $output .=  " style='background-color:lightpink;'";
                        break;
            
                }
                      
            $output .="    >
                    <td style='vertical-align: middle; width: 5.1%;'>" . $row["term"] .  "</td>
                    <td style='vertical-align: middle; width: 8.1%;'>
                        <a href = 'editform_test.php?training_id=$row[training_id]' class='btn-link'>$row[training_id]</a>
                    </td>
                    <td style='vertical-align: middle; font-size:20px; width:5.1%;'><a href = 'pdf_preview.php?training_id=$row[training_id]' target='_blank'
                
                    value='$row[training_id]'
                
               
                    
                    ><i class='bi bi-file-pdf'></i></a></button>
                    </td>
                    
                    <td style='vertical-align: middle; width: 40.6%; word-break: break-all'>" . $row["pdf_file_name"] .  "</td>
                    <td style='vertical-align: middle; width: 10.2%; word-break: break-all'>  
                "; 

                    foreach($result3 as $row_file) {            
                        $output .= "$row_file[category_name]<br>";
                            }
            
            $output .= "</td> 

                          ";

            if($row["status_id"] === "1") {
                
                    $output .= " <td class = 'status_p' style='vertical-align: middle; width:7.1%;' >" . $row["status_name"] . "</td>

                    <td class style='vertical-align: middle;width:12.1%;'>

                  <div style='height:70px; overflow: auto; align-items:center;'>
                                " .  $column1 . $column2 . $column3 . $column4 . "
                            </div> 
                    </td>
            
            ";
            
            }

            else {

                $output .= " <td class = 'status_p' style='vertical-align: middle; width:19.1%;' >" . $row["status_name"] . "</td>
                       
            ";

            }

            $output .="
                    <td style='vertical-align: middle; width:14.1% ;'>
                        <form action='includes/document_number.inc.php' method ='POST'>
                            <input type='text' hidden value='$row[training_id]' name='document_number'>             
                            <button type='submit' class='btn btn-primary'  data-bs-toggle='popover' value='$row[training_id]'
                            ><span>サイン</span></button>         
                        </form>
                    </td>
                </div>
            </tr>";
            

           
            
         
        }
    
    }
    else {
        $output = '<h3>No Data Found </h3>';
    }

    echo $output;
   
}


