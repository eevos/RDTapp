<?php

class InsertAll_SelectF extends RedisTest
{
    protected $table;

    public function execute()
    {
        $this->table = DB::select(
            '
                select Kenteken, Voertuigsoort, Merk, Eerste_kleur, Tweede_kleur, Datum_tenaamstelling
                       ,Aantal_cilinders,Cilinderinhoud,Massa_ledig_voertuig,Toegestane_maximum_massa_voertuig
                        ,Massa_rijklaar,Datum_eerste_toelating,Wacht_op_keuren
                from Voertuigen
            '
        );

        $this->startTime();

        $this->redis->pipeline(function ($pipe) {
            $i = 0;
            foreach ($this->table as $row) {
                $pipe->hset($row->Kenteken
                    , 'Voertuigsoort', $row->Voertuigsoort
                    , 'Merk', $row->Merk
                    , 'Voertuigsoort', $row->Voertuigsoort
                    , 'Eerste_kleur', $row->Eerste_kleur
                    , 'Tweede_kleur', $row->Tweede_kleur
                    , 'Datum_tenaamstelling', $row->Datum_tenaamstelling
                    , 'Aantal_cilinders', $row->Aantal_cilinders
                    , 'Cilinderinhoud', $row->Cilinderinhoud
                    , 'Toegestane_maximum_massa_voertuig', $row->Toegestane_maximum_massa_voertuig
                    , 'Massa_rijklaar', $row->Massa_rijklaar
                    , 'Datum_eerste_toelating', $row->Datum_eerste_toelating
                    , 'Wacht_op_keuren', $row->Wacht_op_keuren
                );

                $i++;
                if (($i == $this->amount) || ($i == count($this->table))) {
                    break;
                }
            }
        });

        $this->endTime();

//        $this->redis->flushdb();

    }
}
