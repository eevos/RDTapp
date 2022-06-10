<?php

class RedisInsertTest extends RedisTest
{

    public function executeTest(){

        // prepare


        // execute
        $this->startTime();

        for ($i = 0; $i < $this->amount; $i++){
            $this->redis->set( $i, $i . " -ABC- " . $i);
        }
        $this->endTime();
    }
}
