<?php

namespace Budgetcontrol\Gateway\Http\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;

class ResponseMiddleware implements MiddlewareInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Process an incoming server request.
     *
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // Log request details
        $this->logger->debug('Headers: ' . json_encode($request->getHeaders()));
        $body = $request->getParsedBody();
        $this->logger->debug('Body: ' . json_encode($body));
        
        // Process the request
        $response = $handler->handle($request);

        // Retrieve the new access token from the request attributes
        $newAccessToken = $request->getAttribute('new_access_token');

        // Add the new access token to the response headers
        if ($newAccessToken) {
            $response = $response->withHeader('Authorization', 'Bearer ' . $newAccessToken);
        }

        $this->logger->debug('Response: ' . json_encode([
            'status' => $response->getStatusCode(),
            'headers' => $response->getHeaders()
        ]));


        return $response;
    }
}
