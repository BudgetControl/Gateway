<?php
namespace Budgetcontrol\Gateway\Http\Controllers;

use Budgetcontrol\Library\Model\Workspace;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Support\Facades\Log;

class WalletController extends Controller {


    public function list(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['wallet'];
        $queryParams = $request->getQueryParams();
        $apiResponse = $this->httpClient()->get("$basePath/$wsid/list?".http_build_query($queryParams));
        
        return $this->handleApiResponse($apiResponse, 'list');
    }

    public function show(Request $request, Response $response, $arg): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['wallet'];
        $uuid = $arg['uuid'];
        $apiResponse = $this->httpClient()->get("$basePath/$wsid/show/$uuid");
        
        return $this->handleApiResponse($apiResponse, 'show');
    }

    public function create(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['wallet'];
        $body = $request->getParsedBody();
        $apiResponse = $this->httpClient()->post("$basePath/$wsid/create", $body);
        
        return $this->handleApiResponse($apiResponse, 'create');
    }

    public function update(Request $request, Response $response, $arg): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['wallet'];
        $uuid = $arg['uuid'];
        $body = $request->getParsedBody();
        $apiResponse = $this->httpClient()->put("$basePath/$wsid/update/$uuid", $body);
        
        return $this->handleApiResponse($apiResponse, 'update');
    }

    public function delete(Request $request, Response $response, $arg): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['wallet'];
        $uuid = $arg['uuid'];
        $apiResponse = $this->httpClient()->delete("$basePath/$wsid/$uuid");
        
        return $this->handleApiResponse($apiResponse, 'delete');
    }

    public function restore(Request $request, Response $response, $arg): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['wallet'];
        $uuid = $arg['uuid'];
        $body = $request->getParsedBody();
        $apiResponse = $this->httpClient()->patch("$basePath/$wsid/restore/$uuid", $body);
        
        return $this->handleApiResponse($apiResponse, 'restore');
    }

    public function sorting(Request $request, Response $response, $arg): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['wallet'];
        $uuid = $arg['uuid'];
        $body = $request->getParsedBody();
        $apiResponse = $this->httpClient()->patch("$basePath/$wsid/sorting/$uuid", $body);
        
        return $this->handleApiResponse($apiResponse, 'sorting');
    }

    public function archive(Request $request, Response $response, $arg): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['wallet'];
        $uuid = $arg['uuid'];
        $body = $request->getParsedBody();
        $apiResponse = $this->httpClient()->patch("$basePath/$wsid/archive/$uuid", $body);
        
        return $this->handleApiResponse($apiResponse, 'archive');
    }

    public function balance(Request $request, Response $response, $arg): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['wallet'];
        $uuid = $arg['uuid'];
        $body = $request->getParsedBody();
        $apiResponse = $this->httpClient()->patch("$basePath/$wsid/balance/$uuid", $body);
        
        return $this->handleApiResponse($apiResponse, 'balance');
    }
}