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

$router->map(
    'GET',
    '/user/charts',
    [
    'controller' => UserCoreController::class,
    'method' => 'charts'
    ],
    'user-charts'
);

$router->map(
    'GET',
    '/user/frienddashboard/[i:friendId]',
    [
    'controller' => UserCoreController::class,
    'method' => 'friendDashboard'
    ],
    'user-frienddashboard'
);

$router->map(
    'GET',
    '/user/friends/add',
    [
    'controller' => UserCoreController::class,
    'method' => 'addFriends'
    ],
    'user-addFriends'
);

$router->map(
    'POST',
    '/user/friends/add',
    [
    'controller' => UserCoreController::class,
    'method' => 'createFriends'
    ],
    'user-createFriends'
);

$router->map(
    'GET',
    '/admin/friends/delete/[i:friendId]/[h:token]',
    [
    'controller' => UserCoreController::class,
    'method' => 'deleteFriend'
    ],
    'user-deleteFriend'
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

$router->map(
    'GET',
    '/close',
    [
    'controller' => UserParticipationController::class,
    'method' => 'deadline'
    ],
    'user-deadline'
);
