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
require_once __DIR__ . '/microservice/core.php';

\Illuminate\Support\Facades\Route::get('/monitor/{ms}','\App\Http\Controllers\BaseController@monitor');