<?php

class InsertTestB extends RedisTest
{

    public function execute()
    {


        $this->startTime();
        for ($i = 0; $i < $this->amount; $i++) {
            $arr = array('Kenteken' => $i
            , 'Eerste Kleur' => 'Groen'
            , 'Tweede Kleur' => 'Blauw'
            , 'Soort Voertuig' => 'Personenwagen'
            );
            $this->redis->set($i, json_encode($arr));
        }
        $this->endTime();
    }
}
