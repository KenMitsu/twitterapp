<?php
require_once('config.php');
require_once('class.php');
session_start();

//DB内でPOSTされたメールアドレスを検索
    $tweet = new Tweet();
    $stmt_favorite = $tweet->favorite();
    $stmt_rt = $tweet->rt();
?>




<!DOCTYPE html>
<html lang="ja">
 <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width,initial-scale=1.0">
      <link rel="stylesheet" href="c.css">
      <title>Login</title>
 </head>
 <body>
   <h1>本日のツイートランキング</h1><br>
    <table border="5" width="70%">
        <tr><th>No</th><th>名前</th><th>ツイート</th><th>いいね数</th></tr>
        <?php $i=1; while($rows = $stmt_favorite->fetch(PDO::FETCH_ASSOC)){?>
            <tr>
                <td width="5%"><?= $i; $i++;?></td>
                <td width="20%"><?=htmlspecialchars($rows['name'])?></td>
                <td width="65%"><?=htmlspecialchars($rows['contents'])?></td>
                <td width="10%"><?=htmlspecialchars($rows['favorite_count'])?></td>
            </tr>
        <?php }  ?>
        
    </table>
    <input type="button"class="square_btn2" onclick="location.href='./main.php'" value="本日の予定を取得">

    
 </body>