<?php
require_once('../class.php');
require_once('./header.html');
require_once('./sidebar.html');
require_once('./footer.html');
session_start();

  $tweet = new Tweet();
  $favoriteRanking = $tweet->favoriteRanking();
  $retweetRanking = $tweet->retweetRanking();
  $followerRanking = $tweet->followerRanking();
?>

<!DOCTYPE html>
<html class='no-js' lang='en'>
  <body class='main page'>
    <!-- header.php -->
    <div id='wrapper'>
      <!-- Sidebar -->
      <!-- Content -->
      <div id='content'>
        <div class='panel panel-default grid'>
          <div class='panel-heading'>
            <i class='icon-table icon-large'></i>
            今までのいいね数ランキング Best3
          </div>
          <div class='panel-body'>
            <table class='table table-bordered'>
              <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Tweet</th>
                  <th>いいね数</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; while($rows = $favoriteRanking->fetch(PDO::FETCH_ASSOC)){?>
                  <tr class='table'>
                    <td width="5%"><?= $i; $i++;?></td>
                    <td width=15%"><?=htmlspecialchars($rows['name'])?></td>
                    <td width="70%"><?=htmlspecialchars($rows['contents'])?></td>
                    <td width="10%"><?=htmlspecialchars($rows['favorite_count'])?></td>
                  </tr>
                <?php }  ?>
              </tbody>
            </table>
          </div>
        </div>

        <div class='panel panel-default grid'>
          <div class='panel-heading'>
            <i class='icon-table icon-large'></i>
            今までのRT数ランキング Best3
          </div>
          <div class='panel-body'>
            <table class='table table-bordered'>
              <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Tweet</th>
                  <th>RT数</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; while($rows = $retweetRanking->fetch(PDO::FETCH_ASSOC)){?>
                  <tr class='table'>
                    <td width="5%"><?= $i; $i++;?></td>
                    <td width="15%"><?=htmlspecialchars($rows['name'])?></td>
                    <td width="70%"><?=htmlspecialchars($rows['contents'])?></td>
                    <td width="10%"><?=htmlspecialchars($rows['retweet_count'])?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>

        <div class='panel panel-default grid'>
          <div class='panel-heading'>
            <i class='icon-table icon-large'></i>
            現在のフォロワー数ランキング Best3
          </div>
          <div class='panel-body'>
            <table class='table table-bordered'>
              <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>フォロワー数</th>
                  <th>フォロー数</th>
                  <th>投稿数</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; while($rows = $followerRanking->fetch(PDO::FETCH_ASSOC)){?>
                  <tr class='table'>
                    <td width="5%"><?= $i; $i++;?></td>
                    <td width="35%"><?=htmlspecialchars($rows['name'])?></td>
                    <td width="20%"><?=htmlspecialchars($rows['followers_count'])?></td>
                    <td width="20%"><?=htmlspecialchars($rows['following_count'])?></td>
                    <td width="20%"><?=htmlspecialchars($rows['posts_count'])?></td>
                  </tr>
                <?php }  ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer -->
  </body>
</html>
