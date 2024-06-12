<?php

require_once __DIR__ . '/microservice/authtentication.php';
require_once __DIR__ . '/microservice/stats.php';
require_once __DIR__ . '/microservice/workspace.php';
require_once __DIR__ . '/microservice/budget.php';
require_once __DIR__ . '/microservice/searchengine.php';

\Illuminate\Support\Facades\Route::any('/{any}','\App\Http\Controllers\WorkspaceController@getRoutes')->where('any', '.*');
\Illuminate\Support\Facades\Route::get('/monitor/{ms}','\App\Http\Controllers\Controller@monitor')->where('any', '.*');
