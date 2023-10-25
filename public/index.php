<?php

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

$router = new AltoRouter();

if (array_key_exists('BASE_URI', $_SERVER)) {

    $router->setBasePath($_SERVER['BASE_URI']);

} else { 

    $_SERVER['BASE_URI'] = '/';
}

require_once __DIR__ . '/../app/Routes/main.php';
require_once __DIR__ . '/../app/Routes/errors.php';
require_once __DIR__ . '/../app/Routes/standings.php';
require_once __DIR__ . '/../app/Routes/users.php';
require_once __DIR__ . '/../app/Routes/admin.php';


$match = $router->match();

$dispatcher = new Dispatcher($match, 'App\Controllers\ErrorController::error404');

$dispatcher->setControllersArguments($router, $match, $dispatcher);

$dispatcher->dispatch();
