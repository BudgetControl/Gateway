<?php

$app->group('/api', function ($group) {

    $group->get('/payees', [\Budgetcontrol\Gateway\Http\Controllers\DebtController::class, 'payeeList']);
    $group->get('/debits', [\Budgetcontrol\Gateway\Http\Controllers\DebtController::class, 'getDebits']);
    $group->delete('/debt/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\DebtController::class, 'deleteDebt']);

})->add(\Budgetcontrol\Gateway\Http\Middleware\AuthMiddleware::class);