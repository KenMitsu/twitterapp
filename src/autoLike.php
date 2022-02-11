<?php
require_once('../class.php');
require_once('./header.html');
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
            <form>
              <fieldset>
                <legend>いいね付与する条件を指定</legend>
                <div class='form-group'>
                  <label class='control-label'>キーワード</label>
                  <input class='form-control' placeholder='例）プログラミング'>
                  <p class='help-block'>いいね付与するキーワードを入力してください。</p>
                </div>
                <div class='form-group'>
                  <label class='control-label'>いいね件数</label>
                  <input class='form-control' placeholder=' 例）５'>
                  <p class='help-block'>いいね付与するツイート数を入力してください。</p>
                </div>
                <div class='form-group'>
                  <div class='form-group'>
                  <label class='control-label'>ツイートタイプ</label>
                  <select class='form-control'>
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
