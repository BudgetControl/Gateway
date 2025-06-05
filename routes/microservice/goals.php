<?php

$app->group('/api', function ($group) {

    $group->get('/goals', [\Budgetcontrol\Gateway\Http\Controllers\GoalsController::class, 'list']);
    $group->get('/goals/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\GoalsController::class, 'show']);

})->add(\Budgetcontrol\Gateway\Http\Middleware\AuthMiddleware::class)
->add(new \Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware(900));


$app->group('/api', function($group) {
    $group->post('/goals/create', [\Budgetcontrol\Gateway\Http\Controllers\GoalsController::class, 'create']);
    $group->put('/goals/update/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\GoalsController::class, 'update']);
    $group->delete('/goals/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\GoalsController::class, 'delete']);
})
->add(\Budgetcontrol\Gateway\Http\Middleware\AuthMiddleware::class)
->add(\Budgetcontrol\Gateway\Http\Middleware\CacheInvalidationMiddleware::class);
