<?php
$app->group('/api', function ($group) {
    $group->get('/payment-types', '\Budgetcontrol\Gateway\Http\Controllers\CoreController@paymentTypes');
    $group->get('/currencies', '\Budgetcontrol\Gateway\Http\Controllers\CoreController@currencies');
    $group->get('/categories', '\Budgetcontrol\Gateway\Http\Controllers\CoreController@categories');
    $group->get('/categories-subcategories', '\Budgetcontrol\Gateway\Http\Controllers\CoreController@categoriesSubcategories');
})->add(\Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware::class . ':43200')->add(\Budgetcontrol\Gateway\Http\Middleware\AuthMiddleware::class);