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
        $ttl = config('cache.ttl');
        $key = $request->fullUrl().$request->header('X-BC-Token');

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
