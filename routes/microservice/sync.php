<?php
$app->group('/api/sync', function ($group) {
    $group->post('/{action}', [\Budgetcontrol\Gateway\Http\Controllers\SyncController::class, 'forward']);
})->add(\Budgetcontrol\Gateway\Http\Middleware\AuthMiddleware::class);
