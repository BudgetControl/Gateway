<?php

use Illuminate\Support\Facades\Route;

Route::any('/{any}','\App\Http\Controllers\WorkspaceController@getRoutes')->where('any', '.*');