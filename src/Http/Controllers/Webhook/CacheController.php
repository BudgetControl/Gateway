<?php

declare(strict_types=1);

namespace Budgetcontrol\Gateway\Http\Controllers\Webhook;

use Budgetcontrol\Gateway\Traits\Cache;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Support\Facades\Log;

class CacheController extends \Budgetcontrol\Gateway\Http\Controllers\Controller
{
    use Cache;
    /**
     * Invalida la cache basata sulla richiesta del Webhook.
     */
    public function invalidateCache(Request $request, Response $response, $arg): Response
    {
        // Verifica del token
        $secret = env('WEBHOOK_SECRET');
        if($secret && $request->getHeaderLine('X-Webhook-Secret') !== $secret) {
            Log::warning('Invalid webhook secret');
            return response(['message' => 'Forbidden'], 403);
        }

        // Recupera il pattern dalla query string
        $pattern = $arg['pattern'];
        $workspaceUuid = $arg['workspaceUuid'];
        $cacheTags = cache_tags_mapping($arg['workspaceUuid'], $pattern);

        if(!array_key_exists($pattern, $cacheTags)) {
            Log::warning("Invalid cache pattern: $pattern");
            return response(['message' => 'Invalid cache pattern'], 400);
        }

        try {
            $this->cacheTags($cacheTags)->clearCache();
        } catch (\Exception $e) {
            Log::error('Error clearing cache: ' . $e->getMessage());
            return response(['message' => 'Internal Server Error'], 500);
        }


        return response([
            'status' => 'success',
            'message' => "Cache cleared for pattern: $pattern"
        ]);

    }

    /**
     * Invalidates all cached items.
     *
     * This method handles the request to invalidate the entire cache system.
     * It allows for clearing all cached data across the application.
     *
     * @param Request $request The HTTP request instance
     * @param Response $response The HTTP response instance
     * @return Response Returns the HTTP response after cache invalidation
     */
    public function invalidateCacheAll(Request $request, Response $response): Response
    {
        // Verifica del token
        $secret = env('WEBHOOK_SECRET');
        if($secret && $request->getHeaderLine('X-Webhook-Secret') !== $secret) {
            Log::warning('Invalid webhook secret');
            return response(['message' => 'Forbidden'], 403); 
        }

        $this->destroyCache();

        return response([
            'status' => 'success',
            'message' => "Cache cleared for all patterns"
        ]);
    }
}
