<?php
$app->group('/api', function ($group) {
    // ########### STATS CHART ###########
    $group->get('/stats/chart/line/incoming-expenses', [\Budgetcontrol\Gateway\Http\Controllers\ChartsController::class, 'incomingExpensesLineByDate']);
    $group->get('/stats/chart/bar/expenses/category', [\Budgetcontrol\Gateway\Http\Controllers\ChartsController::class, 'expensesCategoryBarByDate']);
    $group->get('/stats/chart/bar/incoming/category', [\Budgetcontrol\Gateway\Http\Controllers\ChartsController::class, 'incomingCategoryBarByDate']);
    $group->get('/stats/chart/table/expenses/category', [\Budgetcontrol\Gateway\Http\Controllers\ChartsController::class, 'expensesCategoryTableByDate']);
    $group->get('/stats/chart/table/incoming/category', [\Budgetcontrol\Gateway\Http\Controllers\ChartsController::class, 'incomingCategoryTableByDate']);
    $group->get('/stats/chart/bar/expenses/label', [\Budgetcontrol\Gateway\Http\Controllers\ChartsController::class, 'expensesLabelBarByDate']);
    $group->get('/stats/chart/apple-pie/expenses/label', [\Budgetcontrol\Gateway\Http\Controllers\ChartsController::class, 'expensesLabelApplePieByDate']);

    // ########### STATS AVERANGE ###########
    $group->get('/stats/average-expenses', [\Budgetcontrol\Gateway\Http\Controllers\AverangeController::class, 'averageExpenses']);
    $group->get('/stats/average-incoming', [\Budgetcontrol\Gateway\Http\Controllers\AverangeController::class, 'averageIncoming']);
    $group->get('/stats/average-savings', [\Budgetcontrol\Gateway\Http\Controllers\AverangeController::class, 'averageSavings']);
    $group->get('/stats/total-loan-installments', [\Budgetcontrol\Gateway\Http\Controllers\AverangeController::class, 'totalLoanInstallmentsOfCurrentMonth']);
    $group->get('/stats/total/planned/remaining', [\Budgetcontrol\Gateway\Http\Controllers\AverangeController::class, 'totalPlannedRemainingOfCurrentMonth']);
    $group->get('/stats/total/planned/monthly', [\Budgetcontrol\Gateway\Http\Controllers\AverangeController::class, 'totalPlannedMonthly']);
})->add(\Budgetcontrol\Gateway\Http\Middleware\AuthMiddleware::class)->add(new \Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware());



$app->group('/api', function ($group) {
    // ########### STATS ###########
    $group->get('/stats/incoming', [\Budgetcontrol\Gateway\Http\Controllers\StatsController::class, 'incoming']);
    $group->get('/stats/find/incoming', [\Budgetcontrol\Gateway\Http\Controllers\StatsController::class, 'statsIncoming']);
    $group->get('/stats/expenses', [\Budgetcontrol\Gateway\Http\Controllers\StatsController::class, 'expenses']);
    $group->get('/stats/find/expenses', [\Budgetcontrol\Gateway\Http\Controllers\StatsController::class, 'statsExpenses']);
    $group->get('/stats/total', [\Budgetcontrol\Gateway\Http\Controllers\StatsController::class, 'total']);
    $group->get('/stats/wallets', [\Budgetcontrol\Gateway\Http\Controllers\StatsController::class, 'wallets']);
    $group->get('/stats/health', [\Budgetcontrol\Gateway\Http\Controllers\StatsController::class, 'health']);
    $group->get('/stats/total/planned', [\Budgetcontrol\Gateway\Http\Controllers\StatsController::class, 'totalPlanned']);
    $group->post('/stats/entries', [\Budgetcontrol\Gateway\Http\Controllers\StatsController::class, 'entries']);
    $group->get('/stats/debits', [\Budgetcontrol\Gateway\Http\Controllers\StatsController::class, 'debits']);
    $group->get('/stats/debits/total-negative', [\Budgetcontrol\Gateway\Http\Controllers\StatsController::class, 'debitsTotalNegative']);
    $group->get('/stats/debits/total-positive', [\Budgetcontrol\Gateway\Http\Controllers\StatsController::class, 'debitsTotalPositive']);
})
->add(\Budgetcontrol\Gateway\Http\Middleware\AuthMiddleware::class)
->add(new \Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware());


