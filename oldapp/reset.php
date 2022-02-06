<?php
session_start();
include './methods.php';
session_check();
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <link rel="stylesheet" href="c.css">
		  <meta name="viewport" content="width=device-width,initial-scale=1.0">
</head>
<body>

<id="top"><h2>Edit Mode</h2>
<p>All Word difficulty level has been reset</p>
<?php

  #リセット
	$link = new mysqli("157.112.147.201", "teruto725_d","teruto725", "teruto725_tango");
  $link->set_charset('utf8');

  $sql = 'UPDATE tango set difficult = 0 ';
  $result = mysqli_query($link, $sql);
	$sql = 'UPDATE tango set count = 1';
  $result = mysqli_query($link, $sql);
	edit_table();
	?>
	<br>
	<br>
	<br>
	<input type="button"class="square_btn" onclick="location.href='./reset.php'" value="Reset All Difficulty Level">
	<br>
	<br>
	<br>
	<input type="button"class="square_btn2" onclick="location.href='./menu.php'" value="Back To Menu">


</body>
</html>
