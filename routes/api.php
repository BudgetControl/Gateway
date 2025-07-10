<?php

// Add CORS headers middleware
// Add CORS middleware
$app->add(function ($request, $handler) {
    $response = $handler->handle($request);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', '*')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS')
        ->withHeader('Access-Control-Allow-Credentials', 'true');
});

// Handle OPTIONS requests
$app->options('/{routes:.+}', function ($request, $response) {
    return $response;
});

$app->get('/',function () {
    return response([
        'status' => 'ok',
        'message' => 'BudgetControl Gateway is running',
        'environment' => env('APP_ENV', 'production'),
    ]);
});

$app->get('/api',function () {
    return response([
        'status' => 'ok',
        'message' => 'BudgetControl Gateway API is running',
        'environment' => env('APP_ENV', 'production'),
    ]);
});

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
require_once __DIR__ . '/microservice/goals.php';


$app->get('/api/monitor/{ms}','\Budgetcontrol\Gateway\Http\Controllers\BaseController@monitor');