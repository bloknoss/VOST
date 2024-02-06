<?php

require __DIR__.'/../../vendor/autoload.php';

$dispatcher = require __DIR__.'/routes.php';

session_start();

$method = $_SERVER["REQUEST_METHOD"];
$uri = $_SERVER["REQUEST_URI"];


$routerInfo = $dispatcher->dispatch($method, $uri);

switch ($routerInfo[0]){
    case FastRoute\Dispatcher::NOT_FOUND;
        die(404);
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED;
        echo 'Method not allowed';
        exit(405);

    case FastRoute\Dispatcher::FOUND;
        $handler = $routerInfo[1];
        $handler($routerInfo[2]);
        break;
}