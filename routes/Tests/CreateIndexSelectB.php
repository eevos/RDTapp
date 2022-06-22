<?php

class CreateIndexSelectB extends RedisTest
{

    public function execute()
    {

        $this->redis->del('indexGroen');
        $this->redis->del('indexGroenBlauw');

        $this->startTime();
        $kentekens =
            DB::select('select Kenteken
                            from Voertuigen
                            where Eerste_kleur = "groen"
                            and Tweede_kleur = "blauw"');
        $this->redis->set('indexGroenBlauw', json_encode($kentekens));

//        foreach ($kentekens as $kenteken) {
//            $this->redis->hset('indexGroen', 'Kenteken', $kenteken->Kenteken);
//        }
        $this->endTime();
    }

}
