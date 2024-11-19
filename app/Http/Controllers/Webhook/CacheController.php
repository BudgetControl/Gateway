<?php

declare(strict_types=1);

namespace App\Http\Controllers\Webhook;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CacheController extends \App\Http\Controllers\Controller
{
    /**
     * Invalida la cache basata sulla richiesta del Webhook.
     */
    public function invalidateCache(Request $request)
    {
        // Verifica del token
        $secret = config('services.webhook.secret');
        if ($request->header('Authorization') !== "Bearer {$secret}") {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Logica di invalidazione della cache
        $validated = $request->validate([
            'resource' => 'required|string',
            'id' => 'required|integer',
        ]);

        $cacheKey = "{$validated['resource']}:{$validated['id']}";
        if (Cache::has($cacheKey)) {
            Cache::forget($cacheKey);
            Log::debug("Cache key {$cacheKey} invalidated");
            return response()->json(['message' => 'Cache invalidated'], 200);
        }

        Log::debug("Cache key {$cacheKey} not found");
        return response()->json(['message' => 'Cache key not found'], 404);
    }
}
