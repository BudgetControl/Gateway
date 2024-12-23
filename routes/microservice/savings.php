<?php

\Illuminate\Support\Facades\Route::group(['middleware' => [\App\Http\Middleware\AuthMiddleware::class]], function () {

    \Illuminate\Support\Facades\Route::get('/entry/saving', '\App\Http\Controllers\SavingsController@list');
    \Illuminate\Support\Facades\Route::get('/entry/saving/{uuid}', '\App\Http\Controllers\EntryController@show');
    \Illuminate\Support\Facades\Route::post('/entry/saving', '\App\Http\Controllers\SavingsController@create');
    \Illuminate\Support\Facades\Route::put('/entry/saving/{uuid}', '\App\Http\Controllers\SavingsController@update');
    \Illuminate\Support\Facades\Route::delete('/entry/saving/{uuid}', '\App\Http\Controllers\SavingsController@delete');

});