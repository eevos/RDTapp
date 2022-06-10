<?php

class RedisDeleteTest extends RedisTest
{

    public function executeTest()
    {

        $this->startTime();

        for ($i = 0;
             $i < $this->amount;
             $i++) {
            $this->redis->set($i, " popteshop : " . $i);
        }

        $this->endTime();
    }
}
