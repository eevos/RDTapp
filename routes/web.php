<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;

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
    $redis = connectToRedis();

    $result = '';
    for ($i = 0; $i<10;$i++){
        $redis->set( $i, " popteshop : " . $i . "<br>");
        $result .= $redis->get($i);
    }
    return $result;
});

Route::get('/db', function () {
//https://laravel.com/docs/9.x/database
//    $result = DB::statement('select * from test'); // returns 1
    DB::unprepared('update test set testcol = "kwarry" where testcol = "harry"');
    // returns [1,harry]

    return DB::select('select * from test');
});

function connectToRedis(): \Predis\Client
{
    Predis\Autoloader::register();
    return new Predis\Client(array(
        "scheme" => "tcp",
        "host" => "redis",
        "port" => 6379,
        "username"=>'root',
        "password" => ''));
}
