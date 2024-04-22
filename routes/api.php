<?php

require_once __DIR__ . '/microservice/authtentication.php';

\Illuminate\Support\Facades\Route::any('/{any}','\App\Http\Controllers\WorkspaceController@getRoutes')->where('any', '.*');