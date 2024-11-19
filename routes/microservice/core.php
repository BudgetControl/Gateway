<?php

\Illuminate\Support\Facades\Route::get('/payment-types', '\App\Http\Controllers\CoreController@paymentTypes')->middleware([\App\Http\Middleware\CachingMiddleware::class . ':' . 1440]);
\Illuminate\Support\Facades\Route::get('/currencies', '\App\Http\Controllers\CoreController@currencies')->middleware([\App\Http\Middleware\CachingMiddleware::class . ':' . 1440]);
\Illuminate\Support\Facades\Route::get('/categories', '\App\Http\Controllers\CoreController@categories')->middleware([\App\Http\Middleware\CachingMiddleware::class . ':' . 1440]);
\Illuminate\Support\Facades\Route::get('/categories-subcategories', '\App\Http\Controllers\CoreController@categoriesSubcategories')->middleware([\App\Http\Middleware\CachingMiddleware::class . ':' . 1440]);
