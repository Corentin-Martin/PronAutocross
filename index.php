<?php

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
    '/general',
    [
    'controller' => StandingsController::class,
    'method' => 'general'
    ],
    'general'
);

$router->map(
    'GET',
    '/results/[i:id]',
    [
    'controller' => StandingsController::class,
    'method' => 'results'
    ],
    'results'
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

    $raceId = $match['params']['id'] ?? null;

    $controller = new $match['target']['controller']();
    $method = $match['target']['method'];

    if ($raceId !== null) {
        $controller->$method($raceId);
    } else {
        $controller->$method();
    }

} else {
    $controller = new ErrorController();
    $controller->error404();
}