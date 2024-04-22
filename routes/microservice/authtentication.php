use Illuminate\Support\Facades\\Illuminate\Support\Facades\Route;

<?php

\Illuminate\Support\Facades\Route::get('/check', [\App\Http\Controllers\AuthController::class, 'check']);
\Illuminate\Support\Facades\Route::get('/user-info', [\App\Http\Controllers\AuthController::class, 'getUserInfo']);
\Illuminate\Support\Facades\Route::post('/sign-up', [\App\Http\Controllers\AuthController::class, 'signUp']);
\Illuminate\Support\Facades\Route::get('/confirm/{token}', [\App\Http\Controllers\AuthController::class, 'confirmToken']);
\Illuminate\Support\Facades\Route::post('/authenticate', [\App\Http\Controllers\AuthController::class, 'authenticate']);
\Illuminate\Support\Facades\Route::post('/reset-password', [\App\Http\Controllers\AuthController::class, 'resetPassword']);
\Illuminate\Support\Facades\Route::post('/verify-email', [\App\Http\Controllers\AuthController::class, 'sendVerifyEmail']);
\Illuminate\Support\Facades\Route::put('/reset-password/{token}', [\App\Http\Controllers\AuthController::class, 'resetPassword']);
\Illuminate\Support\Facades\Route::get('/authenticate/{provider}', [\App\Http\Controllers\AuthController::class, 'authenticateProvider']);
\Illuminate\Support\Facades\Route::get('/authenticate/token/{provider}', [\App\Http\Controllers\AuthController::class, 'providerToken']);
\Illuminate\Support\Facades\Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
