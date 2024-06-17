use Illuminate\Support\Facades\\Illuminate\Support\Facades\Route;

<?php
\Illuminate\Support\Facades\Route::group(['middleware' => [\App\Http\Middleware\AuthMiddleware::class]], function () {

    \Illuminate\Support\Facades\Route::get('/entry', [\App\Http\Controllers\EntryController::class, 'list']);

});