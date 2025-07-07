<?php
declare(strict_types=1);

namespace Budgetcontrol\Gateway\Service;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Illuminate\Support\Facades\Log;

class ClientService
{
    private Client $httpClient;

    public function __construct()
    {   
        $secret = env('API_SECRET', 'default-secret');
        $this->httpClient = new Client([
            'base_uri' => env('API_BASE_URL', 'http://localhost:8000'),
            'headers' => [
                'X-API-SECRET' => $secret,
                'X-LOG-LEVEL' => env('LOG_LEVEL', 'info'),
                'Content-Type' => 'application/json',
                'User-Agent' => 'BudgetControl-Gateway/1.0'
            ]
        ]);
    }

    public function post(string $uri, array $data): ResponseInterface
    {
        return $this->invoke($uri, 'POST', [
            'json' => $data
        ]);
    }

    public function get(string $uri, array $queryParams = []): ResponseInterface
    {
        return $this->invoke($uri, 'GET', [
            'query' => $queryParams
        ]);
    }

    public function delete(string $uri): ResponseInterface
    {
        return $this->invoke($uri, 'DELETE');
    }

    public function put(string $uri, array $data): ResponseInterface
    {
        return $this->invoke($uri, 'PUT', [
            'json' => $data
        ]);
    }

    public function patch(string $uri, array $data): ResponseInterface
    {
        return $this->invoke($uri, 'PATCH', [
            'json' => $data
        ]);
    }

    public function withToken(string $token): ClientService
    {
        $this->httpClient = new Client(array_merge($this->httpClient->getConfig(), [
            'headers' => array_merge($this->httpClient->getConfig('headers'), [
                'Authorization' => 'Bearer ' . $token
            ])
        ]));
        return $this;
    }

    public function withHeader(string $key, string $value): ClientService
    {
        $this->httpClient = new Client(array_merge($this->httpClient->getConfig(), [
            'headers' => array_merge($this->httpClient->getConfig('headers'), [
                $key => $value
            ])
        ]));
        return $this;
    }

    private function invoke(string $uri, string $method, array $options = []): ResponseInterface
    {
        if(env('LOG_LEVEL', 'info') === 'debug') {
            Log::debug("Invoking $method request to $uri with options: " . json_encode($options));
            Log::debug("Headers: " . json_encode($this->httpClient->getConfig('headers')));
            Log::debug("Base URI: " . $this->httpClient->getConfig('base_uri'));
        }

        return $this->httpClient->request($method, $uri, $options);
    }


}