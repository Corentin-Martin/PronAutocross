<?php

use App\Controllers\AdminController;
use App\Controllers\ErrorController;
use App\Controllers\MainController;
use App\Controllers\StandingsController;

require_once __DIR__ . '/vendor/autoload.php';

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
    '/results/[i:year]',
    [
    'controller' => StandingsController::class,
    'method' => 'general'
    ],
    'general'
);

$router->map(
    'GET',
    '/results/[i:year]/[i:id]',
    [
    'controller' => StandingsController::class,
    'method' => 'results'
    ],
    'results'
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


if ($match) {

    $year = $match['params']['year'] ?? null;
    $raceId = $match['params']['id'] ?? null;

    $controller = new $match['target']['controller']();
    $method = $match['target']['method'];

    if ($year !== null && $raceId !== null) {
        $controller->$method($year, $raceId);
    } else if ($year !== null && $raceId === null) {
        $controller->$method($year); 
    } else {
        $controller->$method();
    }

} else {
    $controller = new ErrorController();
    $controller->error404();
}