<?php
require_once('../config.php');
require_once('../class.php');
?>

<!DOCTYPE html>
<html class='no-js' lang='ja'>
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
              Twitter System
            </h1>
          </div>
        </div>
      </div>
      <div class='row'>
        <div class='col-lg-12'>
          <fieldset class='text-center'>  <!--FIELDSETはフォームの入力項目をグループ化する-->
            <legend>Account Registration</legend>　<!--<LEGEND>～</LEGEND>で入力項目グループにタイトルをつける-->
            <div class='form-group'>

                <?php 
                    //データベースへ接続
                    $dbh = new Database;
                    $pdo = $dbh->getDBH();

                    //POSTのValidate
                    $username = $_POST['username'];
                    $nickname = $_POST['nickname'];
                    $account_id = $_POST['account_id'];
                    $api_key = $_POST['api_key'];
                    $api_key_secret = $_POST['api_key_secret'];
                    $access_token = $_POST['access_token'];
                    $access_token_secret = $_POST['access_token_secret'];


                    //パスワードの正規表現
                    if (preg_match('/\A(?=.*?[a-z])(?=.*?\d)[!-~]{8,100}+\z/i', $_POST['password'])) {//'/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i'
                      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    } else {
                      echo 'パスワードは半角英数字をそれぞれ1文字以上を含む、合計8文字以上で設定してください。';
                      print <<<EOH
                      <br><br>
                      <button type="submit"class="btn btn-default" onclick="location.href='./regist.php'">登録画面に戻る</button>
EOH;
                      return false;
                    }

                    //登録処理
                    try {
                      $email_sql = "SELECT * FROM userdata WHERE username = :username";
                      $stmt = $pdo->prepare($email_sql);
                      $stmt->bindValue(':username', $username);
                      $stmt->execute();
                      $col = $stmt->fetch();
                      if ($col['username'] === $username) {
                        echo 'このEmail addressは既に使われています'. "<br/>";
                        print <<<EOH
                        <br>
                        <br>
                        <button type="submit"class="btn btn-default" onclick="location.href='./regist.php'">登録画面に戻る</button>
EOH;
                      } else {
                        $stmt = $pdo->prepare("insert into userdata(username, password, account_id, api_key, api_key_secret, access_token, access_token_secret, nickname) values(?, ?, ?, ?, ?, ?, ?, ?)");
                        $stmt->execute([$username, $password, $account_id, $api_key, $api_key_secret, $access_token, $access_token_secret, $nickname]);
                        echo '登録完了!';
                        print <<<EOH
                        <br>
                        下のボタンをクリックしてください。
                        <br>
                        <br>
                        <button type="submit"class="btn btn-default" onclick="location.href='./login.html'">ログインページに移動する</button>
EOH;
                      }
                    } catch (\Exception $e) {
                      echo 'エラーが発生しました'. "<br/>";
                      print <<<EOH
                      <br>
                      <br>
                      <button type="submit"class="btn btn-default" onclick="location.href='./regist.php'">登録画面に戻る</button>
EOH;
                    } 
                    ?>

            </div>
          </fieldset>
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
