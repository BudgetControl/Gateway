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
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $this->initCache($request->fullUrl());

        if ($this->hasCache()) {
            Log::debug('From cache: ' . $request->fullUrl());
            return response($this->getCache(), 200, ['Content-Type' => 'application/json']);
        }

        $response = $next($request);

        if ($response->isSuccessful()) {
            $this->setCache($response->getContent());
        }

        return $response;
    }
}
