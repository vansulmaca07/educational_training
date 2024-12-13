<?php

include('navigation_test.php');
if(isset($_SESSION["participants_selected"])) {
    unset($_SESSION["participants_selected"]);
}

?>

   
                <div class="container-box m-auto justify-content-center p-3 change-password-t align-items-center" style="vertical-align:middle; width: 40%; height: 65%;">
                <h4 style="text-align:center;">工程採番</h4>
                    <table border="1" class="table table-bordered table-hover rounded-3  process-prefix-t" style="height: 75%; width:100%;">
                        <thead class="table text-center theadstyle" style="width: 100%; margin-bottom: 0;">
                            <th style="width:70%">工程採番</th>
                            <th style="width:30%">Delete</th>
                        </thead>
                        <tbody id="post_list_process_prefix">
                        </tbody>          
                    </table>
                    <div class="input-group" style="width:100%; text-align:center;">
                        <input type="text" class="process_prefix_input  form-control" placeholder="" name="process_prefix">
                        <button type="button" id="process_prefix_submit" class="input-group-text btn btn-primary">SUBMIT</button>
                    </div>
                   
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
                ?>

                
            </div> <!--paddin-->
        </div> <!--col-->
    </div> <!--row-->
</div> <!--container-fluid-->  

<script type="text/javascript">
    $(document).ready(function() {
                
        $(".administrator-settings-tab").addClass("active");

        var action;
        
        $("#process_prefix_submit").on("click", function () {
            
            action = "add_process_prefix";
            var process_prefix = $('.process_prefix_input').val(); 
       
               $.ajax({

                url: "includes/administrator_settings_add.inc.php",
                method: "POST",
                data: {action:action,process_prefix:process_prefix},
                success:function(data){
                    //$("#post_list_process_prefix").html(data);
                    //process_prefix();
                },
                error:function(data){
                    console.log("error");
                }

            }); 
      
        });

        //Process Prefix Table

        process_prefix();

        function process_prefix() {

            action = "process_prefix";
            $.ajax({

                url: "includes/administrator_settings.inc.php",
                method: "POST",
                data: {action:action},
                success:function(data){
                    $("#post_list_process_prefix").html(data);
                    //process_prefix();
                },
                error:function(data){
                    console.log("error");
                }
            });

        };
 

    });

</script>

