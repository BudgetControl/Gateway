<?php

\Illuminate\Support\Facades\Route::group(['middleware' => [\App\Http\Middleware\AuthMiddleware::class]], function () {

    \Illuminate\Support\Facades\Route::get('/entry/expense', '\App\Http\Controllers\ExpensesController@list');
    \Illuminate\Support\Facades\Route::get('/entry/expense/{uuid}', '\App\Http\Controllers\EntryController@show');
    \Illuminate\Support\Facades\Route::post('/entry/expense', '\App\Http\Controllers\ExpensesController@create');
    \Illuminate\Support\Facades\Route::put('/entry/expense/{uuid}', '\App\Http\Controllers\ExpensesController@update');

    \Illuminate\Support\Facades\Route::get('/entry/income', '\App\Http\Controllers\IncomingController@list');
    \Illuminate\Support\Facades\Route::get('/entry/income/{uuid}', '\App\Http\Controllers\EntryController@show');
    \Illuminate\Support\Facades\Route::post('/entry/income', '\App\Http\Controllers\IncomingController@create');
    \Illuminate\Support\Facades\Route::put('/entry/income/{uuid}', '\App\Http\Controllers\IncomingController@update');

    \Illuminate\Support\Facades\Route::get('/entry/transfer', '\App\Http\Controllers\TransferController@list');
    \Illuminate\Support\Facades\Route::get('/entry/transfer/{uuid}', '\App\Http\Controllers\EntryController@show');
    \Illuminate\Support\Facades\Route::post('/entry/transfer', '\App\Http\Controllers\TransferController@create');
    \Illuminate\Support\Facades\Route::put('/entry/transfer/{uuid}', '\App\Http\Controllers\TransferController@update');

    \Illuminate\Support\Facades\Route::get('/entry/debit', '\App\Http\Controllers\PayeeController@list');
    \Illuminate\Support\Facades\Route::get('/entry/debit/{uuid}', '\App\Http\Controllers\EntryController@show');
    \Illuminate\Support\Facades\Route::post('/entry/debit', '\App\Http\Controllers\PayeeController@create');
    \Illuminate\Support\Facades\Route::put('/entry/debit/{uuid}', '\App\Http\Controllers\PayeeController@update');

    \Illuminate\Support\Facades\Route::delete('/entry/debit/{uuid}', '\App\Http\Controllers\PayeeController@delete');
    \Illuminate\Support\Facades\Route::delete('/entry/income/{uuid}', '\App\Http\Controllers\IncomingController@delete');
    \Illuminate\Support\Facades\Route::delete('/entry/expense/{uuid}', '\App\Http\Controllers\ExpensesController@delete');
    \Illuminate\Support\Facades\Route::delete('/entry/transfer/{uuid}', '\App\Http\Controllers\TransferController@delete');
    \Illuminate\Support\Facades\Route::delete('/entry/{uuid}', '\App\Http\Controllers\EntryController@delete');
    \Illuminate\Support\Facades\Route::delete('/entry/model/{uuid}', '\App\Http\Controllers\EntryModelController@delete');

    // MODEL
    \Illuminate\Support\Facades\Route::get('/entry/model', '\App\Http\Controllers\EntryModelController@list');
    \Illuminate\Support\Facades\Route::post('/entry/model', '\App\Http\Controllers\EntryModelController@create');
    \Illuminate\Support\Facades\Route::get('/entry/model/{uuid}', '\App\Http\Controllers\EntryModelController@show');
    \Illuminate\Support\Facades\Route::put('/entry/model/{uuid}', '\App\Http\Controllers\EntryModelController@update');

    // PLANNED ENTRY
    \Illuminate\Support\Facades\Route::get('/entry/planned', '\App\Http\Controllers\PlannedEntryController@list');
    \Illuminate\Support\Facades\Route::post('/entry/planned', '\App\Http\Controllers\PlannedEntryController@create');
    \Illuminate\Support\Facades\Route::get('/entry/planned/{uuid}', '\App\Http\Controllers\PlannedEntryController@show');
    \Illuminate\Support\Facades\Route::put('/entry/planned/{uuid}', '\App\Http\Controllers\PlannedEntryController@update');
    \Illuminate\Support\Facades\Route::delete('/entry/planned/{uuid}', '\App\Http\Controllers\PlannedEntryController@delete');

    // generic ENTRY
    \Illuminate\Support\Facades\Route::get('/entry/{uuid}', '\App\Http\Controllers\EntryController@show');
    \Illuminate\Support\Facades\Route::put('/entry/{uuid}', '\App\Http\Controllers\EntryController@update');
    \Illuminate\Support\Facades\Route::get('/entry', '\App\Http\Controllers\EntryController@list');
});