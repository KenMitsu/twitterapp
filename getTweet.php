<?php
require_once(__DIR__ . '/class.php');

$tweet = new Tweet;

$account_ids = ['koichiwatai', 'matouda1'];

$tweet->getTweet(10000, $account_IDs);
$tweet->redaction('user_info', 'user_id');
$tweet->redaction('tweet_info', 'contents');
?>
