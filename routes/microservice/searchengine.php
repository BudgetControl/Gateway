<?php
\Illuminate\Support\Facades\Route::group(['middleware' => [\App\Http\Middleware\AuthMiddleware::class]], function () {
    // ########### STATS ###########
    \Illuminate\Support\Facades\Route::post('/find', '\App\Http\Controllers\SearchEngine@find');
});