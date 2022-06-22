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
        DB::insert("INSERT INTO rdtapp.TestRuns (name, executionTime, amount)
                                VALUES ('$this->testName', '$time', '$this->amount')");
    }
}
