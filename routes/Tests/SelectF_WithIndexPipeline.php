<?php

class SelectF_WithIndexPipeline extends RedisTest
{
    public function execute()
    {

        $this->startTime();

        //get items from index
        $this->table = $this->redis->smembers('index_SelectF_MerkEersteKleur');


        //use items to get results from redis db (Hash)
        $this->redis->pipeline(function ($pipe) {
            foreach ( $this->table  as $kenteken) {
                array_push($this->resultArray, $this->redis->hgetall($kenteken));
            }
        });

        $this->endTime();
    }
}
