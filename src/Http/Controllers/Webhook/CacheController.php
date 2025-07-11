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
        $cacheTags = cache_tags_mapping();

        if(!array_key_exists($pattern, $cacheTags)) {
            Log::warning("Invalid cache pattern: $pattern");
            return response(['message' => 'Invalid cache pattern'], 400);
        }

        try {
            $this->cacheTags($cacheTags[$pattern])->clearCache();
        } catch (\Exception $e) {
            Log::error('Error clearing cache: ' . $e->getMessage());
            return response(['message' => 'Internal Server Error'], 500);
        }


        return response([
            'status' => 'success',
            'message' => "Cache cleared for pattern: $pattern"
        ]);

    }
}
