<?php
use RedisInsertTest;

class TestController
{

    public function Runtests()
    {
        $amounts = array(
            10
            ,100
//            ,1000
//            ,10000
        );

        foreach ($amounts as &$amount) {
//            $deleteTest = new RedisDeleteTest($amount, 'RedisDeleteTest');
//            $deleteTest->executeTest();

            $insertTest = new RedisInsertTest($amount, 'RedisInsertTest');
            $insertTest->executeTest();

//            $selectTest = new RedisSelectTest($amount, 'RedisSelectTest');
//            $selectTest->executeTest();

        }
    }
}
