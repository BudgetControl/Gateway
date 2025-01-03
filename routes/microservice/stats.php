<?php
\Illuminate\Support\Facades\Route::group(['middleware' => [\App\Http\Middleware\AuthMiddleware::class]], function () {
    // ########### STATS ###########
    \Illuminate\Support\Facades\Route::get('/stats/incoming', '\App\Http\Controllers\StatsController@incoming');
    \Illuminate\Support\Facades\Route::get('/stats/find/incoming', '\App\Http\Controllers\StatsController@statsIncoming');
    \Illuminate\Support\Facades\Route::get('/stats/expenses', '\App\Http\Controllers\StatsController@expenses');
    \Illuminate\Support\Facades\Route::get('/stats/find/expenses', '\App\Http\Controllers\StatsController@statsExpenses');
    \Illuminate\Support\Facades\Route::get('/stats/total', '\App\Http\Controllers\StatsController@total');
    \Illuminate\Support\Facades\Route::get('/stats/wallets', '\App\Http\Controllers\StatsController@wallets');
    \Illuminate\Support\Facades\Route::get('/stats/health', '\App\Http\Controllers\StatsController@health');
    \Illuminate\Support\Facades\Route::get('/stats/total/planned', '\App\Http\Controllers\StatsController@totalPlanned');
    \Illuminate\Support\Facades\Route::post('/stats/entries', '\App\Http\Controllers\StatsController@entries');
    \Illuminate\Support\Facades\Route::get('/stats/total/debits', '\App\Http\Controllers\StatsController@debits');

    // ########### STATS CHART ###########
    \Illuminate\Support\Facades\Route::get('/stats/chart/line/incoming-expenses', '\App\Http\Controllers\ChartsController@incomingExpensesLineByDate')->middleware([\App\Http\Middleware\CachingMiddleware::class . ':' . 60]);
    \Illuminate\Support\Facades\Route::get('/stats/chart/bar/expenses/category', '\App\Http\Controllers\ChartsController@expensesCategoryBarByDate')->middleware([\App\Http\Middleware\CachingMiddleware::class . ':' . 15]);
    \Illuminate\Support\Facades\Route::get('/stats/chart/bar/incoming/category', '\App\Http\Controllers\ChartsController@incomingCategoryBarByDate')->middleware([\App\Http\Middleware\CachingMiddleware::class . ':' . 15]);
    \Illuminate\Support\Facades\Route::get('/stats/chart/table/expenses/category', '\App\Http\Controllers\ChartsController@expensesCategoryTableByDate')->middleware([\App\Http\Middleware\CachingMiddleware::class . ':' . 15]);
    \Illuminate\Support\Facades\Route::get('/stats/chart/table/incoming/category', '\App\Http\Controllers\ChartsController@incomingCategoryTableByDate')->middleware([\App\Http\Middleware\CachingMiddleware::class . ':' . 15]);
    \Illuminate\Support\Facades\Route::get('/stats/chart/bar/expenses/label', '\App\Http\Controllers\ChartsController@expensesLabelBarByDate')->middleware([\App\Http\Middleware\CachingMiddleware::class . ':' . 30]);
    \Illuminate\Support\Facades\Route::get('/stats/chart/apple-pie/expenses/label', '\App\Http\Controllers\ChartsController@expensesLabelApplePieByDate')->middleware([\App\Http\Middleware\CachingMiddleware::class . ':' . 30]);

    // ########### STATS AVERANGE ###########
    \Illuminate\Support\Facades\Route::get('/stats/average-expenses', '\App\Http\Controllers\AverangeController@averageExpenses')->middleware([\App\Http\Middleware\CachingMiddleware::class . ':' . 60]);
    \Illuminate\Support\Facades\Route::get('/stats/average-incoming', '\App\Http\Controllers\AverangeController@averageIncoming')->middleware([\App\Http\Middleware\CachingMiddleware::class . ':' . 60]);
    \Illuminate\Support\Facades\Route::get('/stats/average-savings', '\App\Http\Controllers\AverangeController@averageSavings')->middleware([\App\Http\Middleware\CachingMiddleware::class . ':' . 60]);
    \Illuminate\Support\Facades\Route::get('/stats/total-loan-installments', '\App\Http\Controllers\AverangeController@totalLoanInstallmentsOfCurrentMonth')->middleware([\App\Http\Middleware\CachingMiddleware::class . ':' . 60]);
    \Illuminate\Support\Facades\Route::get('/stats/total/planned/remaining', '\App\Http\Controllers\AverangeController@totalPlannedRemainingOfCurrentMonth')->middleware([\App\Http\Middleware\CachingMiddleware::class . ':' . 60]);
    \Illuminate\Support\Facades\Route::get('/stats/total/planned/monthly', '\App\Http\Controllers\AverangeController@totalPlannedMonthly')->middleware([\App\Http\Middleware\CachingMiddleware::class . ':' . 60]);

});
