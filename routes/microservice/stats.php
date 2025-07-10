<?php
$app->group('/api', function ($group) {
    // ########### STATS CHART ###########
    $group->get('/stats/chart/line/incoming-expenses', [\Budgetcontrol\Gateway\Http\Controllers\ChartsController::class, 'incomingExpensesLineByDate'])->add(new \Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware(350));
    $group->get('/stats/chart/bar/expenses/category', [\Budgetcontrol\Gateway\Http\Controllers\ChartsController::class, 'expensesCategoryBarByDate'])->add(new \Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware(350));
    $group->get('/stats/chart/bar/incoming/category', [\Budgetcontrol\Gateway\Http\Controllers\ChartsController::class, 'incomingCategoryBarByDate'])->add(new \Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware(350));
    $group->get('/stats/chart/table/expenses/category', [\Budgetcontrol\Gateway\Http\Controllers\ChartsController::class, 'expensesCategoryTableByDate'])->add(new \Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware(350));
    $group->get('/stats/chart/table/incoming/category', [\Budgetcontrol\Gateway\Http\Controllers\ChartsController::class, 'incomingCategoryTableByDate'])->add(new \Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware(350));
    $group->get('/stats/chart/bar/expenses/label', [\Budgetcontrol\Gateway\Http\Controllers\ChartsController::class, 'expensesLabelBarByDate'])->add(new \Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware(900));
    $group->get('/stats/chart/apple-pie/expenses/label', [\Budgetcontrol\Gateway\Http\Controllers\ChartsController::class, 'expensesLabelApplePieByDate'])->add(new \Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware(900));

    // ########### STATS AVERANGE ###########
    $group->get('/stats/average-expenses', [\Budgetcontrol\Gateway\Http\Controllers\AverangeController::class, 'averageExpenses'])->add(new \Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware(350));
    $group->get('/stats/average-incoming', [\Budgetcontrol\Gateway\Http\Controllers\AverangeController::class, 'averageIncoming'])->add(new \Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware(350));
    $group->get('/stats/average-savings', [\Budgetcontrol\Gateway\Http\Controllers\AverangeController::class, 'averageSavings'])->add(new \Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware(350));
    $group->get('/stats/total-loan-installments', [\Budgetcontrol\Gateway\Http\Controllers\AverangeController::class, 'totalLoanInstallmentsOfCurrentMonth'])->add(new \Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware(350));
    $group->get('/stats/total/planned/remaining', [\Budgetcontrol\Gateway\Http\Controllers\AverangeController::class, 'totalPlannedRemainingOfCurrentMonth'])->add(new \Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware(350));
    $group->get('/stats/total/planned/monthly', [\Budgetcontrol\Gateway\Http\Controllers\AverangeController::class, 'totalPlannedMonthly'])->add(new \Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware(350));
})->add(\Budgetcontrol\Gateway\Http\Middleware\AuthMiddleware::class);



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
->add(new \Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware(350));


