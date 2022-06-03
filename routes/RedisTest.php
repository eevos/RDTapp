<?php
include_once('functions.php');
use Illuminate\Support\Facades\DB;

abstract class RedisTest
{
    protected \Predis\Client $redis;
    protected int $x;
    protected $startTime;
    protected $endTime;
    protected string $result;

    function __construct(int $xinput){
        $this->redis    = connectToRedis();
        $this->x        = $xinput;
        $this->result   = '';
    }
    public function executeTest(){

    }

    protected function startTime(){
        $this->startTime = microtime(true);
        $this->result .= 'starttime : 0 ';
        $this->result .= "<br>";
    }

    protected function endTime(){
        $this->endTime = microtime(true);
        $this->result .= "<br>";
        $this->result .= "<br>";
        $this->result .= 'endtime 1000 : ' . $this->endTime - $this->startTime;
        $this->logExecutionTime(($this->endTime - $this->startTime));

    }
    protected function logExecutionTime($time){
        $time = 1010;
        DB::insert("INSERT INTO rdtapp.TestRuns (name, executionTime) VALUES ('test from php', '.$time')");
    }
}
