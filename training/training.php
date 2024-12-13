<?php
    include_once 'navigation_test.php';
    include_once 'includes/dbh2.inc.php';

    if(isset($_SESSION["participants_selected"])) {
        unset($_SESSION["participants_selected"]);
   }

?> 

<style>
/***Sign Progress*****/

.sign-progress.bootstrap-select .dropdown-menu { 
    width: auto !important; 
    max-height: 300px;
   /* overflow-y:visible;
    overflow-y: scroll; */
}

.sign-progress.bootstrap-select .dropdown-toggle /*dropdown,*/
/*.bootstrap-select .dropdown-menu li a options*/

{
  background-color: rgba(4, 73, 129, 0.808) !important; 
  width: 100% !important;
  font-size: 14px !important;
  color: white;
  border: rgba(4, 73, 129, 0.808) !important;  
  text-align: center !important;
  font-style: bold !important;
}

.none-sign-progress.bootstrap-select .dropdown-toggle::after {
  border: none;
  font: normal normal normal 14px/1;
  font-style: bold;
  font-family: "bootstrap-icons";
  content: "\F22C"; /* the desired FontAwesome icon */
  vertical-align: 0; /* to center vertically */
}

.selected-sign-progress.bootstrap-select .dropdown-toggle::after {
  border: none;
  font: normal normal normal 14px/1;
  font-style: bold;
  font-family: "bootstrap-icons";
  content: "\F3E0"; /* the desired FontAwesome icon */
  vertical-align: 0; /* to center vertically */
}
</style>
            
            <div class="all-header"  style="position:relative;  margin-bottom:15px;">
                <div class="new-form-header">
                    <button type="button" id ="reset-filter-btn" class="btn btn-danger mb-3" style="font-size: 14px; float:left; width: 130px; margin-right:20px; position:absolute;" onclick="">
                    リセット&nbsp;&nbsp;<i class="fa-solid fa-filter-circle-xmark"></i>
                    </button>
                </div>
                <div id="creationdepartment" class="header-1">
                <h4 style="text-align:center;"><b>訓練</b></h4>        
                </div> 
            </div>
            <hr>
                <div class="training-t-container" style="height:85%;">
                    <table id="trainingTable" class="table trainingT table-hover table-bordered rounded-3 overflow-auto" style="height:100%; table-layout: fixed;">
                        <thead class="theadstyle">
                            <tr id="firstrow">
                                <th style="width:10%">No</th>
                                <th style="width:25%">ファイル名</th>
                                <th style="width:25%">内容</th>
                                <th style="width:20%">参照</th>
                                <th style="width:25%" class="p-0">
                                    <div class="id-sign-progress-status-select-container p-0" style="width:100%;">
                                        <select data-selected-text-format="static" title="完成確認" class="sign-progress selectpicker form-control" data-size = "6" data-live-search = "true" style=""
                                            multiple id="input-sign-progress-select" data-actions-box="true">
                                            <?php
                                                $query = "SELECT DISTINCT(sign_progress), status_name FROM attendance
                                                        inner join status_ref on status_id = sign_progress
                                                            ;";
                                                        $stmt = $pdo->prepare($query);
                                                        $stmt->execute();
                                                        $result = $stmt->fetchAll();
                                                        foreach($result as $row)
                                                            {
                                                                echo "<option name='checkbox_sign_progress[]' class='common_selector sign_progress' value='$row[sign_progress]'";
                                                                echo ">$row[status_name]</option>";
                                                            }
                                                        
                                            ?>
                                        </select>
                                    </div>
                                    <!--
                                    <a href="" role="button" id="drowdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color:white"><i id="sign_progress_icon" style="float:right;" class="bi bi-caret-down"></i>完成確認</a>
                                    
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <?php
                                                $query = "SELECT DISTINCT(sign_progress), status_name FROM attendance
                                                        inner join status_ref on status_id = sign_progress
                                                            ;";
                                                        $stmt = $pdo->prepare($query);
                                                        $stmt->execute();
                                                        $result = $stmt->fetchAll();
                                                        foreach($result as $row)
                                                            {
                                            ?>
                                                <div class="list-group-item checkbox">
                                                    <label><input type="checkbox" name="checkbox_sign_progress[]" class="common_selector sign_progress" value="
                                                        <?php echo $row["sign_progress"];
                                                        ?>
                                                        "> <?php echo $row["status_name"];
                                                            ?>
                                                    </label>
                                                </div>
                                            <?php
                                                            }
                                            ?> 
                                        </ul>  --> 
                                
                                </th>
                            </tr>
                        </thead>
                        <tbody id="post_list">

                        </tbody>     
                    </table>

                    
                </div>
        
                <!-- Modal For Training Confirmation -->

                <div class="modal fade" id="training-confirmation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">教育訓練確認</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <span class="training-id"></span> 教育訓練は確実に受けましたか
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">いいえ、まだ受けていません。</button>
                                <button type="button" class="btn btn-primary btn-complete" data-bs-dismiss="modal">確認</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--End Modal -->
                

    </div> <!--mainwrapper-->
</div> <!--full-->

<!--jQuery and Bootstrap javascript
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  -->  
<script type="text/javascript">


$(document).ready(function() {

change_icon();

function change_icon() {
    if($('#input-sign-progress-select :selected').length > 0) {
            $('.sign-progress').removeClass("none-sign-progress").addClass("selected-sign-progress");
        }
    else {
        $('.sign-progress').removeClass("selected-sign-progress").addClass("none-sign-progress"); 
    }
}

$('#input-sign-progress-select').change(function() {
    change_icon();
    contents_data();
});




//Reset Filter

$("#reset-filter-btn").on("click", function() {
    $("#input-sign-progress-select").val("").trigger("change");
    $("#input-sign-progress-select").selectpicker("val","");


        //$("input[name='checkbox_sign_progress[]']").prop('checked', false);
        //$("#sign_progress_icon").attr("class", "bi bi-caret-down");

        contents_data();
    });

//get training id value from button Confirmation

var training_id;

$("#trainingTable tbody").on('click','.btn-confirmation', function() {

    training_id = $(this).val();
    console.log(training_id);
    $('.training-id').html(training_id);

});

$(".btn-complete").on('click' , function() {

    var GID_session = "<?php echo $_SESSION["GID"]; ?>";
    
    $.ajax({
        url: "includes/complete.inc.php",
        method: "POST",
        data: {GID_session:GID_session,training_id:training_id},
        success:function(data){
          contents_data();
        }
    });

});

//

$(".training-tab").addClass("active");

contents_data();

function contents_data() {
    //$('#post_list').html();
    var action = 'fetch_data';
    var shift = get_filter('shift');
    var process = get_filter('process');
    var building = get_filter('building');
    var sign_progress = get_filter('sign_progress');

    $.ajax({
        url: "includes/fetch_data_training.inc.php",
        method: "POST",
        data: {action:action,shift:shift,process:process,building:building,sign_progress:sign_progress},
        success:function(data){
          $('#post_list').html(data);
        }
    });
}

$('.common_selector').click(function(){

    if($('input[name="checkbox_sign_progress[]"]:checked').length > 0) 
    {
        $("#sign_progress_icon").attr("class", "bi bi-funnel-fill");
    }
    else {
        $("#sign_progress_icon").attr("class", "bi bi-caret-down");
    }

    contents_data();

});

function get_filter(class_name)
{
  var filter = [];
  $('.'+class_name+':checked').each(function(){
      filter.push($(this).val());
  });

  return filter;
}

$('.common_selector').click(function(){
    contents_data();
});
});



</script>

</body>
</html>

