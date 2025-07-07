<?php

$app->group('/api', function ($group) {

    $group->get('/label/list', '\Budgetcontrol\Gateway\Http\Controllers\LabelController@list');
    $group->put('/label/{label_id}', '\Budgetcontrol\Gateway\Http\Controllers\LabelController@update');
    $group->post('/label/{label_id}', '\Budgetcontrol\Gateway\Http\Controllers\LabelController@insert');
    $group->get('/label/{label_id}', '\Budgetcontrol\Gateway\Http\Controllers\LabelController@show');
    $group->patch('/label/{label_id}', '\Budgetcontrol\Gateway\Http\Controllers\LabelController@patch');
    $group->delete('/label/{label_id}', '\Budgetcontrol\Gateway\Http\Controllers\LabelController@delete');

})->add(\Budgetcontrol\Gateway\Http\Middleware\AuthMiddleware::class);