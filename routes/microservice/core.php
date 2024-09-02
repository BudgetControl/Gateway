<?php

\Illuminate\Support\Facades\Route::get('/payment-types', '\App\Http\Controllers\CoreController@paymentTypes');
\Illuminate\Support\Facades\Route::get('/currencies', '\App\Http\Controllers\CoreController@currencies');
\Illuminate\Support\Facades\Route::get('/categories', '\App\Http\Controllers\CoreController@categories');
\Illuminate\Support\Facades\Route::get('/categories-subcategories', '\App\Http\Controllers\CoreController@categoriesSubcategories');
