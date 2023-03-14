<?php

use App\Controllers\Admin\AdminQuestionController;
use App\Controllers\Admin\AdminCategoryController;
use App\Controllers\Admin\AdminDriverController;
use App\Controllers\Admin\AdminEntryListController;
use App\Controllers\Admin\AdminRaceController;
use App\Controllers\Admin\AdminVerificationController;
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

// ADMIN //
// DRIVER //
$router->map(
    'GET',
    '/admin/driver',
    [
    'controller' => AdminDriverController::class,
    'method' => 'home'
    ],
    'driver-home'
);

$router->map(
    'GET',
    '/admin/driver/[i:id]/[a:action]',
    [
    'controller' => AdminDriverController::class,
    'method' => 'list'
    ],
    'driver-list'
);

$router->map(
    'GET',
    '/admin/driver/add',
    [
    'controller' => AdminDriverController::class,
    'method' => 'add'
    ],
    'driver-add'
);

$router->map(
    'GET',
    '/admin/driver/edit/[i:id]',
    [
    'controller' => AdminDriverController::class,
    'method' => 'edit'
    ],
    'driver-edit'
);

// ENTRY LIST
$router->map(
    'GET',
    '/admin/entrylist',
    [
    'controller' => AdminEntryListController::class,
    'method' => 'home'
    ],
    'entrylist-home'
);

$router->map(
    'GET',
    '/admin/entrylist/add',
    [
    'controller' => AdminEntryListController::class,
    'method' => 'add'
    ],
    'entrylist-add'
);

$router->map(
    'GET',
    '/admin/entrylist/[i:year]/[i:id]',
    [
    'controller' => AdminEntryListController::class,
    'method' => 'list'
    ],
    'entrylist-list'
);

// VERIFICATION
$router->map(
    'GET',
    '/admin/verification',
    [
    'controller' => AdminVerificationController::class,
    'method' => 'home'
    ],
    'verification-home'
);

$router->map(
    'GET',
    '/admin/verification/add',
    [
    'controller' => AdminVerificationController::class,
    'method' => 'add'
    ],
    'verification-add'
);

$router->map(
    'GET',
    '/admin/verification/[i:year]/[i:id]',
    [
    'controller' => AdminVerificationController::class,
    'method' => 'list'
    ],
    'verification-list'
);

// CATEGORY
$router->map(
    'GET',
    '/admin/category',
    [
    'controller' => AdminCategoryController::class,
    'method' => 'list'
    ],
    'category-list'
);

$router->map(
    'GET',
    '/admin/category/add',
    [
    'controller' => AdminCategoryController::class,
    'method' => 'add'
    ],
    'category-add'
);

// RACES
$router->map(
    'GET',
    '/admin/race',
    [
    'controller' => AdminRaceController::class,
    'method' => 'list'
    ],
    'race-list'
);

$router->map(
    'GET',
    '/admin/race/add',
    [
    'controller' => AdminRaceController::class,
    'method' => 'add'
    ],
    'race-add'
);

// QUESTIONS
$router->map(
    'GET',
    '/admin/question',
    [
    'controller' => AdminQuestionController::class,
    'method' => 'home'
    ],
    'question-home'
);

$router->map(
    'GET',
    '/admin/question/add',
    [
    'controller' => AdminQuestionController::class,
    'method' => 'add'
    ],
    'question-add'
);

$router->map(
    'GET',
    '/admin/question/[i:year]/[i:id]',
    [
    'controller' => AdminQuestionController::class,
    'method' => 'list'
    ],
    'question-list'
);

// ERROR 404
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
