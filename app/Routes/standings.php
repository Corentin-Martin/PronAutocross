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