<?php
require_once('../config.php');
require_once('../class.php');
session_start();
ini_set('display_errors', 0);

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

<!DOCTYPE html>
<html class='no-js' lang='en'>
  <head>
    <meta charset='utf-8'>
    <meta content='IE=edge,chrome=1' http-equiv='X-UA-Compatible'>
    <title>Sign in</title>
    <meta content='lab2023' name='author'>
    <meta content='' name='description'>
    <meta content='' name='keywords'>
    <link href="assets/stylesheets/application-a07755f5.css" rel="stylesheet" type="text/css" /><link href="//netdna.bootstrapcdn.com/font-awesome/3.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/images/favicon.ico" rel="icon" type="image/ico" />
  </head>


  <body class='login'>
    <div class='wrapper'>
      <div class='row'>
        <div class='col-lg-12'>
          <div class='brand text-center'>
            <h1>
              <div class='logo-icon'>
                <i class='icon-beer'></i>
              </div>
              CINC Twitter システム 
            </h1>
          </div>
        </div>
      </div>
      <div class='row'>
        <div class='col-lg-12'>
          <form action="index_result.php" method="post">
            <fieldset class='text-center'>  <!--FIELDSETはフォームの入力項目をグループ化する-->
              <legend>Login to your account</legend>　<!--<LEGEND>～</LEGEND>で入力項目グループにタイトルをつける-->
              <div class='form-group'>
                <input class='form-control' id="username" placeholder='Email address' type='email' name="username" autocorrect="off" autocapitalize="off">
              </div>
              <div class='form-group'>
                <input class='form-control' id="password" placeholder='password' type='password' name="password" autocorrect="off" autocapitalize="off">
              </div>
              <div class='text-center'>
                <div class='checkbox'>
                  <label>
                    <input type='checkbox'>
                    Remember me on this computer
                  </label>
                </div>
                <button type="submit"class="btn btn-default">Sign In</button>

                <br>
                <a href="forgot_password.html">Forgot password?</a>
              </div>
            </fieldset>
          </form>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <!-- Javascripts -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" type="text/javascript"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js" type="text/javascript"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js" type="text/javascript"></script>
    <script src="assets/javascripts/application-985b892b.js" type="text/javascript"></script>


    <!-- Google Analytics -->
    <script>
      var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
      (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
      g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
      s.parentNode.insertBefore(g,s)}(document,'script'));
    </script>
  </body>
</html>
