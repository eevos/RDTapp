<?php

class InsertCHashPipeline extends RedisTest
{
    protected $table;

    public function execute()
    {
        $this->table = DB::select(
            '
                select 		V.Kenteken, V.Voertuigsoort, V.Merk, V.Eerste_kleur, V.Tweede_kleur
                            , Kmg.Melddatum
                            , Se.Soort_omschrijving
                from 		Voertuigen V
                inner join 	rdtapp.Keuring_met_gebrek Kmg 	on Kmg.Kenteken = V.Kenteken
                inner join 	rdtapp.Soort_erkenning Se		on Kmg.Soort_erkenning = Se.Soort
            '
        );

        $this->startTime();

        $this->redis->pipeline(function ($pipe){
            $i = 0;
            foreach ($this->table as $row) {
                $pipe->hset($row->Kenteken
                    , 'Voertuigsoort', $row->Voertuigsoort
                    , 'Eerste_kleur', $row->Eerste_kleur
                    , 'Tweede_kleur', $row->Tweede_kleur
                    , 'Voertuigsoort', $row->Voertuigsoort
                    , 'Melddatum', $row->Melddatum
                    , 'Soort_omschrijving', $row->Soort_omschrijving
                );

                $i++;
                if($i == $this->amount){break;}
            }
        });

        $this->endTime();

    }
}
