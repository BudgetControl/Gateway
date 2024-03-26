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
    Route::get('/stats/total-planned', '\App\Http\Controllers\StatsController@totalPlanned');
});

Route::get('/auth/user-info', '\App\Http\Controllers\AuthController@getUserInfo');
Route::any('/{any}','\App\Http\Controllers\WorkspaceController@getRoutes')->where('any', '.*');
