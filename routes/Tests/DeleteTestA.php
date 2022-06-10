<?php

class DeleteTestA extends RedisTest
{

    public function executeTest()
    {

        $this->startTime();

        for ($i = 0; $i < $this->amount; $i++) {
            $this->redis->del($i);
        }

        $this->endTime();
    }
}
