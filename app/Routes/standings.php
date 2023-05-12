<?php

use App\Controllers\StandingsController;

$router->map(
    'GET',
    '/[i:year]/results',
    [
    'controller' => StandingsController::class,
    'method' => 'general'
    ],
    'general'
);

$router->map(
    'GET',
    '/[i:year]/results/[i:id]',
    [
    'controller' => StandingsController::class,
    'method' => 'results'
    ],
    'results'
);

$router->map(
    'GET',
    '/drivers/[i:id]',
    [
    'controller' => StandingsController::class,
    'method' => 'drivers'
    ],
    'drivers'
);