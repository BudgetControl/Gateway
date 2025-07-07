<?php
namespace Budgetcontrol\Gateway\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class StatsController extends Controller {

    protected function getWorkspaceId(Request $request): string
    {
        $body = $request->getParsedBody();
        return $body['token']['current_ws'];
    }


    public function incoming(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['stats'];
        $apiResponse = $this->httpClient()->get("$basePath/$wsid/incoming?".$request->getQueryParams());
        
        return $this->handleApiResponse($apiResponse, 'incoming');
    }

    public function expenses(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['stats'];
        $apiResponse = $this->httpClient()->get("$basePath/$wsid/expenses?".$request->getQueryParams());
        
        return $this->handleApiResponse($apiResponse, 'expenses');
    }

    public function debits(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['stats'];
        $apiResponse = $this->httpClient()->get("$basePath/$wsid/debits?".$request->getQueryParams());
        
        return $this->handleApiResponse($apiResponse, 'debits');
    }

    public function debitsTotalNegative(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['stats'];
        $apiResponse = $this->httpClient()->get("$basePath/$wsid/debits/total-negative");
        
        return $this->handleApiResponse($apiResponse, 'debits total negative');
    }

    public function debitsTotalPositive(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['stats'];
        $apiResponse = $this->httpClient()->get("$basePath/$wsid/debits/total-positive");
        
        return $this->handleApiResponse($apiResponse, 'debits total positive');
    }

    public function total(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['stats'];
        $apiResponse = $this->httpClient()->get("$basePath/$wsid/total?".$request->getQueryParams());
        
        return $this->handleApiResponse($apiResponse, 'total');
    }

    public function wallets(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['stats'];
        $apiResponse = $this->httpClient()->get("$basePath/$wsid/wallets");
        
        return $this->handleApiResponse($apiResponse, 'wallets');
    }

    public function health(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['stats'];
        $apiResponse = $this->httpClient()->get("$basePath/$wsid/health");
        
        return $this->handleApiResponse($apiResponse, 'health');
    }

    public function totalPlanned(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['stats'];
        $apiResponse = $this->httpClient()->get("$basePath/$wsid/planned?".$request->getQueryParams());
        
        return $this->handleApiResponse($apiResponse, 'total planned');
    }

    public function entries(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['stats'];
        $apiResponse = $this->httpClient()->post("$basePath/$wsid/stats/entries", $request->getParsedBody());
        
        return $this->handleApiResponse($apiResponse, 'stats entries');
    }
}