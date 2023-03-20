<?php

require_once __DIR__ . '/../vendor/autoload.php';

$router = new AltoRouter();

$router->setBasePath($_SERVER['BASE_URI']);

require_once __DIR__ . '/../app/Routes/main.php';
require_once __DIR__ . '/../app/Routes/errors.php';
require_once __DIR__ . '/../app/Routes/standings.php';
require_once __DIR__ . '/../app/Routes/users.php';
require_once __DIR__ . '/../app/Routes/admin.php';

$match = $router->match();

$dispatcher = new Dispatcher($match, 'App\Controllers\ErrorController::error404');

$dispatcher->dispatch();
