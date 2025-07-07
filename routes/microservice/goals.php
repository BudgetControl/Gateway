<?php

$app->group('/api', function ($group) {

    $group->get('/goals', '\Budgetcontrol\Gateway\Http\Controllers\GoalsController@list');
    $group->get('/goal/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\GoalsController@show');
    $group->post('/goal/create', '\Budgetcontrol\Gateway\Http\Controllers\GoalsController@create');
    $group->put('/goal/update/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\GoalsController@update');
    $group->delete('/goal/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\GoalsController@delete');

})->add(\Budgetcontrol\Gateway\Http\Middleware\AuthMiddleware::class);