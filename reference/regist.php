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
          <form action="regist_result.php" method="post">
            <fieldset class='text-center'>  <!--FIELDSETはフォームの入力項目をグループ化する-->
              <legend>Account Registration</legend>　<!--<LEGEND>～</LEGEND>で入力項目グループにタイトルをつける-->
              <p>アカウント登録</p>
              <div class='form-group'>
                <input class='form-control' id="username" placeholder='Email address' type='email' name="username" autocorrect="off" autocapitalize="off">
              </div>
              <div class='form-group'>
                <input class='form-control' id="password" placeholder='password' type='password' name="password" autocorrect="off" autocapitalize="off">
              </div>
              <div class='text-center'>
                <div>
                  <label>
                    <p>パスワードは半角英数字をそれぞれ1文字以上を含む、合計8文字以上で設定してください。</p>
                  </label>
                </div>
                <div class='form-group'>
                  <input class='form-control' id="nickname" placeholder='nickname' type='text' name="nickname" autocorrect="off" autocapitalize="off">
                </div>
                <div class='form-group'>
                  <input class='form-control' id="account_id" placeholder='twitter_account_id' type='text' name="account_id" autocorrect="off" autocapitalize="off">
                </div>
                <div>
                  <label>
                    <p>twitter account：＠の後ろの文字列。登録でランキングに参戦可能。※登録は任意</p>
                    <p>※登録は任意</p>
                  </label>
                </div>
                <button type="submit"class="btn btn-default">Sign Up</button>
                <br><br>
                <a href="login.html">ログイン画面へ戻る</a>
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
