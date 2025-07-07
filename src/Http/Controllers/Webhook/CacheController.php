<?php

declare(strict_types=1);

namespace Budgetcontrol\Gateway\Http\Controllers\Webhook;

use Psr\Http\Message\ServerRequestInterface as Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CacheController extends \Budgetcontrol\Gateway\Http\Controllers\Controller
{
    /**
     * Invalida la cache basata sulla richiesta del Webhook.
     */
    public function invalidateCache(Request $request)
    {
        // Verifica del token
        $secret = env('WEBHOOK_SECRET');
        if ($request->getHeader('Authorization') !== "Bearer {$secret}") {
            return response(['message' => 'Unauthorized'], 401);
        }

        $cacheKey = "{$request->getParsedBody()['resource']}:{$request->getParsedBody()['id']}";
        if (Cache::has($cacheKey)) {
            Cache::forget($cacheKey);
            Log::debug("Cache key {$cacheKey} invalidated");
            return response(['message' => 'Cache invalidated'], 200);
        }

        Log::debug("Cache key {$cacheKey} not found");
        return response(['message' => 'Cache key not found'], 404);
    }
}
