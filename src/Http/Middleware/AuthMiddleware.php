<?php

namespace Budgetcontrol\Gateway\Http\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Illuminate\Support\Facades\Log;
use Budgetcontrol\Gateway\Service\JwtService;
use Budgetcontrol\Gateway\Facade\AwsCognitoClient as AwsCognito;
use Slim\Psr7\Response as SlimResponse;
use Slim\Psr7\Factory\StreamFactory;

class AuthMiddleware implements MiddlewareInterface
{
    const RESERVED_PARAMS = ['token'];
    /**
     * Process an incoming server request.
     *
     * @param Request $request
     * @param RequestHandler $handler
     * @return Response
     */
    public function process(Request $request, RequestHandler $handler): Response
    {
        $uri = $request->getUri();
        $headers = $request->getHeaders();
        $body = $request->getParsedBody();

        $this->validation($body);
        
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

        // Modifica il body della request per includere il token
        $parsedBody = is_array($body) ? $body : [];
        $parsedBody['token'] = $validationResult['decoded'];
        
        // Crea una nuova request con il body modificato
        $request = $request->withParsedBody($parsedBody);
        
        // Process the request and get response
        $response = $handler->handle($request);

        // Handle preflight OPTIONS requests
        if ($request->getMethod() === 'OPTIONS') {
            return $response->withStatus(200);
        }
        
        // Add authorization header to response
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
        $response = new SlimResponse(401);
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    }

    /**
     * Validates the provided request body.
     *
     * @param array $body The request body to validate.
     * @throws ValidationException If the validation fails.
     */
    private function validation(array $body): void {
        foreach ($body as $key => $value) {
            if (in_array($key, self::RESERVED_PARAMS)) {
                throw new \InvalidArgumentException("The parameter '$key' is reserved and cannot be used.");
            }
        }
    }
}
