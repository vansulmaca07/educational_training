<?php

include("dbh2.inc.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $GID = $_POST["GID_register"];

    $query = "SELECT name_, GID, bar_code from users
    WHERE
        GID = :GID
    ";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":GID", $GID);
    $stmt->execute();

    $result = $stmt->fetchAll();

    foreach ($result as $row) {
        $name_ = $row["name_"]; 
        $bar_code = $row["bar_code"];
    }

    $output = "
        <tr>
            <td>$GID</td>
            <td>$name_</td>
            <td>$bar_code</td>
        </tr>
    ";

    echo $output;
}