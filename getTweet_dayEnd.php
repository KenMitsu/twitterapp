<?php
require_once(__DIR__ . '/class.php');

$tweet = new Tweet;
$tweet->getTweet(20);
$tweet->redaction('user_info', 'user_id');
$tweet->redaction('tweet_info', 'contents');
?>
