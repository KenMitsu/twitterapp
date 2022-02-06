<?php
session_start();
ini_set('display_errors', 0);
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	  <meta name="viewport" content="width=device-width,initial-scale=1.0">
	  <link rel="stylesheet" type="text/css" href="c.css" />
</head>
<body>
  <h2>Logout</h2><br>
<?php
if (isset($_SESSION["USERNAME"])) {
  echo 'Successfully Logout!';
} else {
  echo 'Successfully Logout!';
}
echo <<<EOH
<br><br>
<input type="button" class="square_btn2" onclick="location.href='./login.html'" value="Back to Login Page">
EOH;
//セッション変数のクリア
$_SESSION = array();
//セッションクッキーも削除
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
//セッションクリア
@session_destroy();
?>
