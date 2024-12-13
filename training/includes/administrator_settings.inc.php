<?php

session_start();
include("dbh2.inc.php");


if($_SERVER["REQUEST_METHOD"] === "POST") {

    if($_POST["action"] === "process_prefix") {

        $query = "SELECT * FROM process_prefix
            ";

        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $output = "";
        foreach ($result as $row) {
            $output .= "
                <tr style=''>
                    <td style='width: 70%;'>$row[process_prefix]</td>
                    <td style='width: 26%;'><button value='$row[id]' class='btn btn-danger'><i class='bi bi-x-lg'></i></button></td>
                </tr>
            ";
        }

        echo $output;

        $stmt = null;
        $pdo = null;

        exit();


    }

    else if($_POST["action"] === "add_process_prefix") {

        $process_prefix = $_POST["process_prefix"];

        $query = "INSERT INTO process_prefix
            (process_prefix)
            VALUES
            (
            :process_prefix)
        ";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":process_prefix", $process_prefix);
        $stmt->execute();

        $stmt = null;
        $pdo = null;

        exit();
    }

    else {
        
        exit();
    }

}

