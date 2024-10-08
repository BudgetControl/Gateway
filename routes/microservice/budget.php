<?php
\Illuminate\Support\Facades\Route::group(['middleware' => [\App\Http\Middleware\AuthMiddleware::class]], function () {

//# ########### STATS BUDGETS ###########
\Illuminate\Support\Facades\Route::get('/budgets', '\App\Http\Controllers\BudgetController@list');
\Illuminate\Support\Facades\Route::get('/budget/{uuid}', '\App\Http\Controllers\BudgetController@show');
\Illuminate\Support\Facades\Route::post('/budget/create', '\App\Http\Controllers\BudgetController@create');
\Illuminate\Support\Facades\Route::put('/budget/update/{uuid}', '\App\Http\Controllers\BudgetController@update');
\Illuminate\Support\Facades\Route::delete('/budget/{uuid}', '\App\Http\Controllers\BudgetController@delete');
\Illuminate\Support\Facades\Route::get('/budget/{uuid}/expired', '\App\Http\Controllers\BudgetController@expired');
\Illuminate\Support\Facades\Route::get('/budget/{uuid}/exceeded', '\App\Http\Controllers\BudgetController@exceeded');
\Illuminate\Support\Facades\Route::get('/budget/{uuid}/status', '\App\Http\Controllers\BudgetController@status');
\Illuminate\Support\Facades\Route::get('/budget/{uuid}/stats', '\App\Http\Controllers\BudgetController@budgetStats');
\Illuminate\Support\Facades\Route::get('/budgets/stats', '\App\Http\Controllers\BudgetController@budgetsStats');
\Illuminate\Support\Facades\Route::get('/budget/{uuid}/entry-list', '\App\Http\Controllers\BudgetController@entryList');

});