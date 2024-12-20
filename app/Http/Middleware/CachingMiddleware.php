<?php

namespace App\Http\Middleware;

use App\Traits\Cache;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CachingMiddleware
{
    use Cache;

    private int $ttl;

    public function __construct(?int $ttl = null)
    {
        $this->ttl = $ttl ?? config('cache.ttl');
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $key = $this->key($request);
        $this->initCache($key);
        if ($this->hasCache()) {
            Log::debug('From cache: ' . $this->getCacheKey());
            return response($this->getCache(), 200, ['Content-Type' => 'application/json']);
        }

        $response = $next($request);

        if ($response->isSuccessful()) {
            $this->setCache($response->getContent(), $this->ttl);
        }

        return $response;
    }

    /**
     * Generate a unique cache key based on the given request.
     *
     * @param Request $request The HTTP request object.
     * @return string The generated cache key.
     */
    private function key(Request $request): string
    {
        $fullUrl = $request->fullUrl();
        $bodyParams = $request->toArray();
        $wsUuid = $request->header('X-WS');

        return md5($fullUrl . json_encode($bodyParams) . $wsUuid);
    }
}
