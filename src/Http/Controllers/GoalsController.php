<?php

namespace Budgetcontrol\Gateway\Http\Controllers;

use Budgetcontrol\Library\Model\Workspace;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoalsController extends Controller
{
    private function getWorkspaceId(array $token): int
    {
        return Workspace::where('uuid', $token['current_ws'])->first()->id;
    }

    public function list(Request $request, Response $response): Response
    {
        $body = $request->getParsedBody();
        $wsid = $this->getWorkspaceId($body['token']);
        $basePath = $this->routes['goals'];
        $apiResponse = $this->httpClient()->get("$basePath/$wsid");

        return $this->handleApiResponse($apiResponse, 'goals list');
    }

    public function show(Request $request, Response $response, $uuid): Response
    {
        $body = $request->getParsedBody();
        $wsid = $this->getWorkspaceId($body['token']);
        $basePath = $this->routes['goals'];
        $apiResponse = $this->httpClient()->get("$basePath/$wsid/$uuid");

        return $this->handleApiResponse($apiResponse, 'goals show');
    }

    public function create(Request $request, Response $response): Response
    {
        $body = $request->getParsedBody();
        $wsid = $this->getWorkspaceId($body['token']);
        $basePath = $this->routes['goals'];
        $apiResponse = $this->httpClient()->post("$basePath/$wsid", $body);

        return $this->handleApiResponse($apiResponse, 'goals create');
    }

    public function update(Request $request, Response $response, $uuid): Response
    {
        $body = $request->getParsedBody();
        $wsid = $this->getWorkspaceId($body['token']);
        $basePath = $this->routes['goals'];
        $apiResponse = $this->httpClient()->put("$basePath/$wsid/$uuid", $body);

        return $this->handleApiResponse($apiResponse, 'goals update');
    }

    public function delete(Request $request, Response $response, $uuid): Response
    {
        $body = $request->getParsedBody();
        $wsid = $this->getWorkspaceId($body['token']);
        $basePath = $this->routes['goals'];
        $apiResponse = $this->httpClient()->delete("$basePath/$wsid/$uuid");

        return $this->handleApiResponse($apiResponse, 'goals delete');
    }

    public function updateStatus(Request $request, Response $response, $uuid): Response
    {
        $body = $request->getParsedBody();
        $wsid = $this->getWorkspaceId($body['token']);
        $basePath = $this->routes['goals'];
        $apiResponse = $this->httpClient()->patch("$basePath/$wsid/$uuid/status", $body);

        return $this->handleApiResponse($apiResponse, 'goals updateStatus');
    }
}