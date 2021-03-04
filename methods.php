<?php
//sessionの確認
function session_check(){
  if (isset($_SESSION['USERNAME'])) {
  }
  else{
    $url = './login.html';
    header('Location: ' . $url, true, 301);
    // すべての出力を終了
    exit;
  }
}



//難易度変更（ok)
function diff_ok($lastword){
  $con = 0;
	$df = 0;
	$link = new mysqli("157.112.147.201", "teruto725_d","teruto725", "teruto725_tango");
	$link->set_charset('utf8');
  $sql = 'SELECT english,japanese,difficult,count,username FROM tango WHERE english =\'' . $lastword['eng'] .'\' AND username = \'' . $_SESSION['USERNAME'] .'\'' ;
  $result = mysqli_query($link,$sql);
	while ($data = mysqli_fetch_assoc($result)){
		$con = $data{'count'};
		$df = $data{'difficult'};
	}
	if($con < 0){
		$con = 1;
		$df += $df -1;
	}
	else{
		$con = $con +1;
			$df =$df- 2*($con-1);
	}
	$sql = 'UPDATE tango SET count=\'' . $con . '\' WHERE english=\'' . $lastword['eng'] .'\' AND username = \'' . $_SESSION['USERNAME'] .'\'' ;
	$result = mysqli_query($link, $sql);

	$sql = 'UPDATE tango SET difficult=' . $df .  ' WHERE english=\'' . $lastword['eng'] . '\' AND username = \'' . $_SESSION['USERNAME'] .'\'' ;
	$result = mysqli_query($link, $sql);
  if( !mysqli_close($link) ) {
    error('Error of database');
  }
}

//難易度変更（bad)
function diff_bad($lastword){
  $con = 0;
  $df = 0;
  $link = new mysqli("157.112.147.201", "teruto725_d","teruto725", "teruto725_tango");
  $link->set_charset('utf8');
  $sql = 'SELECT english,japanese,difficult,count,username FROM tango WHERE english =\'' . $lastword['eng'] .'\' AND username = \'' . $_SESSION['USERNAME'] .'\'' ;
  $result = mysqli_query($link,$sql);
  while ($data = mysqli_fetch_assoc($result)){
    $con = $data{'count'};
    $df = $data{'difficult'};
  }
  if($con > 0){
    $con = 1;
    $df =$df+ 1;
  }
  else{
    $con = $con -1;
    $df = $df+2*((-1)*$con-1);
  }
  $sql = 'UPDATE tango SET count=\'' . $con . '\' WHERE english=\'' . $lastword['eng'] .'\' AND username = \'' . $_SESSION['USERNAME'] .'\'' ;
  $result = mysqli_query($link, $sql);
  $sql = 'UPDATE tango SET difficult=\'' . $df .  '\' WHERE english=\'' . $lastword['eng'] . '\' AND username = \'' . $_SESSION['USERNAME'] .'\'' ;
  $result = mysqli_query($link, $sql);
  if( !mysqli_close($link) ) {
    error('切断に失敗しました。');
  }
}

//timerつきの単語帳
function print_tango_t($startmin,$startsec){
  $lastword = print_panel();
			echo "<form action=\"tango_t_ok.php\" method=\"post\">";
			echo "<input type=\"hidden\" name=\"lastword\" value=\"" . $lastword . "\">";
			echo "<input name=\"startmin\" type=\"hidden\" value=\"" . $startmin .  ".\">";
			echo "<input name=\"startsec\" type=\"hidden\" value=\"" . $startsec .  ".\">";
			echo "<input type=\"submit\" class=\"square_btn\" value=\"OK\">";
			echo "</form>";
			echo "<form action=\"tango_t_bad.php\" method=\"post\">";
			echo "<input type=\"hidden\" name=\"lastword\" value=\"" . $lastword . "\">";
			echo "<input name=\"startmin\" type=\"hidden\" value=\"" . $startmin .  ".\">";
			echo "<input name=\"startsec\" type=\"hidden\" value=\"" . $startsec .  ".\">";
			echo "<input type=\"submit\" class=\"square_btn\" value=\"BAD\">";
			echo "</form>";
}

//ボタン部分表示
function print_button_ej($lastword){
        echo "<form action=\"tango_ej_ok.php\" method=\"post\">";
        echo "<input type=\"hidden\" name=\"lasteng\" value=\"" . $lastword['eng']. "\">";
        echo "<input type=\"hidden\" name=\"lastjap\" value=\"" . $lastword['jap']. "\">";
        echo "<input type=\"submit\" class=\"square_btn\" value=\"OK\">";
        echo "</form>";
        echo "<form action=\"tango_ej_bad.php\" method=\"post\">";
        echo "<input type=\"hidden\" name=\"lasteng\" value=\"" . $lastword['eng']. "\">";
        echo "<input type=\"hidden\" name=\"lastjap\" value=\"" . $lastword['jap']. "\">";        echo "<input type=\"submit\" class=\"square_btn\" value=\"BAD\">";
        echo "</form>";
}

//lastwordを除いて一番難しい単語を返す
function sec_diff_word($lastword){
  $link = new mysqli("157.112.147.201", "teruto725_d","teruto725", "teruto725_tango");
  $link->set_charset('utf8');
  if (mysqli_connect_errno()) {
  echo mysqli_connect_errno();
  }
  $user = $_SESSION['USERNAME'];
  $sql = 'SELECT english,japanese,difficult count,username FROM tango where username =\'' . $user . '\' AND english NOT IN(\'' . $lastword['eng'] . '\') ORDER BY difficult desc LIMIT 1 ';
  $result = mysqli_query($link, $sql);
  while ($data = mysqli_fetch_array($result)) {
    $word = array('eng'=>$data{'english'},'jap'=>$data{'japanese'});
  }
  if( !mysqli_close($link) ) {
    echo('切断に失敗しました。');
  }
  return $word;
}

//単語帳の日本語英語部分
function print_tangopanel_ej($word){
      echo "<div id = \"eng\">";
      echo "<h2>" . $word['eng'] . "</h2>";
      echo "</div>";
      echo "<div id = \"nihongo\">";
      echo "<p><input type=\"button\" class=\"square_btn\" value =\"Check Answer\" onClick=\"document.getElementById('nihongo').style.display='none';document.getElementById('jp').style.display='block'\"></p>";
      echo "</div>";
      echo "<div id = \"jp\" style=\"display:none\">";
      echo "<h2>" . $word['jap'] . "</h2>";
      echo "</div>";
      $lastword = $word;
    return $lastword;
}


//登録単語一覧表を表示
function print_table(){
  $link = new mysqli("157.112.147.201", "teruto725_d","teruto725", "teruto725_tango");
  $link->set_charset('utf8');
  $user = $_SESSION['USERNAME'];
  $sql = "SELECT english,japanese,difficult,count,username FROM tango WHERE username ='$user' ORDER BY english asc ";
  $result = mysqli_query($link, $sql);
  if (!$result) {
  	echo "SQL ERROR";
  }
  	print ("List of registered words");
  	echo "<TABLE border='2' >";
  	echo "<TR>";
  	echo "<TD>English";
  	echo "</TD>";
  	echo "<TD>Japanese";
  	echo "</TD>";
  	echo "<TD>Difficulty";
  	echo "</TD>";
  	echo "</TR>";
  	while ($row = mysqli_fetch_assoc($result)){//１ループで１行データが取り出され、データが無くなるとループを抜けます。
  		echo "<TR>";
  		echo "<TD>" . $row{'english'};
  		echo "</TD>";
  		echo "<TD>" . $row{'japanese'};
  		echo "</TD>";
  		echo "<TD>" . $row{'difficult'};
  		echo "</TD>";
  		echo "</TR>";
  	}
  	echo "</TABLE>";
  	if( !mysqli_close($link) ) {
  		error('SQL ERROR');
  	}
}
//編集用のテーブル
function edit_table(){
  $link = new mysqli("157.112.147.201", "teruto725_d","teruto725", "teruto725_tango");
  $link->set_charset('utf8');
  $user = $_SESSION['USERNAME'];
  $sql = "SELECT english,japanese,difficult,count,username FROM tango WHERE username ='$user' ORDER BY english asc ";
  $result = mysqli_query($link, $sql);
  if (!$result) {
  	echo "SQL ERROR";
  }
  print ("・All Registration Word");
  print "<form action=\"edit.php\" method=\"post\">";
  $count = 0;
  print <<<EOH
  <body>
  <table class="memberTable" id="memberTable" >
  <tr><th>Edit</th><th>English</th><th>Japanese</th><th>Difficulty</th><th>Remove</th></tr>
EOH;

  while ($row = mysqli_fetch_assoc($result)){
    $eng = $row{'english'};
    $jap = $row{'japanese'};
    $diff = $row{'difficult'};
    print <<<EOH
    <input type="hidden" name="edit$count" value="0">
    <input type="hidden" name="del$count" value="0">
    <tr>
      <td><input type="checkbox" name="edit$count" value="1" id="checkbox" /></td>
      <td><input type="text" size="20" maxlength="10" name="eng$count" value="$eng" class="memberList"></td>
      <td><input type="text" size="20" maxlength="30" name="jap$count" value="$jap" class="memberList"></td>
      <td><input type="text" size="3" maxlength="10" name="diff$count" value="$diff" class="memberList"></td>
      <td><input type="checkbox" name="del$count" value="1" id="checkbox" /></td>
      <td>
      </td>
    </tr>
EOH;
  echo "<input type=\"hidden\" name=\"con$count\" value=\"" . $row{'count'} . "\">";
  echo "<input type=\"hidden\" name=\"lasteng$count\" value=\"" . $row{'english'} . "\">";
    $count += 1;
  }
  echo "</table>";

  echo "<input type=\"hidden\" name=\"count\" value=\"$count\">";
  echo "<input type=\"submit\" class=\"square_btn\" value=\"Reflect changes\">";
  echo "</body></form>";
  	if( !mysqli_close($link) ) {
  		error('Database Error');
  	}
}
?>
