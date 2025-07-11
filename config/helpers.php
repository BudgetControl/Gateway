<?php
/**
 * This file is a helper file that contains various functions.
 */

if(!function_exists('config')) {
    function confing(string $key, string $value): string {
        return $_ENV[$key] ?? $value;
    }
}

if(!function_exists('response')) {
    function response(array $dataResponse, int $statusCode = 200, array $headers=[]): \Psr\Http\Message\ResponseInterface {
        $response = new \Slim\Psr7\Response();

        $jsonData = json_encode($dataResponse);
        if ($jsonData === false) {
            $errorResponse = new \Slim\Psr7\Response();
            $errorResponse->getBody()->write('Errore nella codifica JSON dei dati');
            return $errorResponse->withStatus(500);
        }
        
        $response->getBody()->write($jsonData);

        foreach ($headers as $key => $value) {
            $response = $response->withHeader($key, $value);
        }
        
        return $response->withHeader('Content-Type', 'application/json')->withStatus($statusCode);
    }
}

/**
 * Checks if the function 'cacheKey_refreshToken' exists.
 * If it does not exist, it can be defined to avoid redeclaration errors.
 */
if(!function_exists('cacheKey_refreshToken')) {
    function cacheKey_refreshToken(string $username): string {
        return md5($username.'refresh_token');
    }
}

if(!function_exists('cache_tags_mapping')) {
    function cache_tags_mapping(): array {
        return [
                'budget' => ['stats', 'entry'],
                'entry' => ['stats', 'budget', 'wallet', 'find'],
                'wallet' => ['stats'],
                'label' => ['entry','stats'],
                'goals' => ['stats'],
                'debt' => ['stats', 'entry', 'wallet'],
                'payees' => ['stats', 'entry', 'debt', 'wallet'],
                'workspace' => [],
                'find' => [],
                'stats' => ['budget', 'entry', 'wallet', 'label', 'goals', 'debt', 'workspace'],
                'all' => ['stats', 'budget', 'entry', 'wallet', 'label', 'goals', 'debt', 'workspace', 'find'],
                'auth' => ['stats', 'workspace', 'find'],
            ];
    }
}
