<?php
session_start();
include './methods.php';
//session_check();

?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="c.css" />
  <title>Menu</title>
</head>
 <body>

   <br>
   <h1>Quick Browser Wordbook</h1>
   <br>
<?php
  echo "Welcome {$_SESSION['USERNAME']}！";
?>
   <br>
   <br>
<input type="button" class="square_btn" onclick="location.href='./touroku.html'" value="Registration Mode">
<input type="button" class="square_btn" onclick="location.href='./view.php'" value="Edit Mode">
<input type="button" class="square_btn" onclick="location.href='./hukusyu.html'" value="Review Mode">
<br>
<br>
<input type="button" class="square_btn2" onclick="location.href='./logout.php'" value="Logout">


</body></html>
