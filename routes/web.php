<?php

//use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
//use Illuminate\Support\Facades\Redis;
include_once('RedisTest.php');
include_once('RedisTestSelect.php');
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

    $redisTest = new RedisTestSelect(100, 'SelectTest');
    $redisTest->executeTest();

    $redisResult = DB::select('select * from TestRuns');
    array_unshift($redisResult,'Resultaten : ');

    return $redisResult;
});

Route::get('/db', function () {
    //https://laravel.com/docs/9.x/database
    return DB::select('select count(*) from TestRuns');
});

