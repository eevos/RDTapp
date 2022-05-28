<?php
include_once('functions.php');

class RedisQuery
{

    public function returnResult(){
        $redis = connectToRedis();

        $result = '';
        for ($i = 0; $i<1000;$i++){
            $redis->set( $i, " popteshop : " . $i);
        }

        // starttime
        $startTime = microtime(true);
        $result = 'starttime : 0 - ';
        $result .= "<br>";

        for ($i = 0; $i<100; $i++) {
            $result .= $redis->get($i);
        }
        // endtime
        $endTime = microtime(true);
        $actual = $endTime - $startTime;
        $result .= 'endtime 1000 : ' . $actual;
        $result .= "<br>";

        return $result;
    }


}
