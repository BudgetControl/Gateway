<?php

require_once __DIR__ . '/microservice/authtentication.php';
require_once __DIR__ . '/microservice/stats.php';
require_once __DIR__ . '/microservice/workspace.php';

\Illuminate\Support\Facades\Route::any('/{any}','\App\Http\Controllers\WorkspaceController@getRoutes')->where('any', '.*');


