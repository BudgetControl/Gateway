<?php
\Illuminate\Support\Facades\Route::group(['middleware' => [\App\Http\Middleware\AuthMiddleware::class]], function () {
    // ########### WORKSPACE ###########
    \Illuminate\Support\Facades\Route::get('/workspace/list', '\App\Http\Controllers\WorkspaceController@list');
    \Illuminate\Support\Facades\Route::get('/workspace/by-user/list', '\App\Http\Controllers\WorkspaceController@listByUser');
    \Illuminate\Support\Facades\Route::get('/workspace/last', '\App\Http\Controllers\WorkspaceController@last');
    \Illuminate\Support\Facades\Route::get('/workspace/{id}', '\App\Http\Controllers\WorkspaceController@show');
    \Illuminate\Support\Facades\Route::post('/workspace/create', '\App\Http\Controllers\WorkspaceController@create');
    \Illuminate\Support\Facades\Route::put('/workspace/update/{id}', '\App\Http\Controllers\WorkspaceController@update');
    \Illuminate\Support\Facades\Route::patch('/workspace/activate/{id}', '\App\Http\Controllers\WorkspaceController@activate');
});