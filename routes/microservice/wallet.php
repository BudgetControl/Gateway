<?php
$app->group('/api', function ($group) {

    //# ########### STATS WalletS ###########
    $group->post('/wallet/create', [\Budgetcontrol\Gateway\Http\Controllers\WalletController::class, 'create']);
    $group->put('/wallet/update/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\WalletController::class, 'update']);
    $group->delete('/wallet/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\WalletController::class, 'delete']);
    $group->patch('/wallet/restore/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\WalletController::class, 'restore']);
    $group->patch('/wallet/sorting/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\WalletController::class, 'sorting']);
    $group->patch('/wallet/archive/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\WalletController::class, 'archive']);
    $group->patch('/wallet/balance/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\WalletController::class, 'balance']);

})->add(\Budgetcontrol\Gateway\Http\Middleware\AuthMiddleware::class)
->add(\Budgetcontrol\Gateway\Http\Middleware\CacheInvalidationMiddleware::class);

$app->group('/api', function ($group) {
    $group->get('/wallet/show/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\WalletController::class, 'show']);
    $group->get('/wallet/list', [\Budgetcontrol\Gateway\Http\Controllers\WalletController::class, 'list']);
})
->add(\Budgetcontrol\Gateway\Http\Middleware\AuthMiddleware::class)
->add(new \Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware(3600));