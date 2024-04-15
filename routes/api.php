<?php

use Illuminate\Support\Facades\Route;

// ########### WORKSPACE ###########

Route::group(['middleware' => [\App\Http\Middleware\AuthMiddleware::class]], function () {
    // ########### WORKSPACE ###########
    Route::get('/workspace/list', '\App\Http\Controllers\WorkspaceController@list');
    Route::get('/workspace/last', '\App\Http\Controllers\WorkspaceController@last');
    Route::get('/workspace/{id}', '\App\Http\Controllers\WorkspaceController@show');
    Route::post('/workspace/create', '\App\Http\Controllers\WorkspaceController@create');
    Route::put('/workspace/update/{id}', '\App\Http\Controllers\WorkspaceController@update');
    Route::patch('/workspace/activate/{id}', '\App\Http\Controllers\WorkspaceController@activate');

    // ########### AUTH USER ###########
    Route::get('/auth/check', '\App\Http\Controllers\AuthController@check');

    // ########### STATS ###########
    Route::get('/stats/incoming', '\App\Http\Controllers\StatsController@incoming');
    Route::get('/stats/find/incoming', '\App\Http\Controllers\StatsController@statsIncoming');
    Route::get('/stats/expenses', '\App\Http\Controllers\StatsController@expenses');
    Route::get('/stats/find/expenses', '\App\Http\Controllers\StatsController@statsExpenses');
    Route::get('/stats/total', '\App\Http\Controllers\StatsController@total');
    Route::get('/stats/wallets', '\App\Http\Controllers\StatsController@wallets');
    Route::get('/stats/health', '\App\Http\Controllers\StatsController@health');
    Route::get('/stats/total/planned', '\App\Http\Controllers\StatsController@totalPlanned');

    // ########### STATS CHART ###########
    Route::get('/stats/chart/line/incoming-expenses', '\App\Http\Controllers\ChartsController@incomingExpensesLineByDate');
    Route::get('/stats/chart/bar/expenses/category', '\App\Http\Controllers\ChartsController@expensesCategoryBarByDate');
    Route::get('/stats/chart/bar/incoming/category', '\App\Http\Controllers\ChartsController@incomingCategoryBarByDate');
    Route::get('/stats/chart/table/expenses/category', '\App\Http\Controllers\ChartsController@expensesCategoryTableByDate');
    Route::get('/stats/chart/table/incoming/category', '\App\Http\Controllers\ChartsController@incomingCategoryTableByDate');
    Route::get('/stats/chart/bar/expenses/label', '\App\Http\Controllers\ChartsController@expensesLabelBarByDate');
    Route::get('/stats/chart/apple-pie/expenses/label', '\App\Http\Controllers\ChartsController@expensesLabelApplePieByDate');

    //# ########### STATS BUDGETS ###########
    Route::get('/stats/budgets', '\App\Http\Controllers\BudgetController@budgetsList');
    Route::get('/stats/budget/{id}', '\App\Http\Controllers\BudgetController@budgetsShow');
    Route::post('/stats/budget/create', '\App\Http\Controllers\BudgetController@budgetsCreate');
    Route::put('/stats/budget/update/{id}', '\App\Http\Controllers\BudgetController@budgetsUpdate');
    Route::delete('/stats/budget/delete/{id}', '\App\Http\Controllers\BudgetController@budgetsDelete');
});

Route::get('/auth/user-info', '\App\Http\Controllers\AuthController@getUserInfo');
Route::get('/auth/logout', '\App\Http\Controllers\AuthController@logout');
Route::any('/{any}','\App\Http\Controllers\WorkspaceController@getRoutes')->where('any', '.*');