<?php
$app->group('/api', function ($group) {

    //# ########### STATS WalletS ###########
    $group->get('/wallet/list', '\Budgetcontrol\Gateway\Http\Controllers\WalletController@list');
    $group->get('/wallet/show/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\WalletController@show');
    $group->post('/wallet/create', '\Budgetcontrol\Gateway\Http\Controllers\WalletController@create');
    $group->put('/wallet/update/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\WalletController@update');
    $group->delete('/wallet/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\WalletController@delete');
    $group->patch('/wallet/restore/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\WalletController@restore');
    $group->patch('/wallet/sorting/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\WalletController@sorting');
    $group->patch('/wallet/archive/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\WalletController@archive');
    $group->patch('/wallet/balance/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\WalletController@balance');

})->add(\Budgetcontrol\Gateway\Http\Middleware\AuthMiddleware::class);