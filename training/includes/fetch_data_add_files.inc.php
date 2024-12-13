<?php

session_start();
include('dbh2.inc.php');
include('edit_form_test.inc.php');
$group_ = $_SESSION["group_id"]; 
$training_id = $_SESSION["training_id"];

//$training_id = $_GET["training_id"];

   

    

    $query_materials = "SELECT 
                file_id, 
                file_name, 
                file_ext, 
                file_storage.training_id, 
                active_status, 
                file_path, 
                file_path_main_directory, 
                main_directory_id, 
                main_storage_directory,
                group_id
            FROM 
                file_Storage
	        INNER JOIN
		        file_storage_main ON file_storage_main.main_directory_id = file_storage.file_path_main_directory
            INNER JOIN
                training_form ON training_form.training_id = file_storage.training_id
            INNER JOIN
                users ON training_form.creator = users.GID
	        WHERE
                file_storage.training_id = :training_id
            AND
                active_status = 1";
                                        
    $stmt_materials = $pdo->prepare($query_materials);
    $stmt_materials->bindParam(":training_id", $training_id);
    $stmt_materials->execute();

    $result_materials = $stmt_materials->fetchAll();
    $result_materials_row = $stmt_materials->rowCount();

    $index = 0;

    $output = '';
               
    foreach ($result_materials as $materials) {
  
        $main_directory = $materials["main_storage_directory"];
        $file_path = $materials["file_path"];
        $file_name = $materials["file_name"];
        $file_ext = $materials["file_ext"];
        $file_id = $materials["file_id"];                        
        $ip_add = $_SERVER['HTTP_HOST'];
        $http = "http://";
        $group_creator = $materials["group_id"];

        $button_status = "";

        if($group_creator !== $group_) {
            $button_status = "disabled";
        }
        else {
            $button_status = "";
        }
                            
        $full_path = $main_directory .  $file_path . $file_name . "." . $file_ext;
                            
        $output .= "<tr>
                <td style='width:10.2%;'>";

                $index = $index +1;
                $output .= $index . "</td>";
                $output .= "<td style='width:66%;'>$materials[file_name].$materials[file_ext]</td>
                    <td style='width:12.8%;'><a href = 'download.php?file_id=$file_id' class='btn btn-primary' style ='vertical-align:middle;'><i style='vertical-align: middle;' class='bi bi-download'></i></a></td>         
                    <td><button type ='button' value='$materials[file_id]' class ='btn btn-danger delete_file' $button_status>削除<i class='bi bi-x-circle'></i></button></td>
                    </tr>";
                                
    }

    $_SESSION["test"] = 'test';
    $_SESSION["file_count"] = $index;

    if($result_materials_row !== 0) {
        echo $output;
    }

    else {
        echo "No Data Found";
    }
    
   
