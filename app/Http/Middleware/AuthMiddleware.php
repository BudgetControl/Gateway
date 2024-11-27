<?php

namespace App\Http\Middleware;

use App\Facade\AwsCognito;
use App\Service\AuthCognitoService;
use Closure;
use App\Service\JwtService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::debug('Request: ' . $request->fullUrl());
        Log::debug('Headers: ' . json_encode($request->header()));
        Log::debug('Body: ' . json_encode($request->all()));

        $token = $request->header('X-BC-Token');
        $authToken = $request->header('Authorization');

        if(empty($token) || empty($authToken)) {
            return response('Unauthorized', 401);
        }

        // Validate the token
        try {
            $decoded = JwtService::decodeToken($token);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response('Unauthorized', 401);
        }

        try {
            $authToken = str_replace('Bearer ', '', $authToken);
            $validToken = AwsCognito::validateAuthToken($authToken, $decoded['sub']);
            if ($validToken === false) {
                return response('Unauthorized', 401);
            }
        } catch (\Throwable $e) {
            Log::error("Token expired:" . $e->getMessage());
            return response('Unauthorized', 401);
        }

        $request->merge(['token' => $decoded]);

        $response = $next($request);
        $response->headers->set('Authorization', 'Bearer ' . $validToken);
        return $response;
    }
}
