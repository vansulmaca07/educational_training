<?php

include("dbh2.inc.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $GID = $_POST["ID_GID_register"];

    $query = "SELECT name_, GID from users
    WHERE
        GID = :GID
    ";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":GID", $GID);
    $stmt->execute();

    $result = $stmt->fetchAll();

    foreach ($result as $row) {
        $name_ = $row["name_"]; 
    }

    $output = "
        <tr>
            <td>$GID</td>
            <td>$name_</td>
        </tr>
    ";

    echo $output;
}

