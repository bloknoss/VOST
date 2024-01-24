<?php

use VOST\controllers\UserController;

require __DIR__. '/UserController.php';

$dispatcher = require __DIR__.'/routes.php';

$method = $_SERVER["REQUEST_METHOD"];
$uri = $_SERVER["REQUEST_URI"];

$routerInfo = $dispatcher->dispatch($method, $uri);

switch ($routerInfo[0]){
    case FastRoute\Dispatcher::NOT_FOUND;
        http_response_code(404);
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED;
        echo 'Method not allowed';
        http_response_code(400);
        break;

    case FastRoute\Dispatcher::FOUND;
        $handler = $routerInfo[1];
        $handlerClass = new $handler();
        $handlerClass->printHola();
        break;
}