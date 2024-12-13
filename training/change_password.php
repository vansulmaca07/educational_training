<?php

include('navigation_test.php');
if(isset($_SESSION["participants_selected"])) {
    unset($_SESSION["participants_selected"]);
}


?>              
                <div class="container-box m-auto justify-content-center p-3 change-password-t align-items-center" <?php if($_SESSION["userlevel"] === '3') { echo "hidden";} ?> style="width: 70%;">
                <h4 style="text-align: center;">デフォルト設定</h4>
                    <table>
                    <form action="includes/default_settings.inc.php" method="POST">
                    <div class="input-group" style = "width:100%;">
                        
                        <span class="input-group-text" style="width:30%;">所属G係</span>
                        <select class="selectpicker form-control w-70" name='default_group[]'  data-size = "6" data-live-search = "true" multiple id="input-group-select" data-actions-box="true" aria-label="size 3 select example">
                            <?php

                                //SAVED FILTER                
                                $query_group_filter = 
                                "SELECT group_ FROM progress_filters
                                    WHERE
                                        GID = :GID
                                ";
                                        
                                $stmt_group_filter = $pdo->prepare($query_group_filter);
                                $stmt_group_filter->bindParam(":GID", $_SESSION["GID"]);
                                $stmt_group_filter->execute();
                                            
                                $result_group_filter = $stmt_group_filter->fetchAll();
                                $result_group_filter_count = $stmt_group_filter->rowCount();
        
                                if($result_group_filter_count > 0) {
                                    foreach($result_group_filter as $row_group_filter) {
                                        $default_group = json_decode($row_group_filter["group_"]);
                                        //$default_department[] = $row_department_filter["department"];
                                    }
                                }
                                else {
                                    //continue
                                }  
                                
                                
                                $query_group = "SELECT * FROM group_
                                    ORDER BY group_name";

                                $stmt = $pdo->prepare($query_group);
                                $stmt->execute();
                                $result = $stmt->fetchAll();

                                
                                foreach($result as $group_list) {
                                    echo "<option value='$group_list[group_id]'";

                                    if($result_group_filter_count > 0) {
                                        if(in_array("$group_list[group_id]", $default_group)) {
                                            echo "selected";
                                        }

                                        else {
                                            //continue
                                        }
                                    }
                                    
                                    else {
                                        if($group_list["group_id"] === $_SESSION["group_id"]) {
                                            echo "selected";
                                        }

                                        else {
                                            //continue
                                        }

                                    }
                                   
                                    echo "
                                        >$group_list[group_name]</option>
                                    ";
                                       
                                }
                                
                            ?>
                        </select>
                    </div> 
                    <div class="input-group w-100 text-center mt-3">
                        
                        <span class="input-group-text" style="width: 30%;">工程</span>
                        
                            
                        <select class="selectpicker form-control w-70" name="default_department[]" style="" data-size = "6" data-live-search = "true" multiple id="input-department-select-yes" data-actions-box="true" aria-label="size 3 select example">
                        <?php
                                
                                //SAVED FILTER                
                                $query_department_filter = 
                                    "SELECT department FROM progress_filters
                                        WHERE
                                            GID = :GID
                                    ";
                                           
                                $stmt_department_filter = $pdo->prepare($query_department_filter);
                                $stmt_department_filter->bindParam(":GID", $_SESSION["GID"]);
                                $stmt_department_filter->execute();
                                           
                                $result_department_filter = $stmt_department_filter->fetchAll();
                                $result_department_filter_count = $stmt_department_filter->rowCount();

                               // $default_department = "";
                                           
                                if($result_department_filter_count > 0) {
                                    foreach($result_department_filter as $row_department_filter) {
                                        $default_department = json_decode($row_department_filter["department"]);
                                        //$default_department[] = $row_department_filter["department"];
                                    }
                                        
                                }

                                else {
                                    //continue
                                }  
                                            
                                $query_department = "SELECT * FROM department";

                                $stmt = $pdo->prepare($query_department);
                                $stmt->execute();
                                $result = $stmt->fetchAll();

                                foreach($result as $department_list) {
                                    echo "<option value='$department_list[department_id]'";   
                                        if($result_department_filter_count > 0) {
                                            if(in_array("$department_list[department_id]", $default_department)) {
                                                echo "selected";
                                            }
                                        }

                                        else {
                                            if($department_list["department_id"] === $_SESSION["department"]) {
                                                        echo "selected";
                                                        }
                                        } 
                                            echo " class='department_main_filter'>$department_list[department_name] </option>"; 


                                       /* if(isset($_SESSION["department_main_filter"])) {
                                            $session_filter = $_SESSION["department_main_filter"];
                                            if(in_array("$department_list[department_id]", $session_filter)) {
                                                echo "selected";
                                            }
                                        }

                                        else if(isset($saved_department_filter)) {
                                                    
                                            if(in_array("$department_list[department_id]", $saved_department_filter)) {
                                                        echo "selected";
                                                        }
                                        }
                                                
                                        else {
                                            if($department_list["department_id"] === $_SESSION["department"]) {
                                                        echo "selected";
                                                        }
                                        } 
                                            echo " class='department_main_filter'>$department_list[department_name] </option>";  
                                            
                                        */
                                }
                                        
                                
                                /*
                                        foreach($result as $department_list) {
                                            echo "<option value='$department_list[department_id]' name='department_main_filter[]'";              
                                               if(isset($_SESSION["department_main_filter"])) {
                                                    $session_filter = $_SESSION["department_main_filter"];
                                                    if(in_array("$department_list[department_id]", $session_filter)) {
                                                        echo "selected";
                                                        }
                                                }                  
                                                else if($department_list["department_id"] === $_SESSION["department"]){
                                                        echo "selected";       
                                                }                                                
                                                else {
                                                    
                                                }
                                                    echo "class='department_main_filter'>$department_list[department_name] </option>";                                                                  
                                            }*/
                            ?>
                        </select>
                        
                        
                    </div>
                    <div class="input-group w-100 text-center mt-3">
                        
                        <span class="input-group-text" style="width: 30%;"> 確認者</span>
                        
                            
                        <select class="selectpicker form-control w-70" name="default_approver[]" style="" data-size = "6" data-live-search = "true" multiple id="input-approver-select-yes" data-actions-box="true" aria-label="size 3 select example">
                        <?php
                                
                                //SAVED FILTER                
                                $query_approver_filter = 
                                    "SELECT approver FROM progress_filters
                                        WHERE
                                            GID = :GID
                                    ";
                                           
                                $stmt_approver_filter = $pdo->prepare($query_approver_filter);
                                $stmt_approver_filter->bindParam(":GID", $_SESSION["GID"]);
                                $stmt_approver_filter->execute();
                                           
                                $result_approver_filter = $stmt_approver_filter->fetchAll();
                                $result_approver_filter_count = $stmt_approver_filter->rowCount();
                                           
                                $default_approver = NULL;
                                if($result_approver_filter_count > 0) {
                                    foreach($result_approver_filter as $row_approver_filter) {
                                        $default_approver = json_decode($row_approver_filter["approver"]);
                                        
                                    }
                                        
                                }

                                else {
                                    //continue
                                }  
                                            
                                $query_approver = "SELECT * FROM users 
                                WHERE
                                    userlevel = '1'
                                OR
                                    userlevel = '3'
                                OR 
                                    userlevel = '4'
                            
                                    ";

                                $stmt = $pdo->prepare($query_approver);
                                $stmt->execute();
                                $result = $stmt->fetchAll();

                                foreach($result as $approver_list) {
                                    echo "<option value='$approver_list[GID]'";   
                                    
                                        if($default_approver !== NULL) {
                                            if(in_array("$approver_list[GID]", $default_approver)) {
                                                echo "selected";
                                            }
                                        }

                                        else {
                                            if($approver_list["GID"] === $_SESSION["GID"]) {
                                                        echo "selected";
                                                        }
                                        } 
                                            echo " class='department_main_filter'>$approver_list[name_] </option>"; 

                                }                                        
                            ?>
                        </select>    
                    </div>
                    </table>
                    <div class="text-center change-password-btn">
                        <button type="submit" class="btn btn-primary m-auto text-center mt-3" style="width: 25%;" >更新</button>
                    </div>
                    </form>
                </div>
                
                <div class="container-box m-auto mt-3 justify-content-center p-3 change-password-t align-items-center" style="vertical-align:middle; width: 70%;">
                <h4 style="text-align:center;">パスワードを変更</h4>                
                    <form action="includes/change_password.inc.php" method="POST">                        
                        <div class="input-group m-auto mb-3" style="width: 90%; margin-top:40px;">
                            <span class="input-group-text" id="inputGroup-sizing-default" style="width:35%">古いパスワード</span>
                            <input type="password" required name="old_password" value="" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group m-auto mb-3" style="width: 90%;">
                            <span class="input-group-text" id="inputGroup-sizing-default" style="width:35%">新しいパスワード</span>
                            <input type="password" required name="new_password" value="" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group m-auto mb-3" style="width: 90%;">
                            <span class="input-group-text" id="inputGroup-sizing-default" style="width:35%">新しいパスワードの確認</span>
                            <input type="password" required name="new_password_confirmation" value="" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="text-center change-password-btn">
                            <button type="submit" class="btn btn-primary m-auto text-center" style="width: 25%;">パスワードの変更</button>
                        </div>
                    </form>
                </div>
               
                <?php

                    if(isset($_GET["error"])) {
                        if ($_GET["error"] === "password_not_matched") {
                            echo "                               
                            <div class='alert m-auto alert-danger alert-dismissible fade show pt-2 pb-2' style='width: 50%; text-align:center;' role='alert'>
                                Password Not Matched
                                <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>      
                            ";                
                        }
                        if ($_GET["error"] === "old_password_not_matched") {
                            echo "                               
                            <div class='alert m-auto alert-danger alert-dismissible fade show pt-2 pb-2' style='width: 50%; text-align:center;' role='alert'>
                                Old Password Not Matched
                                <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>      
                            ";                
                        }
                        if ($_GET["error"] === "password_too_short") {
                            echo "                               
                            <div class='alert m-auto alert-danger alert-dismissible fade show pt-2 pb-2' style='width: 50%; text-align:center;' role='alert'>
                                Password Too Short
                                <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>      
                            ";                
                        }
                        if ($_GET["error"] === "password_blank") {
                            echo "                               
                            <div class='alert m-auto alert-danger alert-dismissible fade show pt-2 pb-2' style='width: 50%; text-align:center;' role='alert'>
                                Password Blank
                                <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>      
                            ";                
                        }
                        if ($_GET["error"] === "password_blank") {
                            echo "                               
                            <div class='alert m-auto alert-danger alert-dismissible fade show pt-2 pb-2' style='width: 50%; text-align:center;' role='alert'>
                                Password Blank
                                <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>      
                            ";                
                        }
                        if ($_GET["error"] === "password_GID") {
                            echo "                               
                            <div class='alert m-auto alert-danger alert-dismissible fade show pt-2 pb-2' style='width: 50%; text-align:center;' role='alert'>
                                Password must not be your GID
                                <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>      
                            ";                
                        }
                    }

                    if(isset($_GET["success"])) {
                        if($_GET["success"] === "password_changed") {
                            echo "                               
                            <div class='alert m-auto alert-success alert-dismissible fade show pt-2 pb-2' style='width: 50%; margin-top:15x; text-align:center;' role='alert'>
                                password changed success
                                <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>      
                            "; 
                        }
                    }

                    if(isset($_GET["success"])) {
                        if($_GET["success"] === "default_department_changed") {
                            echo "                               
                            <div class='alert m-auto alert-success alert-dismissible fade show pt-2 pb-2' style='width: 50%; margin-top:15x; text-align:center;' role='alert'>
                                default department changed success
                                <button type='button' class='btn-close pt-3 pb-1' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>      
                            "; 
                        }
                    }
                ?>

                
            </div> <!--paddin-->
        </div> <!--col-->
    </div> <!--row-->
</div> <!--container-fluid-->  

<script type="text/javascript">
    $(document).ready(function() {

        $(".user-settings-tab").addClass("active");

    });

</script>
