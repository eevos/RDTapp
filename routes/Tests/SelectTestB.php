<?php

class SelectTestB extends RedisTest
{

    public function execute()
    {

        $this->startTime();
//        $kentekens =
//            DB::select('select Kenteken
//                            from Voertuigen
//                            where Eerste_kleur = "groen"');
//        $this->redis->set('indexGroen', json_encode($kentekens));
        $kentekensFromIndex = json_decode($this->redis->get('indexGroen'));
//        $kentekens = json_decode($this->redis->hget('indexGroen','Kenteken'));

        foreach ($kentekensFromIndex->Kenteken as $kenteken )
        {
            // get 10 / 1000 / 100 000 specific kenteken from redis Hash (?)
            // first: insert all these kentekens from DB :-)
        }
        $this->endTime();
        $AB = $this->redis->hvals('0001ES');
        $AA = $this->redis->hmget('0001ES', 'Voertuigsoort', 'Eerste_kleur');

    }

}
