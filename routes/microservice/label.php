<?php

$app->group('/api', function ($group) {

    $group->get('/label/list', [\Budgetcontrol\Gateway\Http\Controllers\LabelController::class, 'list']);
    $group->put('/label/{label_id}', [\Budgetcontrol\Gateway\Http\Controllers\LabelController::class, 'update']);
    $group->post('/label/{label_id}', [\Budgetcontrol\Gateway\Http\Controllers\LabelController::class, 'insert']);
    $group->get('/label/{label_id}', [\Budgetcontrol\Gateway\Http\Controllers\LabelController::class, 'show']);
    $group->patch('/label/{label_id}', [\Budgetcontrol\Gateway\Http\Controllers\LabelController::class, 'patch']);
    $group->delete('/label/{label_id}', [\Budgetcontrol\Gateway\Http\Controllers\LabelController::class, 'delete']);

})->add(\Budgetcontrol\Gateway\Http\Middleware\AuthMiddleware::class);