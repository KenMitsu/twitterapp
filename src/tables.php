<?php
require_once('../class.php');
require_once('./header.php');
require_once('./sidebar.html');
require_once('./footer.html');
session_start();
    $tweet = new Tweet();
    $favoriteRanking = $tweet->favoriteRanking();
    $todaysTweet = $tweet->todaysTweet();
    $retweetRanking = $tweet->retweetRanking();
  
?>

<!DOCTYPE html>
<html class='no-js' lang='en'>
  <body class='main page'>
    <!-- Navbar -->
    <div id='wrapper'>
      <!-- Sidebar -->
      <!-- Content -->
      <div id='content'>
        <div class='panel panel-default grid'>
          <div class='panel-heading'>
            <i class='icon-table icon-large'></i>
            本日のいいね数ランキング Best3
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
            本日のRT数ランキング Best3
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
            本日のツイート一覧
            <div class='panel-tools'>
              <div class='btn-group'>
                <a class='btn' data-toggle='toolbar-tooltip' href='./tables.php' title='Reload'>
                  <i class='icon-refresh'></i>
                </a>
              </div>
            </div>
          </div>
          <table class='table'>
            <thead>
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Tweet</th>
                <th>いいね数</th>
                <th class='actions'>Twitterへ</th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1; while($rows = $todaysTweet->fetch(PDO::FETCH_ASSOC)){?>
                <tr class='table'>
                  <td width="5%"><?= $i; $i++;?></td>
                  <td width=20%"><?=htmlspecialchars($rows['name'])?></td>
                  <td width="65%"><?=htmlspecialchars($rows['contents'])?></td>
                  <td width="5%"><?=htmlspecialchars($rows['favorite_count'])?></td>
                  <td width="5%" class='action'>
                    <a class='btn btn-success' data-toggle='tooltip' href='#' title='Zoom'>
                      <i class='icon-zoom-in'></i>
                    </a>
                  </td>
                </tr>
              <?php }  ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- Footer -->
  </body>
</html>
