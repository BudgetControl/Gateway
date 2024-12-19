<?php
\Illuminate\Support\Facades\Route::group(['middleware' => [\App\Http\Middleware\AuthMiddleware::class]], function () {

//# ########### STATS WalletS ###########
\Illuminate\Support\Facades\Route::get('/wallet/list', '\App\Http\Controllers\WalletController@list');
\Illuminate\Support\Facades\Route::get('/wallet/show/{uuid}', '\App\Http\Controllers\WalletController@show');
\Illuminate\Support\Facades\Route::post('/wallet/create', '\App\Http\Controllers\WalletController@create');
\Illuminate\Support\Facades\Route::put('/wallet/update/{uuid}', '\App\Http\Controllers\WalletController@update');
\Illuminate\Support\Facades\Route::delete('/wallet/{uuid}', '\App\Http\Controllers\WalletController@delete');
\Illuminate\Support\Facades\Route::patch('/wallet/restore/{uuid}', '\App\Http\Controllers\WalletController@restore');
\Illuminate\Support\Facades\Route::patch('/wallet/sorting/{uuid}', '\App\Http\Controllers\WalletController@sorting');
\Illuminate\Support\Facades\Route::patch('/wallet/archive/{uuid}', '\App\Http\Controllers\WalletController@archive');

});