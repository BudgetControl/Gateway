<?php

//# ########### STATS BUDGETS ###########
\Illuminate\Support\Facades\Route::get('/budgets', '\App\Http\Controllers\BudgetController@list');
\Illuminate\Support\Facades\Route::get('/budget/{uuid}', '\App\Http\Controllers\BudgetController@show');
\Illuminate\Support\Facades\Route::post('/budget/create', '\App\Http\Controllers\BudgetController@create');
\Illuminate\Support\Facades\Route::put('/budget/update/{uuid}', '\App\Http\Controllers\BudgetController@update');
\Illuminate\Support\Facades\Route::delete('/budget/delete/{uuid}', '\App\Http\Controllers\BudgetController@delete');
\Illuminate\Support\Facades\Route::get('/budget/{uuid}/expired', '\App\Http\Controllers\BudgetController@expired');
\Illuminate\Support\Facades\Route::get('/budget/{uuid}/exceeded', '\App\Http\Controllers\BudgetController@exceeded');
\Illuminate\Support\Facades\Route::get('/budget/{uuid}/status', '\App\Http\Controllers\BudgetController@status');