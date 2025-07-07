<?php

$app->group('/api', function ($group) {

    $group->get('/payees', '\Budgetcontrol\Gateway\Http\Controllers\DebtController@payeeList');
    $group->get('/debits', '\Budgetcontrol\Gateway\Http\Controllers\DebtController@getDebits');
    $group->delete('/debt/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\DebtController@deleteDebt');

})->add(\Budgetcontrol\Gateway\Http\Middleware\AuthMiddleware::class);