<?php

use App\Controllers\Admin\AdminCategoryController;
use App\Controllers\Admin\AdminCoreController;
use App\Controllers\Admin\AdminDriverController;
use App\Controllers\Admin\AdminEntryListController;
use App\Controllers\Admin\AdminQuestionController;
use App\Controllers\Admin\AdminRaceController;
use App\Controllers\Admin\AdminRateController;
use App\Controllers\Admin\AdminVerificationController;

$router->map(
    'GET',
    '/admin',
    [
    'controller' => AdminCoreController::class,
    'method' => 'home'
    ],
    'admin'
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
    'method' => 'addOrEdit'
    ],
    'category-add'
);

$router->map(
    'GET',
    '/admin/category/edit/[i:id]',
    [
    'controller' => AdminCategoryController::class,
    'method' => 'addOrEdit'
    ],
    'category-edit'
);


$router->map(
    'POST',
    '/admin/category/add',
    [
    'controller' => AdminCategoryController::class,
    'method' => 'createOrUpdate'
    ],
    'category-create'
);

$router->map(
    'POST',
    '/admin/category/edit/[i:id]',
    [
    'controller' => AdminCategoryController::class,
    'method' => 'createOrUpdate'
    ],
    'category-update'
);

$router->map(
    'GET',
    '/admin/category/delete/[i:id]/[h:token]',
    [
    'controller' => AdminCategoryController::class,
    'method' => 'delete'
    ],
    'category-delete'
);

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
    '/admin/driver/[i:categoryId]/[a:action]',
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
    'method' => 'addOrEdit'
    ],
    'driver-add'
);

$router->map(
    'GET',
    '/admin/driver/edit/[i:id]',
    [
    'controller' => AdminDriverController::class,
    'method' => 'addOrEdit'
    ],
    'driver-edit'
);

$router->map(
    'POST',
    '/admin/driver/add',
    [
    'controller' => AdminDriverController::class,
    'method' => 'createOrUpdate'
    ],
    'driver-create'
);

$router->map(
    'POST',
    '/admin/driver/edit/[i:id]',
    [
    'controller' => AdminDriverController::class,
    'method' => 'createOrUpdate'
    ],
    'driver-update'
);

$router->map(
    'GET',
    '/admin/driver/delete/[i:id]/[h:token]',
    [
    'controller' => AdminDriverController::class,
    'method' => 'delete'
    ],
    'driver-delete'
);

$router->map(
    'GET',
    '/admin/driver/editplaces',
    [
    'controller' => AdminDriverController::class,
    'method' => 'editPlaces'
    ],
    'driver-editPlaces'
);

$router->map(
    'POST',
    '/admin/driver/editplaces',
    [
    'controller' => AdminDriverController::class,
    'method' => 'updatePlaces'
    ],
    'driver-updatePlaces'
);

$router->map(
    'GET',
    '/admin/driver/rate/edit/[i:id]',
    [
    'controller' => AdminDriverController::class,
    'method' => 'editRates'
    ],
    'driver-editRates'
);

$router->map(
    'POST',
    '/admin/driver/rate/edit/[i:id]',
    [
    'controller' => AdminDriverController::class,
    'method' => 'updateRates'
    ],
    'driver-updateRates'
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
    'POST',
    '/admin/entrylist/add',
    [
    'controller' => AdminEntryListController::class,
    'method' => 'create'
    ],
    'entrylist-create'
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

$router->map(
    'GET',
    '/admin/entrylist/delete/[i:year]/[i:id]/[h:token]',
    [
    'controller' => AdminEntryListController::class,
    'method' => 'deletelist'
    ],
    'entrylist-deletelist'
);

$router->map(
    'GET',
    '/admin/entrylist/deletedriver/[i:id]/[h:token]',
    [
    'controller' => AdminEntryListController::class,
    'method' => 'deleteentry'
    ],
    'entrylist-deleteentry'
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
    'method' => 'addOrEdit'
    ],
    'question-add'
);

$router->map(
    'POST',
    '/admin/question/add',
    [
    'controller' => AdminQuestionController::class,
    'method' => 'createOrUpdate'
    ],
    'question-create'
);

$router->map(
    'GET',
    '/admin/question/edit/[i:id]',
    [
    'controller' => AdminQuestionController::class,
    'method' => 'addOrEdit'
    ],
    'question-edit'
);

$router->map(
    'POST',
    '/admin/question/edit/[i:id]',
    [
    'controller' => AdminQuestionController::class,
    'method' => 'createOrUpdate'
    ],
    'question-update'
);

$router->map(
    'GET',
    '/admin/question/[i:year]',
    [
    'controller' => AdminQuestionController::class,
    'method' => 'list'
    ],
    'question-list'
);

$router->map(
    'GET',
    '/admin/question/delete/[i:id]/[h:token]',
    [
    'controller' => AdminQuestionController::class,
    'method' => 'delete'
    ],
    'question-delete'
);

// RACES
$router->map(
    'GET',
    '/admin/race',
    [
    'controller' => AdminRaceController::class,
    'method' => 'home'
    ],
    'race-home'
);

$router->map(
    'GET',
    '/admin/race/add',
    [
    'controller' => AdminRaceController::class,
    'method' => 'addOrEdit'
    ],
    'race-add'
);

$router->map(
    'POST',
    '/admin/race/add',
    [
    'controller' => AdminRaceController::class,
    'method' => 'createOrUpdate'
    ],
    'race-create'
);

$router->map(
    'GET',
    '/admin/race/edit/[i:id]',
    [
    'controller' => AdminRaceController::class,
    'method' => 'addOrEdit'
    ],
    'race-edit'
);

$router->map(
    'POST',
    '/admin/race/edit/[i:id]',
    [
    'controller' => AdminRaceController::class,
    'method' => 'createOrUpdate'
    ],
    'race-update'
);
$router->map(
    'GET',
    '/admin/race/list/[i:year]',
    [
    'controller' => AdminRaceController::class,
    'method' => 'list'
    ],
    'race-list'
);

$router->map(
    'GET',
    '/admin/race/delete/[i:id]/[h:token]',
    [
    'controller' => AdminRaceController::class,
    'method' => 'delete'
    ],
    'race-delete'
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
    '/admin/verification/edit/[i:raceId]',
    [
    'controller' => AdminVerificationController::class,
    'method' => 'addOrEdit'
    ],
    'verification-edit'
);

$router->map(
    'POST',
    '/admin/verification/edit/[i:raceId]',
    [
    'controller' => AdminVerificationController::class,
    'method' => 'update'
    ],
    'verification-update'
);

$router->map(
    'GET',
    '/admin/verification/add',
    [
    'controller' => AdminVerificationController::class,
    'method' => 'addOrEdit'
    ],
    'verification-add'
);

$router->map(
    'GET',
    '/admin/verification/add/[i:raceId]',
    [
    'controller' => AdminVerificationController::class,
    'method' => 'addOrEdit'
    ],
    'verification-adding'
);

$router->map(
    'POST',
    '/admin/verification/add/[i:raceId]',
    [
    'controller' => AdminVerificationController::class,
    'method' => 'create'
    ],
    'verification-create'
);

$router->map(
    'GET',
    '/admin/verification/validation/[i:id]',
    [
    'controller' => AdminVerificationController::class,
    'method' => 'validation'
    ],
    'verification-validation'
);

$router->map(
    'POST',
    '/admin/verification/validation/[i:id]',
    [
    'controller' => AdminVerificationController::class,
    'method' => 'makevalidation'
    ],
    'verification-makevalidation'
);

$router->map(
    'GET',
    '/admin/verification/[i:year]',
    [
    'controller' => AdminVerificationController::class,
    'method' => 'list'
    ],
    'verification-list'
);

$router->map(
    'GET',
    '/admin/verification/delete/[i:id]/[h:token]',
    [
    'controller' => AdminVerificationController::class,
    'method' => 'delete'
    ],
    'verification-delete'
);

// RATE
