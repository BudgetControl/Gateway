<?php

/**
 *  WEBHOOK GATEWAY
 */

 $app->post('/cache-invalidate', [\Budgetcontrol\Gateway\Http\Controllers\Webhook\CacheController::class, 'invalidateCache']);
