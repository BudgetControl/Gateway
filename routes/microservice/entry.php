<?php



\Illuminate\Support\Facades\Route::get('/entry/expense/{wsid}', \App\Http\Controllers\ExpensesController::class . ':get');
\Illuminate\Support\Facades\Route::get('/entry/expense//{uuid}', \App\Http\Controllers\EntryController::class . ':show');
\Illuminate\Support\Facades\Route::post('/entry/expense/{wsid}', \App\Http\Controllers\ExpensesController::class . ':create');
\Illuminate\Support\Facades\Route::put('/entry/expense/{uuid}', \App\Http\Controllers\ExpensesController::class . ':update');

\Illuminate\Support\Facades\Route::get('/entry/income/{wsid}', \App\Http\Controllers\IncomingController::class . ':get');
\Illuminate\Support\Facades\Route::get('/entry/income/{uuid}', \App\Http\Controllers\EntryController::class . ':show');
\Illuminate\Support\Facades\Route::post('/entry/income/{wsid}', \App\Http\Controllers\IncomingController::class . ':create');
\Illuminate\Support\Facades\Route::put('/entry/income/{uuid}', \App\Http\Controllers\IncomingController::class . ':update');

\Illuminate\Support\Facades\Route::get('/entry/transfer/{wsid}', \App\Http\Controllers\TransferController::class . ':get');
\Illuminate\Support\Facades\Route::get('/entry/transfer/{uuid}', \App\Http\Controllers\EntryController::class . ':show');
\Illuminate\Support\Facades\Route::post('/entry/transfer/{wsid}', \App\Http\Controllers\TransferController::class . ':create');
\Illuminate\Support\Facades\Route::put('/entry/transfer/{uuid}', \App\Http\Controllers\TransferController::class . ':update');

\Illuminate\Support\Facades\Route::get('/entry/debit/{wsid}', \App\Http\Controllers\DebitController::class . ':get');
\Illuminate\Support\Facades\Route::get('/entry/debit/{uuid}', \App\Http\Controllers\EntryController::class . ':show');
\Illuminate\Support\Facades\Route::post('/entry/debit/{wsid}', \App\Http\Controllers\DebitController::class . ':create');
\Illuminate\Support\Facades\Route::put('/entry/debit/{uuid}', \App\Http\Controllers\DebitController::class . ':update');

\Illuminate\Support\Facades\Route::delete('/entry/debit/{uuid}', \App\Http\Controllers\DebitController::class . ':delete');
\Illuminate\Support\Facades\Route::delete('/entry/income/{uuid}', \App\Http\Controllers\IncomingController::class . ':delete');
\Illuminate\Support\Facades\Route::delete('/entry/expense/{uuid}', \App\Http\Controllers\ExpensesController::class . ':delete');
\Illuminate\Support\Facades\Route::delete('/entry/transfer/{uuid}', \App\Http\Controllers\TransferController::class . ':delete');
\Illuminate\Support\Facades\Route::delete('/entry/{uuid}', \App\Http\Controllers\EntryController::class . ':delete');

\Illuminate\Support\Facades\Route::get('/entry/{uuid}', \App\Http\Controllers\EntryController::class . ':show');
\Illuminate\Support\Facades\Route::put('/entry/{uuid}', \App\Http\Controllers\EntryController::class . ':update');
\Illuminate\Support\Facades\Route::get('/entry/{wsid}', [\App\Http\Controllers\EntryController::class, 'list']);
