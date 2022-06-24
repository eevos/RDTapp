<?php
include_once('InsertAll_SelectF.php');

class CreateIndex_SelectF extends RedisTest
{

    private $table;

    public function execute()
    {
        // first remove old index
        $this->redis->del('index_SelectF_MerkEersteKleur');

        $this->startTime();

        //get temptable
        $this->table =
            DB::select("    select Kenteken
                            from Voertuigen
                            where Eerste_kleur = 'groen'
                            and Merk = 'Volkswagen'
                            ");
        //create index with temptable
        $this->redis->pipeline(function ($pipe) {
            foreach ($this->table as $row) {
                $pipe->sadd('index_SelectF_MerkEersteKleur', $row->Kenteken);
            }
        });

        //create database : insert all
        $insert = new InsertAll_SelectF(1000000);
        $insert->execute();

        $this->endTime();

    }

}
