<?php
require_once(__DIR__ . '/vendor/autoload.php');
//ini_set('display_errors', 1);

//消えた昔の DBH 
//define('DSN', 'pgsql:host=ec2-54-211-55-24.compute-1.amazonaws.com;dbname=db0gg9nfh4bcu6');
//define('USER', 'utmjoeacgsbrtj');
//define('PASS', 'af535ec75c89b18f78bf43b140f9dbc36bb83651f6c68d18802766184c85e384');

//cinctwitterapp 最新の DBH 
define('DSN', 'pgsql:host=ec2-23-21-229-200.compute-1.amazonaws.com;dbname=db9s9flfhkkhds');
define('USER', 'eqrkfxfxalybfu');
define('PASS', '17e8e7922c958fa03954a9dc45b9e0e40eb755bc8d2fd91c2851ab0138fc9d2d');

//KenshiroBOTアカウント
define('CONSUMER_KEY', 'Ub9tfamsJZumyBAEyVnrGk61l');
define('CONSUMER_SECRET', 'XVc1jQkKmARwVcY5HbNbrtAcGo9UKnz7iAXj97JwHW4aV16dW5');
define('ACCESS_TOKEN', '1349430242809532418-GGb3DiaVPzF0TjESnNhgr3I22A9dlr');
define('ACCESS_TOKEN_SECRET', 'HBAatxihia3ZAI0rV9IGymsC6uHVBRFyo8CqJejDDRvFC');


//SEO運用アカウント
/*
define('CONSUMER_KEY', 'VyVWxGFvvJRVUlID0Db0fDfQG');
define('CONSUMER_SECRET', 'QspA5uKltPv9Pm69sVQ6Ja0TChkuWE2a3qfw5CwD4lv7qUiAB0');
define('ACCESS_TOKEN', '1026662805221437441-HbhCerssmsLCUyiL6bTu941hrYw2hZ');
define('ACCESS_TOKEN_SECRET', 'F5uGgjMh4cGr6lldshARLtcnAMEdocBtXpHQSvG8LWaIp');
*/
?>