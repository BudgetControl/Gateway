<?php

namespace Budgetcontrol\Gateway\Http\Middleware;

use Budgetcontrol\Gateway\Traits\Cache;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Illuminate\Support\Facades\Log;
use Slim\Psr7\Response as SlimResponse;
use Throwable;

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
        
        // Se non c'è un workspace ID valido, procedi senza cache
        if ($key === null) {
            Log::warning('No valid workspace ID found, proceeding without cache');
            return $handler->handle($request);
        }
        
        $segments = explode('/', trim($request->getUri()->getPath(), '/'));
        $resource = $segments[1]; // es. 'budget', 'entry', ecc.

        // Mappa delle dipendenze tra risorse
        $dependencies = cache_tags_mapping();

        $cacheTags = [];
        // Invalida anche le cache correlate
        if (isset($dependencies[$resource])) {
            foreach ($dependencies[$resource] as $dependent) {
                $cacheTags[] = $dependent;
            }
        }
        $response = $handler->handle($request);

        if($response->getStatusCode() >= 400) {
            return $response;
        }

        try {

            $wsHeaders = $request->getHeader('X-WS');
            $wsUuid = !empty($wsHeaders) ? $wsHeaders[0] : uniqid('ws_');
            $cacheTags = array_merge($cacheTags, [$resource, $wsUuid]);

            $this->initCache($key, $cacheTags ?? ['default']);

            if ($this->hasCache()) {
                Log::debug('From cache: ' . $this->getCacheKey());
                return $this->createCacheResponse($this->getCache());
            }


            if ($this->isSuccessfulResponse($response)) {
                $responseBody = (string)$response->getBody();

                $this->setCache($responseBody, $this->ttl);
            }
        } catch (Throwable $e) {
            Log::warning("Something went wrong on saving cache " . $e->getMessage());
        }

        return $response;
    }

    /**
     * Generate a unique cache key based on the given request.
     *
     * @param Request $request The HTTP request object.
     * @return string|null The generated cache key or null if workspace is missing.
     */
    private function key(Request $request): ?string
    {
        $wsHeaders = $request->getHeader('X-WS');
        
        // Se non c'è workspace ID, restituisci null per non usare la cache
        if (empty($wsHeaders)) {
            Log::warning('X-WS header not found, skipping cache');
            return null;
        }
        
        $wsUuid = $wsHeaders[0];
        $uri = $request->getUri();
        $fullUrl = $uri->__toString();
        $bodyParams = $request->getParsedBody() ?? [];
        $enviroment = env('APP_ENV', 'production');

        return md5($fullUrl . json_encode($bodyParams) . $wsUuid . $enviroment);
    }

    private function needToInvalidateCache(Request $request, RequestHandler $handler): void
    {
        $method = $request->getMethod();

        // Processa prima la richiesta
        $response = $handler->handle($request);

        // Verifica se è un'operazione di scrittura e se è stata completata con successo
        if (in_array($method, ['POST', 'PUT', 'DELETE', 'PATCH']) && $response->getStatusCode() < 400) {
            // Ottieni il percorso per determinare quali chiavi di cache invalidare
            $path = $request->getUri()->getPath();

            Log::info('Invalidazione cache per ' . $path . ' dopo richiesta ' . $method);

            // Invalida la cache in base al percorso
            $this->invalidateCacheForPath($path);
        }
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

    /**
     * Invalida le chiavi di cache in base al percorso della richiesta
     * 
     * @param string $path
     */
    protected function invalidateCacheForPath(string $path): void
    {
        // Estrai la risorsa dal percorso
        $segments = explode('/', trim($path, '/'));

        if (count($segments) > 1 && $segments[0] === 'api') {
            $resource = $segments[1]; // es. 'budget', 'entry', ecc.

            // Mappa delle dipendenze tra risorse
            $dependencies = [
                'budget' => ['stats', 'entry'],
                'entry' => ['stats', 'budget', 'wallet'],
                'wallet' => ['stats'],
                'label' => ['entry'],
                'goals' => ['stats'],
                'debt' => ['stats', 'entry'],
                'workspace' => ['budget', 'entry', 'stats']
            ];

            // Invalida la cache per la risorsa principale
            $this->clearCacheByTag($resource);

            // Invalida anche le cache correlate
            if (isset($dependencies[$resource])) {
                foreach ($dependencies[$resource] as $dependent) {
                    $this->clearCacheByTag($dependent);
                }
            }
        }
    }

    /**
     * Elimina la cache per un tag specifico
     * 
     * @param string $tag
     */
    protected function clearCacheByTag(string $tag): void
    {
        try {
            Cache::tags([$tag])->flush();
            Log::info("Cache con tag '{$tag}' invalidata con successo");
        } catch (\Exception $e) {
            Log::error("Errore durante l'invalidazione della cache: " . $e->getMessage());
        }
    }
}
