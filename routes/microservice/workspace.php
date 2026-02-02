<?php
$app->group('/api', function ($group) {
    // ########### WORKSPACE ###########
    $group->post('/workspace/create', [\Budgetcontrol\Gateway\Http\Controllers\WorkspaceController::class, 'create']);
    $group->put('/workspace/update/{id}', [\Budgetcontrol\Gateway\Http\Controllers\WorkspaceController::class, 'update']);
    $group->patch('/workspace/activate/{id}', [\Budgetcontrol\Gateway\Http\Controllers\WorkspaceController::class, 'activate']);
    $group->delete('/workspace/{id}', [\Budgetcontrol\Gateway\Http\Controllers\WorkspaceController::class, 'delete']);
    $group->delete('/workspace/{wsId}/unshare/{userUuid}', [\Budgetcontrol\Gateway\Http\Controllers\WorkspaceController::class, 'unshare']);
    $group->post('/workspace/{wsId}/share', [\Budgetcontrol\Gateway\Http\Controllers\WorkspaceController::class, 'share']);
})->add(\Budgetcontrol\Gateway\Http\Middleware\AuthMiddleware::class)
->add(\Budgetcontrol\Gateway\Http\Middleware\CacheInvalidationMiddleware::class);


$app->group('/api', function ($group) {
    $group->get('/workspace/list', [\Budgetcontrol\Gateway\Http\Controllers\WorkspaceController::class, 'list']);
    $group->get('/workspace/by-user/list', [\Budgetcontrol\Gateway\Http\Controllers\WorkspaceController::class, 'listByUser']);
    $group->get('/workspace/last', [\Budgetcontrol\Gateway\Http\Controllers\WorkspaceController::class, 'last']);
    $group->get('/workspace/{id}', [\Budgetcontrol\Gateway\Http\Controllers\WorkspaceController::class, 'show']);
})
->add(\Budgetcontrol\Gateway\Http\Middleware\AuthMiddleware::class)
->add(new \Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware());