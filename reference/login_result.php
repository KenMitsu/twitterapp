<?php
require_once('../config.php');
require_once('../class.php');
session_start();
ini_set('display_errors', 0);
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
              CINC Twitter System
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
                    //ip確認
                    /*
                    $matchFlag = ipRestriction();
                    if (!$matchFlag){
                      http_response_code( 301 ) ;
                      header( "Location: ./404.html" ) ;
                      exit ;
                    }
                    */
                    
                    //DB内でPOSTされたメールアドレスを検索
                    $dbh = new Database();
                    $pdo = $dbh->getDBH();
                    $stmt = $pdo->prepare('select * from userdata where username = ?');
                    $stmt->execute([$_POST['username']]);
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    //emailがDB内に存在しているか確認
                    if (!isset($row['username'])) {
                      echo 'Email addressが間違っています。もしくは登録されていません。';
                      print <<<EOH
                      <br>
                      <br>
                      <button type="submit"class="btn btn-default" onclick="location.href='./login.html'">ログインページに戻る</button>
                    EOH;
                      return false;
                    }

                    //パスワード確認後sessionにメールアドレスを渡す
                    if (password_verify($_POST['password'], $row['password'])) {
                      session_regenerate_id(true); //session_idを新しく生成し、置き換える
                      $_SESSION['USERNAME'] = $row['username'];
                      echo "Welcome!";
                      echo '<br>';
                      print <<<EOH
                      <br>
                      <br>
                      <button type="submit"class="btn btn-default" onclick="location.href='./tables.php'">メインページへ移動する</button>
                    EOH;

                    } else {
                      echo 'パスワードが間違っています';
                      print <<<EOH
                      <br>
                      <br>
                      <button type="submit"class="btn btn-default" onclick="location.href='./login.html'">ログインページに戻る</button>
                    EOH;
                      return false;
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




<?php
    function ipRestriction()
    {
          // 許可IPリスト
          $allowIpList = array(
            '113.33.153.182',
          );
          
          // リモートIP取得
          $thisIp = $_SERVER['REMOTE_ADDR'];
          echo $thisIp;
          
          // リモートIPをドットで区切る
          $thisIpNums = explode('.', $thisIp);
          
          // リモートIPを10進数値に変更
          $thisIpNum = isset($thisIpNums[3]) ? (
            $thisIpNums[0] * pow(2,24)
            + $thisIpNums[1] * pow(2,16)
            + $thisIpNums[2] * pow(2,8)
            + $thisIpNums[3] * pow(2,0)
            ) : 0;
          
          // 許可IPリストとのマッチ検索開始
          $matchFlag = false;
          foreach ($allowIpList as $allowIp) {
            // 許可IPをスラッシュで区切る
            $allowIpArray = explode('/', $allowIp);

            // 許可IPをドットで区切る
            $allowIpNums = explode('.', $allowIpArray[0]);

            // 許可IPを10進数値に変更
            $allowIpNum = isset($allowIpNums[3]) ? (
              $allowIpNums[0] * pow(2,24)
              + $allowIpNums[1] * pow(2,16)
              + $allowIpNums[2] * pow(2,8)
              + $allowIpNums[3] * pow(2,0)
              ) : 0;

            // 許可IPのマスクを数値に変更
            $maskNum = isset($allowIpArray[1])  
              ? (pow(2,(int)$allowIpArray[1]) - 1) * pow(2, 32 - (int)$allowIpArray[1])
              : pow(2, 32) - 1;

            // リモートIPと許可IPの一致を確認
            if (($thisIpNum & $maskNum) === ($allowIpNum & $maskNum)) {
              $matchFlag = true;
              return $matchFlag;
            }
          }
        return $matchFlag;
    }
?>