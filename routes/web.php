<?php

//use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
//use Illuminate\Support\Facades\Redis;
include_once('RedisTest.php');
include_once('TestController.php');
include_once('RedisSelectTest.php');
include_once('RedisInsertTest.php');
include_once('RedisDeleteTest.php');
include_once('RedisUpdateTest.php');
include_once('functions.php');
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/redis', function () {

    $controller  = new TestController();
    $controller->Runtests();


    $redisResult = array('Resultaten : ');
    $queryResult = DB::select('select * from TestRuns order by reg_date desc');
    array_push($redisResult,$queryResult);

    return $redisResult;
});


