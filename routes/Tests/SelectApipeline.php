<?php

class SelectApipeline extends RedisTest
{

    public function execute(){

        // prepare

        for ($i = 0; $i < $this->amount; $i++){
            $this->redis->set( $i, " ABCD : " . $i);
        }

        // execute
        $this->startTime();

        $this->redis->pipeline(function ($pipe){
            for ($i = 0; $i < $this->amount; $i++) {
               $pipe->get($i);
            }
        });

        $this->endTime();
    }
}
