<?php

use App\Controllers\Users\UserLogController;
use App\Controllers\Users\UserParticipationController;

// LOG
$router->map(
    'GET',
    '/user/registration',
    [
    'controller' => UserLogController::class,
    'method' => 'inscription'
    ],
    'user-inscription'
);

$router->map(
    'POST',
    '/user/registration',
    [
    'controller' => UserLogController::class,
    'method' => 'createOrUpdate'
    ],
    'user-create'
);

$router->map(
    'GET',
    '/user/modification/[i:id]',
    [
    'controller' => UserLogController::class,
    'method' => 'inscription'
    ],
    'user-modification'
);

$router->map(
    'POST',
    '/user/modification/[i:id]',
    [
    'controller' => UserLogController::class,
    'method' => 'createOrUpdate'
    ],
    'user-update'
);

$router->map(
    'GET',
    '/user/login',
    [
    'controller' => UserLogController::class,
    'method' => 'login'
    ],
    'user-login'
);

$router->map(
    'POST',
    '/user/login',
    [
    'controller' => UserLogController::class,
    'method' => 'connexion'
    ],
    'user-connexion'
);

$router->map(
    'GET',
    '/user/logout',
    [
    'controller' => UserLogController::class,
    'method' => 'logout'
    ],
    'user-logout'
);

// PARTICIPATION
$router->map(
    'GET',
    '/[i:year]/play/[i:id]',
    [
    'controller' => UserParticipationController::class,
    'method' => 'add'
    ],
    'user-add'
);

$router->map(
    'POST',
    '/[i:year]/play/[i:id]',
    [
    'controller' => UserParticipationController::class,
    'method' => 'create'
    ],
    'user-participation'
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