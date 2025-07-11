<?php
$app->group('/api', function ($group) {
    $group->get('/payment-types', [\Budgetcontrol\Gateway\Http\Controllers\CoreController::class, 'paymentTypes']);
    $group->get('/currencies', [\Budgetcontrol\Gateway\Http\Controllers\CoreController::class, 'currencies']);
    $group->get('/categories', [\Budgetcontrol\Gateway\Http\Controllers\CoreController::class, 'categories']);
    $group->get('/categories-subcategories', [\Budgetcontrol\Gateway\Http\Controllers\CoreController::class, 'categoriesSubcategories']);
})->add(new \Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware(604800))->add(\Budgetcontrol\Gateway\Http\Middleware\AuthMiddleware::class);