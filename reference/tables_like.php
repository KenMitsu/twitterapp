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
      <a class='navbar-brand' href='./tables.phps'>
        <i class='icon-beer'></i>
        CINC　Twitter　System
      </a>
      <ul class='nav navbar-nav pull-right'>
        <li class='dropdown user'>
          <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
            <i class='icon-user'></i>
            <strong>Log out page</strong>
            <img class="img-rounded" src="http://placehold.it/20x20/ccc/777" />
            <b class='caret'></b>
          </a>
          <ul class='dropdown-menu'>
            <li class='divider'></li>
            <li>
              <a href="./logout.html">Log out</a>
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
          <li class='launcher dropdown hover'>
            <i class='icon-table'></i>
            <a href="#">Ranking Tables</a>
            <ul class='dropdown-menu'>
              <li class='dropdown-header'>Ranking List</li>
              <li>
                <a href='#'>いいね数ランキング</a>
              </li>
              <li>
                <a href='#'>RT数ランキング</a>
              </li>
              <li>
                <a href='#'>フォロワー数ランキング</a>
              </li>
            </ul>
          </li>
          <li class='launcher'>
            <i class='icon-dashboard'></i>
            <a href="dashboard.php">All List</a>
          </li>
          <li class='launcher'>
            <i class='icon-file-text-alt'></i>
            <a href="forms.html">Forms</a>
          </li>
        </ul>
        <div data-toggle='tooltip' id='beaker' title='Made by Mitsuishi'></div>
      </section>
      <!-- Tools -->
      <section id='tools'>
        <ul class='breadcrumb' id='breadcrumb'>
          <li class='title'>Tables</li>
        </ul>
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
                  <style>
                    td { background-color: #bde9ba; }
                  </style>
                <?php }  ?>
              </tbody>
            </table>
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
