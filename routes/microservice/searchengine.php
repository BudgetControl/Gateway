<?php
$app->group('/api', function ($group) {
    // ########### STATS ###########
    $group->post('/find', [\Budgetcontrol\Gateway\Http\Controllers\SearchEngine::class, 'find'])->add(new \Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware(10));
})->add(\Budgetcontrol\Gateway\Http\Middleware\AuthMiddleware::class);