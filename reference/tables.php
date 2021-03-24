<?php
require_once('../config.php');
require_once('../class.php');
session_start();

//DB内でPOSTされたメールアドレスを検索
    $tweet = new Tweet();
    $stmt_tweetlist_all = $tweet->tweetlist_all();
    $stmt_favorite_best3 = $tweet->favorite_best3();
    $stmt_rt_best3 = $tweet->rt_best3();
    $stmt_followers_best3 = $tweet->followers_best3();

    $dbh = new Database();
    $pdo = $dbh->getDBH();
    $stmt_nickname = $pdo->prepare('select * from userdata where username = ?');
    $stmt_nickname->execute([$_POST['username']]);
    $row = $stmt_nickname->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html class='no-js' lang='en'>
  <head>
    <meta charset='utf-8'>
    <meta content='IE=edge,chrome=1' http-equiv='X-UA-Compatible'>
    <title>Tables</title>
    <meta content='lab2023' name='author'>
    <meta content='' name='description'>
    <meta content='' name='keywords'>
    <link href="assets/stylesheets/application-a07755f5.css" rel="stylesheet" type="text/css" /><link href="//netdna.bootstrapcdn.com/font-awesome/3.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/images/favicon.ico" rel="icon" type="image/ico" />
    
  </head>
  <body class='main page'>
    <!-- Navbar -->
    <div class='navbar navbar-default' id='navbar'>
      <a class='navbar-brand' href='#'>
        <i class='icon-beer'></i>
        CINC　Twitter　System
      </a>
      <ul class='nav navbar-nav pull-right'>
        <li class='dropdown user'>
          <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
            <i class='icon-user'></i>
            <strong>$row['nickname'];</strong>
            <img class="img-rounded" src="http://placehold.it/20x20/ccc/777" />
            <b class='caret'></b>
          </a>
          <ul class='dropdown-menu'>
            <li class='divider'></li>
            <li>
              <a href="./logout.html">Sign out</a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
    <div id='wrapper'>



      <!-- Sidebar -->
      <section id='sidebar'>
        <i class='icon-align-justify icon-large' id='toggle'></i>
        <ul id='dock'>
          <li class='launcher'>
            <i class='icon-dashboard'></i>
            <a href="dashboard.php">Dashboard</a>
          </li>
          <li class='launcher'>
            <i class='icon-file-text-alt'></i>
            <a href="forms.html">Forms</a>
          </li>
          <li class='active launcher'>
            <i class='icon-table'></i>
            <a href="tables.php">Tables</a>
          </li>
          <li class='launcher dropdown hover'>
            <i class='icon-flag'></i>
            <a href='#'>Reports</a>
            <ul class='dropdown-menu'>
              <li class='dropdown-header'>Launcher description</li>
              <li>
                <a href='#'>Action</a>
              </li>
              <li>
                <a href='#'>Another action</a>
              </li>
              <li>
                <a href='#'>Something else here</a>
              </li>
            </ul>
          </li>
          <li class='launcher'>
            <i class='icon-bookmark'></i>
            <a href='#'>Bookmarks</a>
          </li>
          <li class='launcher'>
            <i class='icon-cloud'></i>
            <a href='#'>Backup</a>
          </li>
          <li class='launcher'>
            <i class='icon-bug'></i>
            <a href='#'>Feedback</a>
          </li>
        </ul>
        <div data-toggle='tooltip' id='beaker' title='Made by lab2023'></div>
      </section>
      <!-- Tools -->
      <section id='tools'>
        <ul class='breadcrumb' id='breadcrumb'>
          <li class='title'>Tables</li>
          <li><a href="#">Lorem</a></li>
          <li class='active'><a href="#">ipsum</a></li>
        </ul>
        <div id='toolbar'>
          <div class='btn-group'>
            <a class='btn' data-toggle='toolbar-tooltip' href='#' title='Building'>
              <i class='icon-building'></i>
            </a>
            <a class='btn' data-toggle='toolbar-tooltip' href='#' title='Laptop'>
              <i class='icon-laptop'></i>
            </a>
            <a class='btn' data-toggle='toolbar-tooltip' href='#' title='Calendar'>
              <i class='icon-calendar'></i>
              <span class='badge'>3</span>
            </a>
            <a class='btn' data-toggle='toolbar-tooltip' href='#' title='Lemon'>
              <i class='icon-lemon'></i>
            </a>
          </div>
        </div>
      </section>



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
                <?php $i=1; while($rows = $stmt_favorite_best3->fetch(PDO::FETCH_ASSOC)){?>
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
            本日のRT数ランキング　Best3
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
                <?php $i=1; while($rows = $stmt_rt_best3->fetch(PDO::FETCH_ASSOC)){?>
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
            フォロワー数ランキング　Best3
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
                <?php $i=1; while($rows = $stmt_followers_best3->fetch(PDO::FETCH_ASSOC)){?>
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

        <div class='panel panel-default grid'>
          <div class='panel-heading'>
            <i class='icon-table icon-large'></i>
            本日のツイート一覧
            <div class='panel-tools'>
              <div class='btn-group'>
                <a class='btn' href='#'>
                  <i class='icon-wrench'></i>
                  Settings
                </a>
                <a class='btn' href='#'>
                  <i class='icon-filter'></i>
                  Filters
                </a>
                <a class='btn' data-toggle='toolbar-tooltip' href='#' title='Reload'>
                  <i class='icon-refresh'></i>
                </a>
              </div>
              <div class='badge'>3 record</div>
            </div>
          </div>
          <div class='panel-body filters'>
            <div class='row'>
              <div class='col-md-9'>
                Add your custom filters here...
              </div>
              <div class='col-md-3'>
                <div class='input-group'>
                  <input class='form-control' placeholder='Quick search...' type='text'>
                  <span class='input-group-btn'>
                    <button class='btn' type='button'>
                      <i class='icon-search'></i>
                    </button>
                  </span>
                </div>
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
                <th class='actions'>
                  Actions
                </th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1; while($rows = $stmt_tweetlist_all->fetch(PDO::FETCH_ASSOC)){?>
                <tr class='table'>
                  <td width="5%"><?= $i; $i++;?></td>
                  <td width=15%"><?=htmlspecialchars($rows['name'])?></td>
                  <td width="65%"><?=htmlspecialchars($rows['contents'])?></td>
                  <td width="5%"><?=htmlspecialchars($rows['favorite_count'])?></td>
                  <td width="10%" class='action'>
                    <a class='btn btn-success' data-toggle='tooltip' href='#' title='Zoom'>
                      <i class='icon-zoom-in'></i>
                    </a>
                    <a class='btn btn-info' href='#'>
                      <i class='icon-edit'></i>
                    </a>
                    <a class='btn btn-danger' href='#'>
                      <i class='icon-trash'></i>
                    </a>
                  </td>
                </tr>
              <?php }  ?>
            </tbody>
          </table>

          <div class='panel-footer'>
            <ul class='pagination pagination-sm'>
              <li>
                <a href='#'>«</a>
              </li>
              <li class='active'>
                <a href='#'>1</a>
              </li>
              <li>
                <a href='#'>2</a>
              </li>
              <li>
                <a href='#'>3</a>
              </li>
              <li>
                <a href='#'>4</a>
              </li>
              <li>
                <a href='#'>5</a>
              </li>
              <li>
                <a href='#'>6</a>
              </li>
              <li>
                <a href='#'>7</a>
              </li>
              <li>
                <a href='#'>8</a>
              </li>
              <li>
                <a href='#'>»</a>
              </li>
            </ul>
            <div class='pull-right'>
              Showing 1 to 10 of 32 entries
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- Footer -->
    <!-- Javascripts -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" type="text/javascript"></script><script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js" type="text/javascript"></script><script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js" type="text/javascript"></script><script src="assets/javascripts/application-985b892b.js" type="text/javascript"></script>
    <!-- Google Analytics -->
    <script>
      var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
      (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
      g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
      s.parentNode.insertBefore(g,s)}(document,'script'));
    </script>
  </body>
</html>
