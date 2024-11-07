<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class ResponseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //get new refresh token form cache
        Log::debug('Headers: ' . json_encode($request->header()));
        Log::debug('Body: ' . json_encode($request->all()));
        
        // Process the request and get the response
        $response = $next($request);

        // Retrieve the new access token from the request (assuming it's set by the auth middleware)
        $newAccessToken = $request->attributes->get('new_access_token');

        // Add the new access token to the response headers
        if ($newAccessToken) {
            $response->headers->set('Authorization', 'Bearer ' . $newAccessToken);
        }

        return $response;
    }
}
