<?php

class InsertTestApipeline extends RedisTest
{
    public function executeTest()
    {

        $this->startTime();

        $this->redis->pipeline(function ($pipe) {
            for ($i = 0; $i < $this->amount; $i++) {
                $arr = array('Kenteken' => $i
                , 'Eerste Kleur' => 'Groen'
                , 'Tweede Kleur' => 'Blauw');
                $pipe->set($i, json_encode($arr));
            }
            $this->endTime();
        });
    }
}
