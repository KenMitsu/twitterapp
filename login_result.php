<?php
require_once('config.php');
require_once(__DIR__ . '/class.php');
session_start();
ini_set('display_errors', 0);

?>

<!DOCTYPE html>
<html lang="ja">
 <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width,initial-scale=1.0">
      <link rel="stylesheet" href="c.css">
      <title>Login</title>
 </head>
 <body>
   <h2>Login</h2><br>

    <?php
    //DB内でPOSTされたメールアドレスを検索
        $pdo = new Database();
        $dbh = $pdo->getDBH();
        $stmt = $dbh->prepare('select * from userdata where username = ?');
        $stmt->execute([$_POST['username']]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);


        
        //emailがDB内に存在しているか確認
        if (!isset($row['username'])) {
          echo 'Incorrect Username';
          print <<<EOH
          <input type="button"class="square_btn2" onclick="location.href='./login.html'" value="Back to Login page">;
        EOH;
          return false;
        }

        //パスワード確認後sessionにメールアドレスを渡す
        if (password_verify($_POST['password'], $row['password'])) {
          session_regenerate_id(true); //session_idを新しく生成し、置き換える
          $_SESSION['USERNAME'] = $row['username'];
          echo "Welcome {$_SESSION['USERNAME']}!";
          echo '<br>';
          print <<<EOH
          <input type="button"class="square_btn2" onclick="location.href='./hierapolis-gh-pages/dashboard.php'" value="Go to Menu">
        EOH;

        } else {
          echo 'パスワードが間違っています。';
          print <<<EOH
          <input type="button"class="square_btn2" onclick="location.href='./login.html'" value="Back to Login Page">
        EOH;
          return false;
        }
    ?>
 </body>
