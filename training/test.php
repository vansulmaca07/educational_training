



<!DOCTYPE html>
<html>
 
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">

<div class="dropdown m-4">
        <button class="btn btn-secondary 
                       dropdown-toggle" 
                type="button" 
                id="dropdownMenuButton1" 
                data-bs-toggle="dropdown" 
                aria-expanded="false">
            Dropdown button
        </button>
        <ul class="dropdown-menu pt-0" 
            aria-labelledby="dropdownMenuButton1">
            <input type="text" 
                   class="form-control 
                          border-0 border-bottom 
                          shadow-none mb-2" 
                   placeholder="Search..." 
                   oninput="handleInput()">
        </ul>

        <input class="form-control upload-file-materials " type="file" id="file-upload" name="file[]" style="width:50%; background-color:lightyellow;" 
         multiple>
     
<div class="try" style="display:none;">
<dotlottie-player 
  src="https://lottie.host/3827ada8-97bd-4b44-8b42-2837434748df/5xzBlkIfd9.lottie"
  background="transparent"
  speed="1"
  style="width: 300px; height: 300px"
  loop
  autoplay
  display 
></dotlottie-player>

</div>



        
    </div>
<script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs"type="module"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
</html>

<script>

$(document).ready(function() {
MyForm = {}; // empty array
MyForm.userUploads = []; // empty object
    
$('.upload-file-materials input[type="file"]').on('change', function() {

// Get the files.
var files = $(this)[0].files;

// For each file, append it onto the end of our array.
for( var key in files ) {
    
        MyForm.userUploads.push( files[key] );
    
}

console.log(MyForm.userUploads);

});

});
</script>