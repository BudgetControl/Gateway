<?php

namespace Budgetcontrol\Gateway\Http\Controllers;

use Budgetcontrol\Library\Model\Workspace;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SearchEngine extends Controller
{
    private function getWorkspaceId(Request $request): int
    {
        $body = $request->getParsedBody();
        return Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
    }

    public function find(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['searchengine'];
        $body = $request->getParsedBody();
        $apiResponse = $this->httpClient()->post("$basePath/find/$wsid", $body);
        
        return $this->handleApiResponse($apiResponse, 'search engine find', $response);
    }
}
