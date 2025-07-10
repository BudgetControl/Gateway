<?php
$app->group('/api', function ($group) {

//# ########### STATS BUDGETS ###########
$group->get('/budgets', [\Budgetcontrol\Gateway\Http\Controllers\BudgetController::class, 'list']);
$group->get('/budget/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\BudgetController::class, 'show']);
$group->get('/budget/{uuid}/expired', [\Budgetcontrol\Gateway\Http\Controllers\BudgetController::class, 'expired']);
$group->get('/budget/{uuid}/exceeded', [\Budgetcontrol\Gateway\Http\Controllers\BudgetController::class, 'exceeded']);
$group->get('/budget/{uuid}/status', [\Budgetcontrol\Gateway\Http\Controllers\BudgetController::class, 'status']);
$group->get('/budget/{uuid}/stats', [\Budgetcontrol\Gateway\Http\Controllers\BudgetController::class, 'budgetStats']);
$group->get('/budgets/stats', [\Budgetcontrol\Gateway\Http\Controllers\BudgetController::class, 'budgetsStats']);
$group->get('/budget/{uuid}/entry-list', [\Budgetcontrol\Gateway\Http\Controllers\BudgetController::class, 'entryList']);

})
->add(\Budgetcontrol\Gateway\Http\Middleware\AuthMiddleware::class)
->add(new \Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware(5));


$app->group('/api', function($group) {
    $group->post('/budget/create', [\Budgetcontrol\Gateway\Http\Controllers\BudgetController::class, 'create']);
    $group->put('/budget/update/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\BudgetController::class, 'update']);
    $group->delete('/budget/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\BudgetController::class, 'delete']);
})
->add(\Budgetcontrol\Gateway\Http\Middleware\AuthMiddleware::class)
->add(\Budgetcontrol\Gateway\Http\Middleware\CacheInvalidationMiddleware::class);