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
        //cahche URL only if X-WS header exist
        $wsUuid = $request->header('X-WS');
        if (!$wsUuid) {
            Log::warning('No X-WS header found - skipping caching');
            return $next($request);
        }

        $key = $request->fullUrl()."_".$wsUuid;
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
}
