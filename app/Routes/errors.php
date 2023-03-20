<?php

use App\Controllers\ErrorController;

$router->map(
    'GET',
    '/error404',
    [
    'controller' => ErrorController::class,
    'method' => 'error404'
    ],
    'error404'
);

$router->map(
    'GET',
    '/error403',
    [
    'controller' => ErrorController::class,
    'method' => 'error403'
    ],
    'error403'
);