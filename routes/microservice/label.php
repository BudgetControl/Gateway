<?php

\Illuminate\Support\Facades\Route::group(['middleware' => [\App\Http\Middleware\AuthMiddleware::class]], function () {

    \Illuminate\Support\Facades\Route::get('/label/list', '\App\Http\Controllers\LabelController@list');

});