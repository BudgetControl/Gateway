use Illuminate\Support\Facades\\Illuminate\Support\Facades\Route;

<?php

\Illuminate\Support\Facades\Route::get('/check', [\Budgetcontrol\Authtentication\Controller\AuthController::class, 'check']);
\Illuminate\Support\Facades\Route::get('/user-info', [\Budgetcontrol\Authtentication\Controller\AuthController::class, 'getUserInfo']);
\Illuminate\Support\Facades\Route::post('/sign-up', [\Budgetcontrol\Authtentication\Controller\SignUpController::class, 'signUp']);
\Illuminate\Support\Facades\Route::get('/confirm/{token}', [\Budgetcontrol\Authtentication\Controller\SignUpController::class, 'confirmToken']);
\Illuminate\Support\Facades\Route::post('/authenticate', [\Budgetcontrol\Authtentication\Controller\LoginController::class, 'authenticate']);
\Illuminate\Support\Facades\Route::post('/reset-password', [\Budgetcontrol\Authtentication\Controller\AuthController::class, 'resetPassword']);
\Illuminate\Support\Facades\Route::post('/verify-email', [\Budgetcontrol\Authtentication\Controller\AuthController::class, 'sendVerifyEmail']);
\Illuminate\Support\Facades\Route::put('/reset-password/{token}', [\Budgetcontrol\Authtentication\Controller\AuthController::class, 'resetPassword']);
\Illuminate\Support\Facades\Route::get('/authenticate/{provider}', [\Budgetcontrol\Authtentication\Controller\ProviderController::class, 'authenticateProvider']);
\Illuminate\Support\Facades\Route::get('/authenticate/token/{provider}', [\Budgetcontrol\Authtentication\Controller\ProviderController::class, 'providerToken']);
\Illuminate\Support\Facades\Route::get('/logout', [\Budgetcontrol\Authtentication\Controller\AuthController::class, 'logout']);
