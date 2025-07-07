<?php
$app->group('/api', function ($group) {
    // ########### STATS ###########
    $group->post('/find', [\Budgetcontrol\Gateway\Http\Controllers\SearchEngine::class, 'find'])->add(\Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware::class . ':10');
})->add(\Budgetcontrol\Gateway\Http\Middleware\AuthMiddleware::class);