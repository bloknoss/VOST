<?php
use VOST\controllers\UserController;
require __DIR__.'/../../vendor/autoload.php';

return FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $routeCollector){
    $routeCollector->get('/home', UserController::class);
});