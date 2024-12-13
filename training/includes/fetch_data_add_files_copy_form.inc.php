<?php

session_start();
include('dbh2.inc.php');

$group_ = $_SESSION["group_id"]; 
$training_id = $_SESSION["training_id"];

    $query_materials = "SELECT 
                file_id, 
                file_name, 
                file_ext, 
                training_id, 
                active_status, 
                file_path, 
                file_path_main_directory, 
                main_directory_id, 
                main_storage_directory 
            FROM 
                file_Storage
	        INNER JOIN
		        file_storage_main ON file_storage_main.main_directory_id = file_storage.file_path_main_directory
	        WHERE
                training_id = :training_id
            AND
                active_status = 1";
                                        
    $stmt_materials = $pdo->prepare($query_materials);
    $stmt_materials->bindParam(":training_id", $training_id);
    $stmt_materials->execute();

    $result_materials = $stmt_materials->fetchAll();

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
                            
        $full_path = $main_directory .  $file_path . $file_name . "." . $file_ext;
                            
        $output .= "<tr>
                <td style='width:10.2%;'>";

                $index = $index +1;
                $output .= $index . "</td>";
                $output .= "<td style='width:66%;'>$materials[file_name].$materials[file_ext]</td>
                    <td style='width:12.8%;'><a href = 'download.php?file_id=$file_id' class='btn btn-primary' style ='vertical-align:middle;'><i style='vertical-align: middle;' class='bi bi-download'></i></a></td>         
                    <td><input type='checkbox' class = 'form-check-input' style=' font-size:20px;' checked value='$materials[file_id]' name='file_id[]'</td>
                    </tr>";                       
    }

    $_SESSION["test"] = 'test';
    echo $output;

    
   
