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