<?php
$app->group('/api', function ($group) {

//# ########### STATS BUDGETS ###########
$group->get('/budgets', '\Budgetcontrol\Gateway\Http\Controllers\BudgetController@list');
$group->get('/budget/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\BudgetController@show');
$group->post('/budget/create', '\Budgetcontrol\Gateway\Http\Controllers\BudgetController@create');
$group->put('/budget/update/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\BudgetController@update');
$group->delete('/budget/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\BudgetController@delete');
$group->get('/budget/{uuid}/expired', '\Budgetcontrol\Gateway\Http\Controllers\BudgetController@expired');
$group->get('/budget/{uuid}/exceeded', '\Budgetcontrol\Gateway\Http\Controllers\BudgetController@exceeded');
$group->get('/budget/{uuid}/status', '\Budgetcontrol\Gateway\Http\Controllers\BudgetController@status');
$group->get('/budget/{uuid}/stats', '\Budgetcontrol\Gateway\Http\Controllers\BudgetController@budgetStats');
$group->get('/budgets/stats', '\Budgetcontrol\Gateway\Http\Controllers\BudgetController@budgetsStats');
$group->get('/budget/{uuid}/entry-list', '\Budgetcontrol\Gateway\Http\Controllers\BudgetController@entryList');

})->add(\Budgetcontrol\Gateway\Http\Middleware\AuthMiddleware::class);