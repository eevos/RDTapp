<?php
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
