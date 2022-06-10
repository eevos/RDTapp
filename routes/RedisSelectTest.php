<?php

class RedisSelectTest extends RedisTest
{

    public function executeTest(){

        // prepare
        for ($i = 0; $i < $this->amount; $i++){
            $this->redis->set( $i, " popteshop : " . $i);
        }


        // execute
        $this->startTime();

        for ($i = 0; $i < $this->amount; $i++) {
            $this->result .= $this->redis->get($i);
        }
        $this->endTime();
    }
}
