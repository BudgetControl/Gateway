<?php

declare(strict_types=1);

namespace Budgetcontrol\Gateway\Http\Controllers\Webhook;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CacheController extends \Budgetcontrol\Gateway\Http\Controllers\Controller
{
    /**
     * Invalida la cache basata sulla richiesta del Webhook.
     */
    public function invalidateCache(Request $request, Response $response): Response
    {
        // Verifica del token
        $secret = env('WEBHOOK_SECRET');
        if ($request->getHeader('Authorization') !== "Bearer {$secret}") {
            $response->getBody()->write(json_encode(['message' => 'Unauthorized']));
            return $response->withStatus(401)->withHeader('Content-Type', 'application/json');
        }

        $cacheKey = "{$request->getParsedBody()['resource']}:{$request->getParsedBody()['id']}";
        if (Cache::has($cacheKey)) {
            Cache::forget($cacheKey);
            Log::debug("Cache key {$cacheKey} invalidated");
            $response->getBody()->write(json_encode(['message' => 'Cache invalidated']));
            return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
        }

        Log::debug("Cache key {$cacheKey} not found");
        $response->getBody()->write(json_encode(['message' => 'Cache key not found']));
        return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
    }
}
