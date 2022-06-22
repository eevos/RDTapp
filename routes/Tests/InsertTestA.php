<?php

class InsertTestA extends RedisTest
{

    public function execute(){

        $this->startTime();

        for ($i = 0; $i < $this->amount; $i++){
            $this->redis->set( $i, " ABCD : " . $i);
        }

        $this->endTime();
        $this->redis->flushdb();
    }
}
