<?php

\Illuminate\Support\Facades\Route::group(['middleware' => [\App\Http\Middleware\AuthMiddleware::class]], function () {

    \Illuminate\Support\Facades\Route::get('/label/list', '\App\Http\Controllers\LabelController@list');
    \Illuminate\Support\Facades\Route::put('/label/{label_id}', '\App\Http\Controllers\LabelController@update');
    \Illuminate\Support\Facades\Route::post('/label/{label_id}', '\App\Http\Controllers\LabelController@insert');
    \Illuminate\Support\Facades\Route::get('/label/{label_id}', '\App\Http\Controllers\LabelController@show');
    \Illuminate\Support\Facades\Route::patch('/label/{label_id}', '\App\Http\Controllers\LabelController@patch');
    \Illuminate\Support\Facades\Route::delete('/label/{label_id}', '\App\Http\Controllers\LabelController@delete');

});