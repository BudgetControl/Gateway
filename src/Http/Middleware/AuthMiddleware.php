<?php

namespace Budgetcontrol\Gateway\Http\Middleware;

use Closure;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Support\Facades\Log;
use Budgetcontrol\Gateway\Service\JwtService;
use Budgetcontrol\Gateway\Facade\AwsCognitoClient as AwsCognito;
use Slim\Psr7\Response as SlimResponse;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $uri = $request->getUri();
        $headers = $request->getHeaders();
        $body = $request->getParsedBody();
        
        Log::debug('Request: ' . $uri->__toString());
        Log::debug('Headers: ' . json_encode($headers));
        Log::debug('Body: ' . json_encode($body));

        $tokenHeaders = $request->getHeader('X-BC-Token');
        $authHeaders = $request->getHeader('Authorization');
        
        $token = !empty($tokenHeaders) ? $tokenHeaders[0] : null;
        $authToken = !empty($authHeaders) ? $authHeaders[0] : null;

        // Validate request
        $validationResult = $this->validateRequest($token, $authToken);
        if ($validationResult['error']) {
            return $this->createUnauthorizedResponse(['error' => 'Unauthorized']);
        }

        // Add decoded token to request attributes
        $request = $request->withAttribute('token', $validationResult['decoded']);

        $response = $next($request);
        return $response->withHeader('Authorization', 'Bearer ' . $validationResult['validToken']);
    }

    private function validateRequest($token, $authToken): array
    {
        $errorResult = ['error' => true];
        
        // Early validation checks
        if (empty($authToken)) {
            return $errorResult;
        }

        $decoded = $this->validateJwtToken($token);
        if ($decoded === false) {
            return $errorResult;
        }

        // Final validation
        $validToken = $this->validateAuthToken($authToken, $decoded['username']);
        
        return $validToken === false
            ? $errorResult
            : [
                'error' => false,
                'decoded' => $decoded,
                'validToken' => $validToken
            ];
    }

    private function validateJwtToken($token)
    {
        try {
            return JwtService::decodeToken($token);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    private function validateAuthToken(string $authToken, string $username)
    {
        try {
            $authToken = str_replace('Bearer ', '', $authToken);
            return AwsCognito::validateAuthToken($authToken, $username);
        } catch (\Throwable $e) {
            Log::error("Token expired:" . $e->getMessage());
            return false;
        }
    }

    private function createUnauthorizedResponse(array $data): Response
    {
        $response = new SlimResponse();
        $response->getBody()->write(json_encode($data));
        return $response->withStatus(401)->withHeader('Content-Type', 'application/json');
    }
}
