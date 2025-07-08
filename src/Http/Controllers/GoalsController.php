<?php

namespace Budgetcontrol\Gateway\Http\Controllers;

use Budgetcontrol\Library\Model\Workspace;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoalsController extends Controller
{

    public function list(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceUuid($request);
        $basePath = $this->routes['goals'];
        $apiResponse = $this->httpClient()->get("$basePath/$wsid");

        return $this->handleApiResponse($apiResponse, 'goals list');
    }

    public function show(Request $request, Response $response, $arg): Response
    {
        $wsid = $this->getWorkspaceUuid($request);
        $basePath = $this->routes['goals'];
        $uuid = $arg['uuid'] ?? null;
        $apiResponse = $this->httpClient()->get("$basePath/$wsid/$uuid");

        return $this->handleApiResponse($apiResponse, 'goals show');
    }

    public function create(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceUuid($request);
        $basePath = $this->routes['goals'];
        $apiResponse = $this->httpClient()->post("$basePath/$wsid", $request->getParsedBody());

        return $this->handleApiResponse($apiResponse, 'goals create');
    }

    public function update(Request $request, Response $response, $arg): Response
    {
        $wsid = $this->getWorkspaceUuid($request);
        $basePath = $this->routes['goals'];
        $uuid = $arg['uuid'] ?? null;
        $apiResponse = $this->httpClient()->put("$basePath/$wsid/$uuid", $request->getParsedBody());

        return $this->handleApiResponse($apiResponse, 'goals update');
    }

    public function delete(Request $request, Response $response, $arg): Response
    {
        $wsid = $this->getWorkspaceUuid($request);
        $basePath = $this->routes['goals'];
        $uuid = $arg['uuid'] ?? null;
        $apiResponse = $this->httpClient()->delete("$basePath/$wsid/$uuid");

        return $this->handleApiResponse($apiResponse, 'goals delete');
    }

    public function updateStatus(Request $request, Response $response, $arg): Response
    {
        $wsid = $this->getWorkspaceUuid($request);
        $basePath = $this->routes['goals'];
        $uuid = $arg['uuid'] ?? null;
        $apiResponse = $this->httpClient()->patch("$basePath/$wsid/$uuid/status", $request->getParsedBody());

        return $this->handleApiResponse($apiResponse, 'goals updateStatus');
    }
}