<?php
$app->group('/api', function ($group) {
    // ########### WORKSPACE ###########
    $group->get('/workspace/list', '\Budgetcontrol\Gateway\Http\Controllers\WorkspaceController@list');
    $group->get('/workspace/by-user/list', '\Budgetcontrol\Gateway\Http\Controllers\WorkspaceController@listByUser');
    $group->get('/workspace/last', '\Budgetcontrol\Gateway\Http\Controllers\WorkspaceController@last');
    $group->get('/workspace/{id}', '\Budgetcontrol\Gateway\Http\Controllers\WorkspaceController@show');
    $group->post('/workspace/create', '\Budgetcontrol\Gateway\Http\Controllers\WorkspaceController@create');
    $group->put('/workspace/update/{id}', '\Budgetcontrol\Gateway\Http\Controllers\WorkspaceController@update');
    $group->patch('/workspace/activate/{id}', '\Budgetcontrol\Gateway\Http\Controllers\WorkspaceController@activate');
    $group->delete('/workspace/delete/{id}', '\Budgetcontrol\Gateway\Http\Controllers\WorkspaceController@delete');
})->add(\Budgetcontrol\Gateway\Http\Middleware\AuthMiddleware::class);