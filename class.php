<?php
require_once(__DIR__ . '/config.php');
use Abraham\TwitterOAuth\TwitterOAuth;

class Database
{
    public function getDBH()
        {
            try {
                $dbh = new PDO(DSN, USER, PASS);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
                $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
                return $dbh;
            } catch (PDOException $e) {
                print "DB ERROR: " . $e->getMessage() . "<br/>";
                die();
            }
        }
}


class Tweet
{
    public function __construct() //newした時に実行される
        {
            $db = new Database;
            $this->dbh = $db->getDBH(); //なぜここでthisが出てくるのだろうか。上で呼び出したとしてもDatabaseクラスにはdbhは定義していない
        }

    public function test()
        {
            try{
                $sql="SELECT contents FROM tweet_info where name = 'とべちゃん /// 採用*広報' ";
                $stmt = $this->dbh->prepare($sql);
                $stmt->execute([]);
                $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
                print_r($rows);
              }catch(PDOException $e){
                die($e->getMessage());
              }
        }
    public function tweetlist_all()
        {
            try{
                $sql="SELECT name, contents, favorite_count FROM tweet_info ORDER BY favorite_count desc";
                $stmt = $this->dbh->prepare($sql);
                $stmt->execute([]);  
                return $stmt;
              }catch(PDOException $e){
                die($e->getMessage());
            }
        }
    public function favorite_best3()
        {
            try{
                $sql="SELECT name, contents, favorite_count FROM tweet_info ORDER BY favorite_count desc limit 3";
                $stmt = $this->dbh->prepare($sql);
                $stmt->execute([]);  
                return $stmt;
              }catch(PDOException $e){
                die($e->getMessage());
            }
        }
    public function rt_best3()
        {
            try{
                $sql="SELECT name, contents, retweet_count FROM tweet_info ORDER BY retweet_count desc limit 3";
                $stmt = $this->dbh->prepare($sql);
                $stmt->execute([]);  
                return $stmt;
              }catch(PDOException $e){
                die($e->getMessage());
            }
        }
    public function followers_best3()
        {
            try{
                $sql="SELECT name, followers_count, following_count, posts_count FROM user_info ORDER BY followers_count desc limit 3";
                $stmt = $this->dbh->prepare($sql);
                $stmt->execute([]);  
                return $stmt;
              }catch(PDOException $e){
                die($e->getMessage());
            }
        }

    public function getTweet($screenname)
        {
            print_r('getTweetにきてはいるよ')."<br/>";    
            date_default_timezone_set('Asia/Tokyo');

            try{
                $sql_user = 'INSERT INTO user_info (name, followers_count, following_count, posts_count, latest_date) VALUES (?, ?, ?, ?, ?)';
                $sql_tweet = 'INSERT INTO tweet_info (name, contents, favorite_count, retweet_count, tweeted_at) VALUES (?, ?, ?, ?, ?)';
                $stmt_user = $this->dbh->prepare($sql_user);
                $stmt_tweet = $this->dbh->prepare($sql_tweet);
    
                $dbh = null;
            } catch(PDOException $e) {
                die($e->getMessage()."<br/>");
            }
            print_r('Twitter取得前です')."<br/>";
            $connection = new TwitterOAuth(
                CONSUMER_KEY, 
                CONSUMER_SECRET, 
                ACCESS_TOKEN, 
                ACCESS_TOKEN_SECRET
            );
            print_r('Twitter取得にきてはいるよ')."<br/>";
            $statuses = $connection->get('statuses/user_timeline',
                array(
                    // ユーザー名（@は不要）
                    'screen_name'       => $screenname,
                    // ツイート件数
                    'count'             => '5',
                    // リプライを除外するかを、true（除外する）、false（除外しない）で指定
                    'exclude_replies'   => 'false',
                    // リツイートを含めるかを、true（含める）、false（含めない）で指定
                    'include_rts'       => 'true',
                    //falseで、取得した各ツイートデータ内にあるentities（メディア、ハッシュタグ、メンションなどを構造化したデータ）が除外される
                    //"include_entities" => 'false',
                )
            );

            if(isset($statuses->errors)){
                echo 'Error occurred.'.PHP_EOL;
                echo 'Error message:'.$statuses->errors[0]->message.PHP_EOL;
            }else{
                print_r('foreeach手前っす');
                foreach($statuses as $tweet){
                    $name = $tweet->user->name;
                    $followers_count = $tweet->user->followers_count;
                    $following_count = $tweet->user->friends_count;
                    $posts_count = $tweet->user->statuses_count;
        
                    $contents = $tweet->text;
                    $favorite_count = $tweet->favorite_count;
                    $retweet_count = $tweet->retweet_count;
                    $tweeted_at = $this->getTime($tweet->created_at);
                    if(!($tweeted_at === "本日の日付ではありません")){
                        $stmt_tweet->execute(array($name, $contents, $favorite_count, $retweet_count, $tweeted_at));
                        $rows_tweet=$stmt_tweet->fetchAll(PDO::FETCH_ASSOC);
                        echo "：取得に成功しました".'<br />';
                    }
                }
                
                $today = date("Y/m/d");
                //$tomorrow = strtotime("+1 day", $today);
                //$jp_time = date('Y/m/d', $tomorrow);
                $stmt_user->execute(array($name, $followers_count, $following_count, $posts_count, $today));   
                $rows_user=$stmt_user->fetchAll(PDO::FETCH_ASSOC);
            }
        }
    
    private function getTime($t) //Tue Feb 02 20:46:21 +0000 2021
        {
            date_default_timezone_set('Asia/Tokyo');
            $today = strtotime(date("Y/m/d 00:00:00"));
            $tomorrow = strtotime("+1 day", $today);
            
            $timestamp = strtotime($t);//1612298781
            $jp_time = date('Y-m-d H:i:s', $timestamp);//形を戻す　2021-02-03 05:46:21
            if($today < $timestamp && $timestamp < $tomorrow){
                return $jp_time;
            }else{
                return "本日の日付ではありません";
            }
        }
        
}