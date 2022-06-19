<?php

class InsertTestBhash extends RedisTest
{

    public function execute()
    {

        $table = DB::select(
            '
                select Kenteken, Voertuigsoort, Merk, Eerste_kleur, Tweede_kleur
                from Voertuigen
            '
        );

        $this->startTime();


        foreach ($table as $row) {
            $this->redis->hset($row->Kenteken
                , 'Voertuigsoort', $row->Voertuigsoort
                , 'Eerste_kleur', $row->Eerste_kleur
                , 'Tweede_kleur', $row->Tweede_kleur
                , 'Voertuigsoort', $row->Voertuigsoort
            );
        }
        $AB = $this->redis->hvals('0001ES');
        $AA = $this->redis->hmget('0001ES', 'Voertuigsoort', 'Eerste_kleur');


        $this->endTime();
    }
}

//'AA', ['Groen', 'Blauw', 'Personenwagen']);
