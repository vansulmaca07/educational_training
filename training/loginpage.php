<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" >
    <link rel="stylesheet" href="loginpage.css">
    
    <title>LOGIN PAGE</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <header style="text-align:center">教育訓練記録</header>
            <form action="includes/login.inc.php" method="post">

            <div class="field input">
                <label for="username">GID</label>
                <input type="text" name="username" id="username">
            </div>

            <div class="field input">
                <label for="password">Password</label>
                <input type="password" name="pwd" id="pwd" required>
            </div>

            <div class="field input">
                
                <input type="submit" name="submit" value="ログイン" class="btn">
            </div>
            
            <div class="links">

            </div>
            <?php 
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "emptyinput") {
                echo "<p> Fill in all the fields! </p>";
                 }

                else if ($_GET["error"] == "wronglogin") {
                echo "<p>間違ったログイン情報";
             }
            }
            ?>  
            
            </form>
            
            <?php
            echo 
            '<a href="includes/attendanceuser.inc.php" class = "btn2" style="text-decoration:none;">一般ユーザー</a>';  
            ?>
        </div>
    </div>
    
</body>

<!--<script type="text/javascript" src="loginpage.js"></script>-->
</html>



