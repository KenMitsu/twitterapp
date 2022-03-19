<?php
require_once('../class.php');
require_once('./header.php');
require_once('./sidebar.html');
require_once('./footer.html');
session_start();
?>

<!DOCTYPE html>
<html class='no-js' lang='en'>
  <body class='main page'>
    <!-- header.php -->
    <div id='wrapper'>
      <!-- Sidebar -->
      <!-- Content -->
      <div id='content'>
        <div class='panel panel-default'>
          <div class='panel-heading'>
            <i class='icon-edit icon-large'></i>
            キーワード登録
          </div>
          <div class='panel-body'>
            <form method="post">
              <fieldset>
                <legend>いいね付与する条件を指定 ※1時間当たり</legend>
                <div class='form-group'>
                  <label class='control-label'>キーワード</label>
                  <input class='form-control' id="keyword" placeholder='例）プログラミング' type='text' name="keyword" autocorrect="off" autocapitalize="off">
                  <p class='help-block'>いいね付与するキーワードを入力してください。</p>
                </div>
                <div class='form-group'>
                  <label class='control-label'>いいね件数</label>
                  <input class='form-control' id="like_count" placeholder=' 例）５' type='number' name="like_count" autocorrect="off" autocapitalize="off">
                  <p class='help-block'>いいね付与するツイート数を入力してください。</p>
                </div>
                <div class='form-group'>
                  <div class='form-group'>
                  <label class='control-label'>ツイートタイプ</label>
                  <select class='form-control' name="tweet_type">
                    <option>recent</option>
                    <option>pupular</option>
                    <option>mixed</option>
                  </select>
                </div>
              </fieldset>
              <div class='form-actions'>
                <button class='btn btn-default' type='submit'>Submit</button>
                <a class='btn' href='#'>Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer -->
  </body>
</html>

<?php

try{
  $dbh = new Database;
  $pdo = $dbh->getDBH();

  $tweet = new Tweet;
  $currentTime = $tweet->getCurrentTime();
  
  //POSTのValidate
  $keyword = $_POST['keyword'];
  $like_count = $_POST['like_count'];
  $tweet_type = $_POST['tweet_type'];
  $username = $_SESSION['USERNAME'] ?? 'ログインなし';

  var_dump($keyword);
  var_dump($like_count);
  var_dump($tweet_type);
  var_dump($username);
  
  $stmt = $pdo->prepare("insert into auto_like(keyword, like_count, tweet_type, user_name, created_at, updated_at) values(?, ?, ?, ?, ?, ?)");
  $stmt->execute([$keyword, $like_count, $tweet_type, $username, $currentTime, $currentTime]);

}catch (\Exception $e) {
  echo 'エラーが発生しました'. "<br/>";
  print <<<EOH
  <br>
  <br>
  <button type="submit"class="btn btn-default" onclick="location.href='./tables.php'">トップに戻る</button>
EOH;
} 