<?php
include_once('functions.php');
use Illuminate\Support\Facades\DB;

abstract class RedisTest
{
    protected \Predis\Client $redis;
    protected int $amount;
    protected $startTime;
    protected $endTime;
    protected string $result;
    protected string $testName;

    function __construct(int $amount){
        $this->redis    = connectToRedis();
        $this->amount   = $amount;
        $this->result   = '';
        $this->testName = get_class($this);
    }
    public function execute(){

    }

    protected function startTime(){
        $this->startTime = microtime(true);
    }

    protected function endTime(){
        $this->endTime = microtime(true);

        $this->logExecutionTime(($this->endTime - $this->startTime));

    }
    protected function logExecutionTime($time){
        $itemsInRedisDB = $this->redis->dbsize();
        $usedMemoryMB = $this->redis->info()['Memory']['used_memory'] / 1000;

        DB::insert("INSERT INTO rdtapp.TestRuns (name, executionTime, amount, numberOfItems, usedMemoryMB)
                                VALUES ('$this->testName', '$time', '$this->amount', '$itemsInRedisDB','$usedMemoryMB')");
    }
}
