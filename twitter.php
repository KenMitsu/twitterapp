
<?php

    getTweetTest();

    function getTweetTest()
        {
            // TwitterOAuthを利用するためComposerのautoload.phpを読み込み
            require __DIR__ . '/vendor/autoload.php';
            // TwitterOAuthクラスをインポート
            use Abraham\TwitterOAuth\TwitterOAuth;
        
            //Twitter developersから取得した値を代入
            //マーケ×エンジニア　SEO運用中アカウント
            $consumerKey = 'VyVWxGFvvJRVUlID0Db0fDfQG';
            $consumerSecret = 'QspA5uKltPv9Pm69sVQ6Ja0TChkuWE2a3qfw5CwD4lv7qUiAB0';
            $accessToken = '1026662805221437441-HbhCerssmsLCUyiL6bTu941hrYw2hZ';
            $accessTokenSecret = 'F5uGgjMh4cGr6lldshARLtcnAMEdocBtXpHQSvG8LWaIp';
        
        
            //検索ワードやパラメータを指定①
            $quary = 'ヨルシカ';
        
            $connection = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
            //$quaryの条件でツイートを検索
            $statuses = $connection->get('search/tweets',['q' => $quary, 'count' => 5, 'tweet_mode' => 'extended']);
        
            if(isset($statuses->errors)) {
                //取得失敗
                echo 'Error occurred. ';
                echo 'Error message: ' . $statuses->errors[0]->message;
            } else {
                //検索結果がない場合はメッセージを表示
                if(count($statuses->statuses)==0)echo '該当するツイートはありませんでした。';
        
                //取得成功②
                foreach($statuses->statuses as $tweet){
                        echo '<p>';
                        echo 'ステータスID: ' . $tweet->id . '<br>';
                        echo '名前: ' . $tweet->user->name . '<br>';
                        echo 'ユーザー名(screen_name): ' . $tweet->user->screen_name . '<br>';
                        echo 'ツイート本文: ' . $tweet->full_text . '<br>';
                        echo '作成日: ' . date('Y-m-d H:i:s', strtotime($tweet->created_at)) . '<br>';
                        echo 'ツイート: ' . $tweet->source . '<br>';
                        echo 'リツイート数: ' . $tweet->retweet_count . '<br>';
                        echo 'いいね数: ' . $tweet->favorite_count;
                        echo '</p>';
                }
            }
        }
?>