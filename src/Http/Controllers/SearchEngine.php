<?php

namespace Budgetcontrol\Gateway\Http\Controllers;

use Budgetcontrol\Gateway\Traits\BuildQuery;
use Budgetcontrol\Library\Model\Workspace;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SearchEngine extends Controller
{
    use BuildQuery;

    public function find(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['searchengine'];
        $body = $request->getParsedBody();
        $queryParams = $this->queryParams($request);

        $apiResponse = $this->httpClient()->post("$basePath/find/$wsid", $body, $queryParams);

        return $this->handleApiResponse($apiResponse, 'search engine find', $response);
    }
}
