<?php

use App\Controllers\Users\UserCoreController;
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

$router->map(
    'GET',
    '/user/dashboard',
    [
    'controller' => UserCoreController::class,
    'method' => 'dashboard'
    ],
    'user-dashboard'
);

// PARTICIPATION
$router->map(
    'GET',
    '/play/[i:id]',
    [
    'controller' => UserParticipationController::class,
    'method' => 'add'
    ],
    'user-add'
);

$router->map(
    'POST',
    '/play/[i:id]',
    [
    'controller' => UserParticipationController::class,
    'method' => 'create'
    ],
    'user-participation'
);

$router->map(
    'GET',
    '/recap/[i:id]',
    [
    'controller' => UserParticipationController::class,
    'method' => 'recap'
    ],
    'user-recap'
);
