<?php

require_once __DIR__ . '/microservice/authtentication.php';
require_once __DIR__ . '/microservice/stats.php';
require_once __DIR__ . '/microservice/workspace.php';
require_once __DIR__ . '/microservice/budget.php';
require_once __DIR__ . '/microservice/searchengine.php';
require_once __DIR__ . '/microservice/wallet.php';
require_once __DIR__ . '/microservice/entry.php';
require_once __DIR__ . '/microservice/debt.php';
require_once __DIR__ . '/microservice/label.php';

\Illuminate\Support\Facades\Route::get('/payment-types', '\App\Http\Controllers\CoreController@paymentTypes');
\Illuminate\Support\Facades\Route::get('/currencies', '\App\Http\Controllers\CoreController@currencies');
\Illuminate\Support\Facades\Route::get('/categories', '\App\Http\Controllers\CoreController@categories');
\Illuminate\Support\Facades\Route::get('/monitor/{ms}','\App\Http\Controllers\BaseController@monitor');