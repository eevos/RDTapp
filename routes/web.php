<?php

//use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
//use Illuminate\Support\Facades\Redis;
include_once('RedisQuery.php');
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
    $redisResult = new RedisQuery();

    return $redisResult->returnResult();
});

Route::get('/db', function () {
//https://laravel.com/docs/9.x/database
//    DB::unprepared('update test set testcol = "kwarry" where testcol = "harry"');
    return DB::select('select count(*) from Voertuigen');
});

