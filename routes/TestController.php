<?php

include_once('RedisTest.php');

include_once('Tests/SelectTestA.php');
include_once('Tests/SelectTestApipeline.php');

include_once('Tests/InsertTestA.php');
include_once('Tests/InsertTestApipeline.php');
include_once('Tests/InsertTestB.php');
include_once('Tests/InsertTestBpipeline.php');

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
            // A simpel zonder eigenschappen
            // B+ moeilijkere queries (niet allemaal mogelijk)
            $this->executeInsertTests($amount);

            $this->executeSelectTests($amount);

            $this->executeDeleteTests($amount);

            $this->executeUpdateTests($amount);
        }
    }

    private function executeInsertTests(mixed $amount): void
    {
        // INSERT
        //A	Insert … autos
        $insertTest = new InsertTestA($amount, 'InsertA');
        $insertTest->executeTest();
        $insertTest = new InsertTestApipeline($amount, 'InsertApipeline');
        $insertTest->executeTest();

        //B	Insert … autos met 2 kleuren
        $insertTest = new InsertTestB($amount, 'InsertB');
        $insertTest->executeTest();
        $insertTest = new InsertTestBpipeline($amount, 'InsertTestBpipeline');
        $insertTest->executeTest();

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
        $selectTest = new SelectTestA($amount, 'SelectA');
        $selectTest->executeTest();
        // B
        $selectTest = new SelectTestApipeline($amount, 'SelectApipeline');
        $selectTest->executeTest();
    }

    private function executeDeleteTests(mixed $amount)
    {
        // DELETE
        // A
        $deleteTest = new DeleteTestA($amount, 'DeleteTestA');
        $deleteTest->executeTest();
    }

    private function executeUpdateTests(mixed $amount)
    {

    }

}
