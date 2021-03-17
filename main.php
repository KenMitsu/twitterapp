<?php
require_once(__DIR__ . '/class.php');
require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/redaction.php');

$tweet = new Tweet;
$tweet->getTweet();

?>
<input type="button"class="square_btn2" onclick="location.href='./reference/tables.php'" value="メイン画面へ戻る">

00 13 * * * /usr/bin/php /Users/mitsuishikenshirou/Desktop/PHP_samplefile/twitterapp/main.php