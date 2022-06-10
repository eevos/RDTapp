<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

include_once('functions.php');
include_once('TestController.php');

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
    $queryResult = DB::select('select * from TestRuns order by id desc');
    array_push($redisResult,$queryResult);

    return $redisResult;
});


