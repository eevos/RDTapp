<?php

class DeleteTestA extends RedisTest
{

    public function execute()
    {

        // prepare
        for ($i = 0; $i < $this->amount; $i++) {
            $this->redis->set($i, " ABCD : " . $i);
        }

        // execute
        $this->startTime();

        for ($i = 0; $i < $this->amount; $i++) {
            $this->redis->del($i);
        }

        $this->endTime();
    }
}
