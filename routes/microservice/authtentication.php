use Illuminate\Support\Facades\\Illuminate\Support\Facades\Route;

<?php

\Illuminate\Support\Facades\Route::get('/auth/check', [\App\Http\Controllers\AuthController::class, 'check']);
\Illuminate\Support\Facades\Route::get('/auth/user-info', [\App\Http\Controllers\AuthController::class, 'getUserInfo']);
\Illuminate\Support\Facades\Route::post('/auth/sign-up', [\App\Http\Controllers\AuthController::class, 'signUp']);
\Illuminate\Support\Facades\Route::get('/auth/confirm/{token}', [\App\Http\Controllers\AuthController::class, 'confirmToken']);
\Illuminate\Support\Facades\Route::post('/auth/authenticate', [\App\Http\Controllers\AuthController::class, 'authenticate']);
\Illuminate\Support\Facades\Route::post('/auth/reset-password', [\App\Http\Controllers\AuthController::class, 'resetPassword']);
\Illuminate\Support\Facades\Route::post('/auth/verify-email', [\App\Http\Controllers\AuthController::class, 'sendVerifyEmail']);
\Illuminate\Support\Facades\Route::put('/auth/reset-password/{token}', [\App\Http\Controllers\AuthController::class, 'resetPassword']);
\Illuminate\Support\Facades\Route::get('/auth/authenticate/{provider}', [\App\Http\Controllers\AuthController::class, 'authenticateProvider']);
\Illuminate\Support\Facades\Route::get('/auth/authenticate/token/{provider}', [\App\Http\Controllers\AuthController::class, 'providerToken']);
\Illuminate\Support\Facades\Route::get('/auth/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
