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

    // ########### STATS CHART ###########
    \Illuminate\Support\Facades\Route::get('/stats/chart/line/incoming-expenses', '\App\Http\Controllers\ChartsController@incomingExpensesLineByDate');
    \Illuminate\Support\Facades\Route::get('/stats/chart/bar/expenses/category', '\App\Http\Controllers\ChartsController@expensesCategoryBarByDate');
    \Illuminate\Support\Facades\Route::get('/stats/chart/bar/incoming/category', '\App\Http\Controllers\ChartsController@incomingCategoryBarByDate');
    \Illuminate\Support\Facades\Route::get('/stats/chart/table/expenses/category', '\App\Http\Controllers\ChartsController@expensesCategoryTableByDate');
    \Illuminate\Support\Facades\Route::get('/stats/chart/table/incoming/category', '\App\Http\Controllers\ChartsController@incomingCategoryTableByDate');
    \Illuminate\Support\Facades\Route::get('/stats/chart/bar/expenses/label', '\App\Http\Controllers\ChartsController@expensesLabelBarByDate');
    \Illuminate\Support\Facades\Route::get('/stats/chart/apple-pie/expenses/label', '\App\Http\Controllers\ChartsController@expensesLabelApplePieByDate');

    //# ########### STATS BUDGETS ###########
    \Illuminate\Support\Facades\Route::get('/stats/budgets', '\App\Http\Controllers\BudgetController@budgetsList');
    \Illuminate\Support\Facades\Route::get('/stats/budget/{id}', '\App\Http\Controllers\BudgetController@budgetsShow');
    \Illuminate\Support\Facades\Route::post('/stats/budget/create', '\App\Http\Controllers\BudgetController@budgetsCreate');
    \Illuminate\Support\Facades\Route::put('/stats/budget/update/{id}', '\App\Http\Controllers\BudgetController@budgetsUpdate');
    \Illuminate\Support\Facades\Route::delete('/stats/budget/delete/{id}', '\App\Http\Controllers\BudgetController@budgetsDelete');
});