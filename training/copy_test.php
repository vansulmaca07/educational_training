<?php

?>

<html>
<head>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
  <div>
  <span id="copyText1"> I Love Jquery</span>
<button type="button" onclick="withJquery();">Click to Copy with Jquery</button>
<br>

  </div>

<script type="text/javascript">
    function withJquery(){
        console.time('time1');
	var temp = $("<input>");
    
    $("body").append(temp);

        temp.val($('#copyText1').text()).select();
        document.execCommand("copy");
        temp.remove();
        console.timeEnd('time1');
}


  </script>
</body>
</html>