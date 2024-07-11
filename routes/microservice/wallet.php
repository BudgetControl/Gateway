<?php
\Illuminate\Support\Facades\Route::group(['middleware' => [\App\Http\Middleware\AuthMiddleware::class]], function () {

//# ########### STATS WalletS ###########
\Illuminate\Support\Facades\Route::get('/list', '\App\Http\Controllers\WalletController@list');
\Illuminate\Support\Facades\Route::get('/show/{uuid}', '\App\Http\Controllers\WalletController@show');
\Illuminate\Support\Facades\Route::post('/create', '\App\Http\Controllers\WalletController@create');
\Illuminate\Support\Facades\Route::put('/update/{uuid}', '\App\Http\Controllers\WalletController@update');
\Illuminate\Support\Facades\Route::delete('/{uuid}', '\App\Http\Controllers\WalletController@delete');
\Illuminate\Support\Facades\Route::patch('/restore/{uuid}', '\App\Http\Controllers\WalletController@restore');
\Illuminate\Support\Facades\Route::patch('/sorting/{uuid}', '\App\Http\Controllers\WalletController@sorting');

});