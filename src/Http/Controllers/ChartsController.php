<?php

namespace Budgetcontrol\Gateway\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Budgetcontrol\Gateway\Traits\BuildQuery;
use Illuminate\Support\Facades\Log;

class ChartsController extends StatsController
{
    use BuildQuery;

    private function buildResponse(Response $response, $apiResponse, string $logContext): Response
    {
        return $this->handleApiResponse($apiResponse, $logContext);
    }

    public function incomingExpensesLineByDate(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceUuid($request);
        $basePath = $this->routes['stats'];
        $query = $this->queryParams($request);

        $apiResponse = $this->httpClient()->get("$basePath/$wsid/chart/line/incoming-expenses", $query);

        return $this->handleApiResponse($apiResponse, 'incoming expenses line by date', $response);
    }

    public function expensesCategoryBarByDate(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceUuid($request);
        $basePath = $this->routes['stats'];
        $query = $this->queryParams($request);

        $apiResponse = $this->httpClient()->get("$basePath/$wsid/chart/bar/expenses/category", $query);

        return $this->handleApiResponse($apiResponse, 'expenses category bar by date', $response);
    }

    public function expensesCategoryTableByDate(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceUuid($request);
        $basePath = $this->routes['stats'];
        $query = $this->queryParams($request);

        $apiResponse = $this->httpClient()->get("$basePath/$wsid/chart/table/expenses/category", $query);

        return $this->buildResponse($response, $apiResponse, 'expenses category table by date');
    }

    public function expensesLabelBarByDate(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceUuid($request);
        $basePath = $this->routes['stats'];
        $query = $this->queryParams($request);

        $apiResponse = $this->httpClient()->get("$basePath/$wsid/chart/bar/expenses/label", $query);

        return $this->buildResponse($response, $apiResponse, 'expenses label bar by date');
    }

    public function incomingCategoryBarByDate(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceUuid($request);
        $basePath = $this->routes['stats'];
        $query = $this->queryParams($request);

        $apiResponse = $this->httpClient()->get("$basePath/$wsid/chart/bar/incoming/category", $query);

        return $this->buildResponse($response, $apiResponse, 'incoming category bar by date');
    }

    public function incomingCategoryTableByDate(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceUuid($request);
        $basePath = $this->routes['stats'];
        $query = $this->queryParams($request);

        $apiResponse = $this->httpClient()->get("$basePath/$wsid/chart/table/incoming/category", $query);

        return $this->buildResponse($response, $apiResponse, 'incoming category table by date');
    }

    public function expensesLabelApplePieByDate(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceUuid($request);
        $basePath = $this->routes['stats'];
        $query = $this->queryParams($request);

        $apiResponse = $this->httpClient()->get("$basePath/$wsid/chart/apple-pie/expenses/label", $query);

        return $this->buildResponse($response, $apiResponse, 'expenses label apple pie by date');
    }
}
