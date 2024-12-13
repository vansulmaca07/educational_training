<?php 
include_once('dbh2.inc.php');

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $file = $_FILES['file'];
    $file_name = $_FILES['file']['name'];
    $file_tmp_name = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_error = $_FILES['file']['error'];
    $file_type = $_FILES['file']['type'];
    
/* 
 //   $file_ext = explode('.', $file_name);
 //   $file_actual_Ext = strtolower(end($file_ext));
        
    //    $allowed = array('jpg','jpeg','png','pdf');
        
      //  if(in_array($file_actual_Ext, $allowed)) {
        //    if($file_error === 0) {
          //      if($file_size < 1000000000) {
                  //  $file_name_new = uniqid('',true).".".$file_actual_Ext;                   
                  //  $file_destination = '../uploads/'.$file_name_new;
                  //  move_uploaded_file($file_tmp_name, $file_destination);

                    include_once('dbh2.inc.php');

                    $query = "INSERT INTO file_storage (
                        file_name,
                        file_size,
                        file_type
                        )
                        VALUES (
                            :file_name, 
                            :file_size, 
                            :file_type
                        ) 
                    ";

                    $stmt=$pdo->prepare($query);

                    foreach ($file_name as $key => $value) {

                    $file_ext = explode('.', $file_name[$key]);
                    $file_actual_Ext = strtolower(end($file_ext));
                     
                    $file_name_new = uniqid('',true).".".$file_actual_Ext;                   
                    $file_destination = '../uploads/'.$file_name_new;

                    $stmt->bindParam(":file_name", $file_name_new);
                    $stmt->bindParam(":file_size", $file_size[$key]);
                    $stmt->bindParam(":file_type", $file_type[$key]);

                    $stmt->execute();

                    move_uploaded_file($file_tmp_name[$key], $file_destination);

                    }
                    
                    header('Location: ../test.php');
                    
                }
               else {
                    echo "Your file was too big!";
                }

            }

            else {
                echo "There was an error uploading your file!";
            }
        }

       // else {
            echo "You cannot upload files of this type!";
     //   }
        
   // }
   */
    
   
    $allowed = array('jpg','jpeg','png','pdf','xlsx','docs','xls','docx','ppt','csv');
    $file_name_checking = $_FILES['file']['name'];
    $file_size_checking = $_FILES['file']['size'];

    $file_name_check_actual_ext = array();

    foreach ($file_name_checking as $extension_files) {

        $extension_actual = explode('.', $extension_files);
        $file_actual_Ext = strtolower(end($extension_actual));
        $file_name_check_actual_ext[] = $file_actual_Ext;
        
    }

    $file_name_check_ext = '';
    $file_name_check_ext = !array_diff($file_name_check_actual_ext, $allowed);
 
    if($file_name_check_ext === true) {
        if(max($file_size_checking) < 10000000000) {
            
            foreach ($_FILES['file']['tmp_name'] as $key => $value) {
                $file_name = $_FILES['file']['name'][$key];
                $file_tmp_name = $_FILES['file']['tmp_name'][$key];
                $file_size = $_FILES['file']['size'][$key];
                $file_error = $_FILES['file']['error'][$key];
                $file_type = $_FILES['file']['type'][$key];

                $file_ext = explode('.', $file_name);
                $file_name_original = pathinfo($file_name, PATHINFO_FILENAME);
                $file_actual_Ext = strtolower(end($file_ext));
                
                $file_name_new = $file_name_orignal.".".$file_actual_Ext; 

                $file_destination = 'uploads/'.$file_name_new;

                $result = move_uploaded_file($file_tmp_name, $file_destination);

                $query = "INSERT INTO file_storage (
                    file_name,
                    file_size,
                    file_type,
                    file_ext,
                    )
                    VALUES (
                        :file_name, 
                        :file_size, 
                        :file_type,
                        :file_ext
                    ) 
                ";

                $stmt=$pdo->prepare($query);
                $stmt->bindParam(":file_name", $file_name_original);
                $stmt->bindParam(":file_size", $file_size);
                $stmt->bindParam(":file_type", $file_type);
                $stmt->bindParam(":file_ext", $file_actual_Ext);

                $stmt->execute();

            }

            if ($result) {
                echo "Files uploaded successfully!";
        
            }
        }

        else {
            echo "File Size is too large!";
        }
    
    }

    else {
        echo "Please check the exension of files";
    }
        
 
}