<?php

include_once('RedisTest.php');

include_once('Tests/SelectA.php');
include_once('Tests/SelectApipeline.php');
include_once('Tests/CreateIndex_SelectF.php');
include_once('Tests/SelectB.php');
include_once('Tests/SelectF_WithIndexPipeline.php');

include_once('Tests/InsertTestA.php');
include_once('Tests/InsertApipeline.php');
include_once('Tests/InsertTestB.php');
include_once('Tests/InsertTestBpipeline.php');
include_once('Tests/InsertBHashPipeline.php');
include_once('Tests/InsertCHashPipeline.php');
include_once('Tests/InsertDHashPipeline.php');

include_once('Tests/DeleteTestA.php');
include_once('Tests/DeleteTestApipeline.php');

include_once('Tests/RedisUpdateTest.php');

class TestController
{
    protected $amounts = array();

    /**
     * @param int[] $amount
     */
    public function __construct()
    {
        $this->amounts = array(
            10, 1000
//            ,100000
        );
    }

    public function Runtests()
    {


        foreach ($this->amounts as &$amount) {

            // maak de inserts/ selects/ updates/ deletes na die in relational db zijn gemaakt
            // A simpel zonder eigenschappen, B+ moeilijkere queries (niet allemaal mogelijk)

//            $this->executeInsertTests($amount);
            $this->executeSelectTests($amount);
//            $this->executeDeleteTests($amount);
//            $this->executeUpdateTests($amount);

            $redis    = connectToRedis();
            $redis->flushdb();
        }

    }

    private function executeInsertTests(mixed $amount): void
    {
        // INSERT
        //A	Insert … autos
        $insertTest = new InsertTestA($amount);
        $insertTest->execute();
        $this->redis->flushdb();

        $insertTest = new InsertApipeline($amount);
        $insertTest->execute();
        $this->redis->flushdb();

        //B	Insert … autos met 2 kleuren
        $insertTest = new InsertTestB($amount);
        $insertTest->execute();
        $this->redis->flushdb();

        $insertTest = new InsertTestBpipeline($amount);
        $insertTest->execute();
        $this->redis->flushdb();

        $insertTest = new InsertBHashPipeline($amount);
        $insertTest->execute();
        $this->redis->flushdb();

        $insertTest = new InsertCHashPipeline($amount);
        $insertTest->execute();
        $this->redis->flushdb();

        $insertTest = new InsertDHashPipeline($amount);
        $insertTest->execute();
        $this->redis->flushdb();




//        $insertTest = new CreateIndexSelectTestB(1, 'CreateIndexSelectTestB');
//        $insertTest->execute();

        //C	Insert … autos met 2 kleuren, 1 voertuigkeuringen
//            $insertTest = new InsertTestC($amount, 'InsertC');
//            $insertTest->executeTest();

        //D	Insert … autos met 2 kleuren, 1 voertuigkeuringen, 1 keuring met gebrek, met 2 geconstateerde gebreken
//            $insertTest = new InsertTestD($amount, 'InsertD');
//            $insertTest->executeTest();
    }

    private function executeSelectTests(mixed $amount)
    {
        // SELECT
        // A
        $selectTest = new SelectA($amount);
        $selectTest->execute();
        $selectTest = new SelectApipeline($amount);
        $selectTest->execute();

        // B
        $insertTest = new CreateIndex_SelectF(1);
        $insertTest->execute();
//        $selectTest = new SelectB($amount);
//        $selectTest->execute();
        $selectTest = new SelectF_WithIndexPipeline($amount);
        $selectTest->execute();


    }

    private function executeDeleteTests(mixed $amount)
    {
        // DELETE
        // A
        $deleteTest = new DeleteTestA($amount, 'DeleteTestA');
        $deleteTest->execute();
    }

    private function executeUpdateTests(mixed $amount)
    {

    }

}
