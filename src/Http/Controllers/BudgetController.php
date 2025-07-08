<?php

namespace Budgetcontrol\Gateway\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Support\Facades\Log;
use Budgetcontrol\Library\Model\Workspace;

class BudgetController extends Controller
{

    public function list(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $apiResponse = $this->httpClient()->get("{$this->routes['budget']}/$wsid");

        return $this->handleApiResponse($apiResponse, 'budget list');
    }

    public function show(Request $request, Response $response, $arg): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $uuid = $arg['uuid'];
        $apiResponse = $this->httpClient()->get("{$this->routes['budget']}/$wsid/$uuid");

        return $this->handleApiResponse($apiResponse, 'budget show');
    }

    public function create(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $apiResponse = $this->httpClient()->post("{$this->routes['budget']}/$wsid/budget", $request->getParsedBody());

        return $this->handleApiResponse($apiResponse, 'budget create');
    }

    public function update(Request $request, Response $response, $arg): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $uuid = $arg['uuid'];
        $apiResponse = $this->httpClient()->put("{$this->routes['budget']}/$wsid/budget/$uuid", $request->getParsedBody());

        return $this->handleApiResponse($apiResponse, 'budget update');
    }

    public function delete(Request $request, Response $response, $arg): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $uuid = $arg['uuid'];
        $apiResponse = $this->httpClient()->delete("{$this->routes['budget']}/$wsid/budget/$uuid");

        return $this->handleApiResponse($apiResponse, 'budget delete');
    }

    public function expired(Request $request, Response $response, $arg): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $uuid = $arg['uuid'];
        $apiResponse = $this->httpClient()->get("{$this->routes['budget']}/$wsid/budget/$uuid/expired");

        return $this->handleApiResponse($apiResponse, 'budget expired');
    }

    public function exceeded(Request $request, Response $response, $arg): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $uuid = $arg['uuid'];
        $apiResponse = $this->httpClient()->get("{$this->routes['budget']}/$wsid/budget/$uuid/exceeded");

        return $this->handleApiResponse($apiResponse, 'budget exceeded');
    }

    public function status(Request $request, Response $response, $arg): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $uuid = $arg['uuid'];
        $apiResponse = $this->httpClient()->get("{$this->routes['budget']}/$wsid/budget/$uuid/status");

        return $this->handleApiResponse($apiResponse, 'budget status');
    }

    public function budgetStats(Request $request, Response $response, $arg): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $uuid = $arg['uuid'];
        $apiResponse = $this->httpClient()->get("{$this->routes['budget']}/$wsid/budget/$uuid/stats");

        return $this->handleApiResponse($apiResponse, 'budget stats');
    }

    public function budgetsStats(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $apiResponse = $this->httpClient()->get("{$this->routes['budget']}/$wsid/budgets/stats");

        return $this->handleApiResponse($apiResponse, 'budget budgetsStats');
    }

    public function entryList(Request $request, Response $response, $arg): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $uuid = $arg['uuid'];
        $apiResponse = $this->httpClient()->get("{$this->routes['budget']}/$wsid/budget/$uuid/entry-list");

        return $this->handleApiResponse($apiResponse, 'budget entryList');
    }
}
