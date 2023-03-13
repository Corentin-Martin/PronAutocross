<?php

use App\Controllers\AdminController;
use App\Controllers\ErrorController;
use App\Controllers\MainController;
use App\Controllers\UserController;
use App\Controllers\StandingsController;

require_once __DIR__ . '/../vendor/autoload.php';

$router = new AltoRouter();

$router->setBasePath($_SERVER['BASE_URI']);

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
    '/[i:year]/play/[i:id]',
    [
    'controller' => UserController::class,
    'method' => 'play'
    ],
    'play'
);

$router->map(
    'GET',
    '/recap',
    [
    'controller' => UserController::class,
    'method' => 'recap'
    ],
    'recap'
);

$router->map(
    'GET',
    '/dashboard',
    [
    'controller' => UserController::class,
    'method' => 'dashboard'
    ],
    'dashboard'
);

$router->map(
    'GET',
    '/entrylist',
    [
    'controller' => AdminController::class,
    'method' => 'entrylist'
    ],
    'entrylist'
);

$router->map(
    'GET',
    '/driver',
    [
    'controller' => AdminController::class,
    'method' => 'driver'
    ],
    'driver'
);

$router->map(
    'GET',
    '/error404',
    [
    'controller' => ErrorController::class,
    'method' => 'error404'
    ],
    'error404'
);

$match = $router->match();

$dispatcher = new Dispatcher($match, 'App\Controllers\ErrorController::error404');

$dispatcher->dispatch();
