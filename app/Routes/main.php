<?php

use App\Controllers\MainController;

$router->map(
    'GET',
    '/',
    [
    'controller' => MainController::class,
    'method' => 'home'
    ],
    'home'
);

$router->map(
    'GET',
    '/rules',
    [
    'controller' => MainController::class,
    'method' => 'rules'
    ],
    'rules'
);

$router->map(
    'GET',
    '/notice',
    [
    'controller' => MainController::class,
    'method' => 'legalNotice'
    ],
    'notice'
);