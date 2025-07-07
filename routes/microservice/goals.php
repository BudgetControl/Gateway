<?php

$app->group('/api', function ($group) {

    $group->get('/goals', [\Budgetcontrol\Gateway\Http\Controllers\GoalsController::class, 'list']);
    $group->get('/goal/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\GoalsController::class, 'show']);
    $group->post('/goal/create', [\Budgetcontrol\Gateway\Http\Controllers\GoalsController::class, 'create']);
    $group->put('/goal/update/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\GoalsController::class, 'update']);
    $group->delete('/goal/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\GoalsController::class, 'delete']);

})->add(\Budgetcontrol\Gateway\Http\Middleware\AuthMiddleware::class);