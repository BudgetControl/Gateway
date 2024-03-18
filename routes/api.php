<?php

use Illuminate\Support\Facades\Route;

Route::get('/workspace/list', '\App\Http\Controllers\WorkspaceController@list');
Route::get('/workspace/last', '\App\Http\Controllers\WorkspaceController@last');
Route::get('/workspace/{id}', '\App\Http\Controllers\WorkspaceController@show');
Route::post('/workspace/create', '\App\Http\Controllers\WorkspaceController@create');
Route::put('/workspace/update/{id}', '\App\Http\Controllers\WorkspaceController@update');
Route::patch('/workspace/activate/{id}', '\App\Http\Controllers\WorkspaceController@activate');