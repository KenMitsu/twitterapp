<?php

redaction('tweet_info', 'contents');
redaction('user_info', 'name');

function redaction($table_name, $column){
    $DSN = 'pgsql:host=ec2-54-211-55-24.compute-1.amazonaws.com;dbname=db0gg9nfh4bcu6';
    $USER  = 'utmjoeacgsbrtj';
    $PASS = 'af535ec75c89b18f78bf43b140f9dbc36bb83651f6c68d18802766184c85e384';

    try {
        $dbh = new PDO($DSN, $USER, $PASS);

        $delete = "DELETE FROM $table_name
                    WHERE id NOT IN (
                      SELECT id FROM(
                        SELECT * FROM $table_name AS t1
                        WHERE 1 = (
                          SELECT COUNT(*) FROM $table_name AS t2
                          WHERE t1.$column = t2.$column
                          AND t1.id <= t2.id
                        )
                      ) AS tmp
                    )";
        $delete_result = $dbh->query($delete);

        echo "整理が完了しました";
        $dbh = null;
    } catch (PDOException $e) {
        print "DB ERROR: " . $e->getMessage() . "<br/>";
        die();
    }
}
