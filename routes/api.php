<?php

require_once __DIR__ . '/microservice/authtentication.php';
require_once __DIR__ . '/microservice/stats.php';
require_once __DIR__ . '/microservice/workspace.php';
require_once __DIR__ . '/microservice/budget.php';
require_once __DIR__ . '/microservice/searchengine.php';
require_once __DIR__ . '/microservice/wallet.php';
require_once __DIR__ . '/microservice/entry.php';

\Illuminate\Support\Facades\Route::get('/payment-types', '\App\Http\Controllers\BaseController@payment-types');
\Illuminate\Support\Facades\Route::get('/currencies', '\App\Http\Controllers\BaseController@currencies');
\Illuminate\Support\Facades\Route::get('/categories', '\App\Http\Controllers\BaseController@categories');
\Illuminate\Support\Facades\Route::get('/monitor/{ms}','\App\Http\Controllers\BaseController@monitor');