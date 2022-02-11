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
                    <p>半角英数字をそれぞれ1文字以上含む、合計8文字以上で設定してください。</p>
                    <p>▼以下　登録は任意</p>
                  </label>
                </div>
                <div class='form-group'>
                  <input class='form-control' id="account_id" placeholder='twitter_account_id（＠以降の文字列）' type='text' name="account_id" autocorrect="off" autocapitalize="off">
                </div>
                <div class='form-group'>
                  <input class='form-control' id="api_key" placeholder='API Key' type='password' name="api_key" autocorrect="off" autocapitalize="off">
                </div>
                <div class='form-group'>
                  <input class='form-control' id="api_key_secret" placeholder='API Key Secret' type='password' name="api_key_secret" autocorrect="off" autocapitalize="off">
                </div>
                <div class='form-group'>
                  <input class='form-control' id="access_token" placeholder='Access Token' type='password' name="access_token" autocorrect="off" autocapitalize="off">
                </div>
                <div class='form-group'>
                  <input class='form-control' id="access_token_secret" placeholder='Access Token Secre' type='password' name="access_token_secret" autocorrect="off" autocapitalize="off">
                </div>
                <a href="https://blog.palettecms.jp/article/20103" target="_blank" rel="noopener noreferrer">各種Keyの取得手順</a>
                <br><br>
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
