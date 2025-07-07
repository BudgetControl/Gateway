<?php

namespace Budgetcontrol\Gateway\Http\Middleware;

use Closure;
use Psr\Http\Message\ServerRequestInterface as Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class ResponseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //get new refresh token form cache
        Log::debug('Headers: ' . json_encode($request->getHeaders()));
        Log::debug('Body: ' . json_encode($request->getParsedBody()));
        
        // Process the request and get the response
        $response = $next($request);

        // Retrieve the new access token from the request (assuming it's set by the auth middleware)
        $newAccessToken = $request->attributes->get('new_access_token');

        // Add the new access token to the response headers
        if ($newAccessToken) {
            $response->headers->set('Authorization', 'Bearer ' . $newAccessToken);
        }

        Log::debug('Response: ' . json_encode($response));

        return $response;
    }
}
