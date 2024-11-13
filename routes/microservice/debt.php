<?php

\Illuminate\Support\Facades\Route::group(['middleware' => [\App\Http\Middleware\AuthMiddleware::class]], function () {

    \Illuminate\Support\Facades\Route::get('/payees', '\App\Http\Controllers\DebtController@payeeList');
    \Illuminate\Support\Facades\Route::get('/debits', '\App\Http\Controllers\DebtController@getDebits');
    \Illuminate\Support\Facades\Route::delete('/debt/{uuid}', '\App\Http\Controllers\DebtController@deleteDebt');

});