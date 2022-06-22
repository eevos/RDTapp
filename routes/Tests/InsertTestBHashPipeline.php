<?php

class InsertTestBHashPipeline extends RedisTest
{
    protected $table;

    public function execute()
    {
        $this->table = DB::select(
            '
                select Kenteken, Voertuigsoort, Merk, Eerste_kleur, Tweede_kleur
                from Voertuigen
            '
        );

        $this->startTime();

        $this->redis->pipeline(function ($pipe){
            foreach ($this->table as $row) {
                $pipe->hset($row->Kenteken
                    , 'Voertuigsoort', $row->Voertuigsoort
                    , 'Eerste_kleur', $row->Eerste_kleur
                    , 'Tweede_kleur', $row->Tweede_kleur
                    , 'Voertuigsoort', $row->Voertuigsoort
                );
            }
        });

        $this->endTime();
    }
}
