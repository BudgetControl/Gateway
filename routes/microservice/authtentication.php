<?php

$app->get('/api/auth/check', [\Budgetcontrol\Gateway\Http\Controllers\AuthController::class, 'check']);
$app->get('/api/auth/user-info', [\Budgetcontrol\Gateway\Http\Controllers\AuthController::class, 'getUserInfo']);
$app->post('/api/auth/sign-up', [\Budgetcontrol\Gateway\Http\Controllers\AuthController::class, 'signUp']);
$app->get('/api/auth/confirm/{token}', [\Budgetcontrol\Gateway\Http\Controllers\AuthController::class, 'confirmToken']);
$app->post('/api/auth/authenticate', [\Budgetcontrol\Gateway\Http\Controllers\AuthController::class, 'authenticate']);
$app->post('/api/auth/reset-password', [\Budgetcontrol\Gateway\Http\Controllers\AuthController::class, 'sendResetPasswordMail']);
$app->post('/api/auth/verify-email', [\Budgetcontrol\Gateway\Http\Controllers\AuthController::class, 'sendVerifyEmail']);
$app->put('/api/auth/reset-password/{token}', [\Budgetcontrol\Gateway\Http\Controllers\AuthController::class, 'resetPassword']);
$app->get('/api/auth/authenticate/{provider}', [\Budgetcontrol\Gateway\Http\Controllers\AuthController::class, 'authenticateProvider']);
$app->get('/api/auth/authenticate/token/{provider}', [\Budgetcontrol\Gateway\Http\Controllers\AuthController::class, 'providerToken']);
$app->get('/api/auth/logout', [\Budgetcontrol\Gateway\Http\Controllers\AuthController::class, 'logout']);
$app->get('/api/auth/user-info/by-email/{email}', [\Budgetcontrol\Gateway\Http\Controllers\AuthController::class, 'getUserInfoByEmail'])->add(\Budgetcontrol\Gateway\Http\Middleware\AuthMiddleware::class)->add(new \Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware(1440));

$app->post('/api/auth/{userUuid}/finalize/sign-up', [\Budgetcontrol\Gateway\Http\Controllers\AuthController::class, 'finalizeSignUp']);
