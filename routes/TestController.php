<?php

include_once('RedisTest.php');

include_once('Tests/SelectTestA.php');
include_once('Tests/SelectTestApipeline.php');

include_once('Tests/InsertTestA.php');
include_once('Tests/InsertTestApipeline.php');
include_once('Tests/InsertTestB.php');
include_once('Tests/InsertTestBpipeline.php');

include_once('Tests/RedisDeleteTest.php');

include_once('Tests/RedisUpdateTest.php');

class TestController
{

    public function Runtests()
    {
        $amounts = array(
            10
        , 1000
//            ,100000
        );

        foreach ($amounts as &$amount) {

            // maak de inserts/ selects/ updates/ deletes na die in relational db zijn gemaakt
            // A simpel zonder eigenschappen
            // B+ moeilijkere queries (niet allemaal mogelijk)

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

            // SELECT
            $selectTest = new SelectTestA($amount, 'SelectA');
            $selectTest->executeTest();
            $selectTest = new SelectTestApipeline($amount, 'SelectApipeline');
            $selectTest->executeTest();

//            $deleteTest = new RedisDeleteTest($amount, 'RedisDeleteTest');
//            $deleteTest->executeTest();
        }
    }
}
