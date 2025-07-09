<?php
namespace Budgetcontrol\Gateway\Http\Controllers;

use Budgetcontrol\Gateway\Traits\BuildQuery;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class StatsController extends Controller {

    use BuildQuery;
    
    public function incoming(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceUuid($request);
        $basePath = $this->routes['stats'];
        $apiResponse = $this->httpClient()->get("$basePath/$wsid/incoming", $this->queryParams($request));
        
        return $this->handleApiResponse($apiResponse, 'incoming');
    }

    public function expenses(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceUuid($request);
        $basePath = $this->routes['stats'];
        $apiResponse = $this->httpClient()->get("$basePath/$wsid/expenses", $this->queryParams($request));
        
        return $this->handleApiResponse($apiResponse, 'expenses');
    }

    public function debits(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceUuid($request);
        $basePath = $this->routes['stats'];
        $apiResponse = $this->httpClient()->get("$basePath/$wsid/debits", $this->queryParams($request));
        
        return $this->handleApiResponse($apiResponse, 'debits');
    }

    public function debitsTotalNegative(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceUuid($request);
        $basePath = $this->routes['stats'];
        $apiResponse = $this->httpClient()->get("$basePath/$wsid/debits/total-negative", $this->queryParams($request));

        return $this->handleApiResponse($apiResponse, 'debits total negative');
    }

    public function debitsTotalPositive(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceUuid($request);
        $basePath = $this->routes['stats'];
        $apiResponse = $this->httpClient()->get("$basePath/$wsid/debits/total-positive", $this->queryParams($request));

        return $this->handleApiResponse($apiResponse, 'debits total positive');
    }

    public function total(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceUuid($request);
        $basePath = $this->routes['stats'];
        $apiResponse = $this->httpClient()->get("$basePath/$wsid/total", $this->queryParams($request));

        return $this->handleApiResponse($apiResponse, 'total');
    }

    public function wallets(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceUuid($request);
        $basePath = $this->routes['stats'];
        $apiResponse = $this->httpClient()->get("$basePath/$wsid/wallets", $this->queryParams($request));

        return $this->handleApiResponse($apiResponse, 'wallets');
    }

    public function health(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceUuid($request);
        $basePath = $this->routes['stats'];
        $apiResponse = $this->httpClient()->get("$basePath/$wsid/health", $this->queryParams($request));

        return $this->handleApiResponse($apiResponse, 'health');
    }

    public function totalPlanned(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceUuid($request);
        $basePath = $this->routes['stats'];
        $apiResponse = $this->httpClient()->get("$basePath/$wsid/planned", $this->queryParams($request));

        return $this->handleApiResponse($apiResponse, 'total planned');
    }

    public function entries(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceUuid($request);
        $basePath = $this->routes['stats'];
        $apiResponse = $this->httpClient()->post("$basePath/$wsid/stats/entries", $request->getParsedBody());
        
        return $this->handleApiResponse($apiResponse, 'stats entries');
    }
}