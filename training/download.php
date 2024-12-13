<?php
   include('includes/dbh2.inc.php');
   if(isset($_GET["file_id"])) {    //Get the File ID 
   $file_id = $_GET["file_id"];

   $query ="SELECT 
               file_id, 
               file_name, 
               file_ext, 
               training_id, 
               active_status, 
               file_path, 
               file_path_main_directory, 
               main_directory_id, 
               main_storage_directory 
            FROM file_Storage
	         INNER JOIN
		         file_storage_main ON file_storage_main.main_directory_id = file_storage.file_path_main_directory
	         WHERE file_id = :file_id";

   $stmt=$pdo->prepare($query);
   $stmt->bindParam(":file_id", $file_id);
   $stmt->execute();
   $result=$stmt->fetchAll();

   foreach($result as $file_result) {
      $main_directory = $file_result["main_storage_directory"];
      $file_name = $file_result["file_name"];
      $file_ext = $file_result["file_ext"];
      $file_path = $file_result["file_path"];
      $file_path_main_directory = $file_result["file_path_main_directory"];
      $file_name = $file_result["file_name"];
   }

   $full_path = $main_directory . $file_path . $file_name . "." . $file_ext;    //main path of the file outside root folder
   $file_destination = "D:/smartFactory/wwwroot/Training/download_temp/" . $file_name . "." . $file_ext;  //temporary folder where the file will be copied

   $ip_add = $_SERVER['HTTP_HOST']; //get the ip add of the server
   $http = "http://"; 
   //$download_file_path_temp = $http . $ip_add . "/Training/download_temp/" . $file_name . "." . $file_ext; //getting the directory of the file using http
   
   $download_file_path_temp = "download_temp/" . $file_name . "." . $file_ext; //getting the directory of the file using http
   $download_file_name = $file_name.".".$file_ext;
   
   if(copy($full_path, $file_destination)){ //copy the original file to the temporary folder

   header('Content-description:File Transfer');
   header('Content-Type: application/octet-stream');  
   //header('Content-Type: application/pdf'); 
   header("Content-Disposition: attachment; filename=$download_file_name");
   header('Expires: 0');
   header('Cache-Control: must-revalidate, post-check=0');
   header('Pragma: public'); 

   ob_clean();
   flush();

   if(readfile($download_file_path_temp)) {; //download the file via HTTP 

   unlink($file_destination); //deletes the file from the temporary folder */
   }

   exit();
   }

   else
   { 
      echo "failed to download";
   }

}