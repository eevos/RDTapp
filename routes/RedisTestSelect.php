<?php

class RedisTestSelect extends RedisTest
{

    public function executeTest(){

        // filling table
        for ($i = 0; $i < $this->x;$i++){
            $this->redis->set( $i, " popteshop : " . $i);
        }

        $this->startTime();
        // testing logic
        for ($i = 0; $i < $this->x; $i++) {
            $this->result .= $this->redis->get($i);
        }
        $this->endTime();
    }
}
