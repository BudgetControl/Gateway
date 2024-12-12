<?php

/**
 *  WEBHOOK GATEWAY
 */

 \Illuminate\Support\Facades\Route::post('/cache-invalidate', [\App\Http\Controllers\Webhook\CacheController::class, 'invalidateCache']);
