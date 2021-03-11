<?php
session_start();
require_once(__DIR__ . '/class.php');
require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/redaction.php');

print_r('Hello');

$myExec = new Tweet;

$myExec->getTweet('_tobechang_');
$myExec->getTweet('seiya_TA05');
$myExec->getTweet('iwaomorning');
$myExec->getTweet('grisoluto');
$myExec->getTweet('koichiwatai');
$myExec->getTweet('cinc_analytics');
$myExec->getTweet('yamaji_ryota');

//$myExec->test();
/*
getTweet('_tobechang_');
getTweet('seiya_TA05');
getTweet('iwaomorning');
getTweet('grisoluto');
getTweet('yamaji_ryota');
getTweet('cinc_analytics');
getTweet('koichiwatai');
*/

/*
redaction('user_info', 'name');
redaction('tweet_info', 'contents');
*/
//phpinfo();


?>
<input type="button"class="square_btn2" onclick="location.href='./tweet_result.php'" value="メイン画面へ戻る">

