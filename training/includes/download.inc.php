<?php

include('dbh2.inc.php');

$query = "SELECT * FROM file_storage";

$stmt = $pdo->prepare($query);
$stmt->execute();

$result = $stmt->fetchAll();
$total_row = $stmt->rowCount();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!--jQuery and Bootstrap CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="home.css">

    <!--jQuery and Bootstrap javascript-->
    <script src="https://code.jquery.com/jquery-3.7.1.js" ></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Download files</h2>
        <table>
            <thead>
                <tr>
                    <th>File Name</th>
                    <th>File Size</th>
                    <th>File Type</th>
                    <th>Download</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if($total_row> 0) {
                        foreach ($result as $row) {
                            $file_path = "../uploads/" . $row['file_name'];
                            echo "
                            <tr>
                                <td>$row[file_name]</td>
                                <td>$row[file_size]</td>
                                <td>$row[file_type]</td>
                                <td><a href = $file_path class='btn btn-primary' download>DOWNLOAD</a></td>
                            </tr>
                            ";
                        }   
                    }

                    else {
                        echo "
                            <tr>
                                <td> NO FILES UPLOADED YET </td>
                            </tr>
                        ";
                    }
                ?>
                
            </tbody>
        </table>
    </div>
    
</body>
</html>