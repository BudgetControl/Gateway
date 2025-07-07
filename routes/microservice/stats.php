<?php
$app->group('/api', function ($group) {
    // ########### STATS ###########
    $group->get('/stats/incoming', '\Budgetcontrol\Gateway\Http\Controllers\StatsController@incoming');
    $group->get('/stats/find/incoming', '\Budgetcontrol\Gateway\Http\Controllers\StatsController@statsIncoming');
    $group->get('/stats/expenses', '\Budgetcontrol\Gateway\Http\Controllers\StatsController@expenses');
    $group->get('/stats/find/expenses', '\Budgetcontrol\Gateway\Http\Controllers\StatsController@statsExpenses');
    $group->get('/stats/total', '\Budgetcontrol\Gateway\Http\Controllers\StatsController@total');
    $group->get('/stats/wallets', '\Budgetcontrol\Gateway\Http\Controllers\StatsController@wallets');
    $group->get('/stats/health', '\Budgetcontrol\Gateway\Http\Controllers\StatsController@health');
    $group->get('/stats/total/planned', '\Budgetcontrol\Gateway\Http\Controllers\StatsController@totalPlanned');
    $group->post('/stats/entries', '\Budgetcontrol\Gateway\Http\Controllers\StatsController@entries');
    $group->get('/stats/debits', '\Budgetcontrol\Gateway\Http\Controllers\StatsController@debits');
    $group->get('/stats/debits/total-negative', '\Budgetcontrol\Gateway\Http\Controllers\StatsController@debitsTotalNegative');
    $group->get('/stats/debits/total-positive', '\Budgetcontrol\Gateway\Http\Controllers\StatsController@debitsTotalPositive');

    // ########### STATS CHART ###########
    $group->get('/stats/chart/line/incoming-expenses', '\Budgetcontrol\Gateway\Http\Controllers\ChartsController@incomingExpensesLineByDate')->add(\Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware::class . ':60');
    $group->get('/stats/chart/bar/expenses/category', '\Budgetcontrol\Gateway\Http\Controllers\ChartsController@expensesCategoryBarByDate')->add(\Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware::class . ':15');
    $group->get('/stats/chart/bar/incoming/category', '\Budgetcontrol\Gateway\Http\Controllers\ChartsController@incomingCategoryBarByDate')->add(\Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware::class . ':15');
    $group->get('/stats/chart/table/expenses/category', '\Budgetcontrol\Gateway\Http\Controllers\ChartsController@expensesCategoryTableByDate')->add(\Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware::class . ':15');
    $group->get('/stats/chart/table/incoming/category', '\Budgetcontrol\Gateway\Http\Controllers\ChartsController@incomingCategoryTableByDate')->add(\Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware::class . ':15');
    $group->get('/stats/chart/bar/expenses/label', '\Budgetcontrol\Gateway\Http\Controllers\ChartsController@expensesLabelBarByDate')->add(\Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware::class . ':30');
    $group->get('/stats/chart/apple-pie/expenses/label', '\Budgetcontrol\Gateway\Http\Controllers\ChartsController@expensesLabelApplePieByDate')->add(\Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware::class . ':30');

    // ########### STATS AVERANGE ###########
    $group->get('/stats/average-expenses', '\Budgetcontrol\Gateway\Http\Controllers\AverangeController@averageExpenses')->add(\Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware::class . ':60');
    $group->get('/stats/average-incoming', '\Budgetcontrol\Gateway\Http\Controllers\AverangeController@averageIncoming')->add(\Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware::class . ':60');
    $group->get('/stats/average-savings', '\Budgetcontrol\Gateway\Http\Controllers\AverangeController@averageSavings')->add(\Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware::class . ':60');
    $group->get('/stats/total-loan-installments', '\Budgetcontrol\Gateway\Http\Controllers\AverangeController@totalLoanInstallmentsOfCurrentMonth')->add(\Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware::class . ':60');
    $group->get('/stats/total/planned/remaining', '\Budgetcontrol\Gateway\Http\Controllers\AverangeController@totalPlannedRemainingOfCurrentMonth')->add(\Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware::class . ':60');
    $group->get('/stats/total/planned/monthly', '\Budgetcontrol\Gateway\Http\Controllers\AverangeController@totalPlannedMonthly')->add(\Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware::class . ':60');

})->add(\Budgetcontrol\Gateway\Http\Middleware\AuthMiddleware::class);
