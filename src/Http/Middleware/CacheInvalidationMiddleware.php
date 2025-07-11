<?php

namespace Budgetcontrol\Gateway\Http\Middleware;

use Illuminate\Support\Facades\Log;
use Budgetcontrol\Gateway\Traits\Cache;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Throwable;

class CacheInvalidationMiddleware implements MiddlewareInterface
{
    use Cache;

    /**
     * Process an incoming server request.
     *
     * @param Request $request
     * @param RequestHandler $handler
     * @return Response
     */
    public function process(Request $request, RequestHandler $handler): Response
    {

        $method = $request->getMethod();
        
        // Processa prima la richiesta
        $response = $handler->handle($request);
        
        // Verifica se è un'operazione di scrittura e se è stata completata con successo
        if (in_array($method, ['POST', 'PUT', 'DELETE', 'PATCH']) && $response->getStatusCode() < 400) {
            // Ottieni il percorso per determinare quali chiavi di cache invalidare
            $path = $request->getUri()->getPath();
            
            Log::info('Invalidazione cache per ' . $path . ' dopo richiesta ' . $method);
            
            $wsHeaders = $request->getHeader('X-WS');
            $wsUuid = !empty($wsHeaders) ? $wsHeaders[0] : '';
            
            // Invalida la cache in base al percorso
            try {
                $this->invalidateCacheForPath($path, $wsUuid);
            } catch (Throwable $e) {
                Log::warning("Something went wrong on clear cache " . $e->getMessage());
            }
            
        }
        
        return $response;
    }
    
    /**
     * Invalida le chiavi di cache in base al percorso della richiesta
     * 
     * @param string $path
     */
    protected function invalidateCacheForPath(string $path, string $workspaceUuid): void
    {
        // Estrai la risorsa dal percorso
        $segments = explode('/', trim($path, '/'));
        
        if (count($segments) > 1 && $segments[0] === 'api') {
            $resource = $segments[1]; // es. 'budget', 'entry', ecc.
            
            // Mappa delle dipendenze tra risorse
            $dependencies = cache_tags_mapping();
            
            // Invalida anche le cache correlate
            if (isset($dependencies[$resource])) {
                foreach ($dependencies[$resource] as $dependent) {
                    $cacheTags[] = $dependent;
                }
            }

            $this->cacheTags([$workspaceUuid => $cacheTags])->clearCache();
        }
    }
}