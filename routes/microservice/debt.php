<?php

$app->group('/api', function ($group) {
    $group->get('/payees', [\Budgetcontrol\Gateway\Http\Controllers\DebtController::class, 'payeeList'])->add(new \Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware());
    $group->get('/debits', [\Budgetcontrol\Gateway\Http\Controllers\DebtController::class, 'getDebits'])->add(new \Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware());
    $group->delete('/debt/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\DebtController::class, 'deleteDebt'])->add(\Budgetcontrol\Gateway\Http\Middleware\CacheInvalidationMiddleware::class);

})->add(\Budgetcontrol\Gateway\Http\Middleware\AuthMiddleware::class);