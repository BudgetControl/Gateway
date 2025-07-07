<?php

namespace Budgetcontrol\Gateway\Http\Middleware;

use Budgetcontrol\Gateway\Traits\Cache;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Illuminate\Support\Facades\Log;
use Slim\Psr7\Response as SlimResponse;

class CachingMiddleware implements MiddlewareInterface
{
    use Cache;

    private int $ttl;

    public function __construct(?int $ttl = null)
    {
        $this->ttl = $ttl ?? (int)($_ENV['CACHE_TTL'] ?? 3600); // Default to 1 hour if not set
    }
    
    /**
     * Process an incoming server request and return a response.
     *
     * @param Request $request
     * @param RequestHandler $handler
     * @return Response
     */
    public function process(Request $request, RequestHandler $handler): Response
    {
        $key = $this->key($request);
        $this->initCache($key);
        
        if ($this->hasCache()) {
            Log::debug('From cache: ' . $this->getCacheKey());
            return $this->createCacheResponse($this->getCache());
        }

        $response = $handler->handle($request);

        if ($this->isSuccessfulResponse($response)) {
            $responseBody = (string)$response->getBody();
            $this->setCache($responseBody, $this->ttl);
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
        $uri = $request->getUri();
        $fullUrl = $uri->__toString();
        $bodyParams = $request->getParsedBody() ?? [];
        
        $wsHeaders = $request->getHeader('X-WS');
        $wsUuid = !empty($wsHeaders) ? $wsHeaders[0] : '';

        return md5($fullUrl . json_encode($bodyParams) . $wsUuid);
    }

    /**
     * Create a PSR-7 response for cached content.
     */
    private function createCacheResponse(string $content): Response
    {
        $response = new SlimResponse();
        $response->getBody()->write($content);
        return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
    }

    /**
     * Check if the response is successful (2xx status code).
     */
    private function isSuccessfulResponse(Response $response): bool
    {
        $statusCode = $response->getStatusCode();
        return $statusCode >= 200 && $statusCode < 300;
    }
}
