<?php
namespace Budgetcontrol\Gateway\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Support\Facades\Log;

class WorkspaceController extends Controller
{
    private function getUserId(Request $request): int
    {   
        $body = $request->getParsedBody();
        $userUUID = $body['token']['uuid'];

        if (empty($userUUID)) {
            Log::error('User UUID is empty in request body', ['request' => $request]);
            throw new \InvalidArgumentException('User UUID is required');
        }

        return $this->userId($userUUID);
    }


    public function list(Request $request, Response $response): Response
    {
        $userId = $this->getUserId($request);
        $basePath = $this->routes['workspace'];
        $apiResponse = $this->httpClient()->get("$basePath/$userId/list");
        
        return $this->handleApiResponse($apiResponse, 'list');
    }

    public function listByUser(Request $request, Response $response): Response
    {
        $userId = $this->getUserId($request);
        $basePath = $this->routes['workspace'];
        $apiResponse = $this->httpClient()->get("$basePath/$userId/by-user/list");
        
        return $this->handleApiResponse($apiResponse, 'list by user');
    }

    public function last(Request $request, Response $response): Response
    {
        $userId = $this->getUserId($request);
        $basePath = $this->routes['workspace'];
        $apiResponse = $this->httpClient()->get("$basePath/$userId/last");
        
        return $this->handleApiResponse($apiResponse, 'last');
    }

    public function create(Request $request, Response $response): Response
    {
        $userId = $this->getUserId($request);
        $basePath = $this->routes['workspace'];
        $body = $request->getParsedBody();
        $apiResponse = $this->httpClient()->post("$basePath/$userId/add", $body);
        
        return $this->handleApiResponse($apiResponse, 'create');
    }

    public function update(Request $request, Response $response, $arg): Response
    {
        $userId = $this->getUserId($request);
        $basePath = $this->routes['workspace'];
        $body = $request->getParsedBody();
        $id = $arg['id'] ?? null;
        $apiResponse = $this->httpClient()->put("$basePath/$userId/update/$id", $body);
        
        return $this->handleApiResponse($apiResponse, 'update');
    }

    public function show(Request $request, Response $response, $arg): Response
    {
        $userId = $this->getUserId($request);
        $basePath = $this->routes['workspace'];
        $id = $arg['id'] ?? null;
        $apiResponse = $this->httpClient()->get("$basePath/$userId/$id");
        
        return $this->handleApiResponse($apiResponse, 'show');
    }

    public function activate(Request $request, Response $response, $arg): Response
    {
        $userId = $this->getUserId($request);
        $basePath = $this->routes['workspace'];
        $id = $arg['id'] ?? null;
        $apiResponse = $this->httpClient()->patch("$basePath/$userId/$id/activate", $request->getParsedBody());
        
        return $this->handleApiResponse($apiResponse, 'activate');
    }

    public function delete(Request $request, Response $response, $arg): Response
    {
        $userId = $this->getUserId($request);
        $basePath = $this->routes['workspace'];
        $id = $arg['id'] ?? null;
        $apiResponse = $this->httpClient()->delete("$basePath/$userId/$id/delete");
        
        return $this->handleApiResponse($apiResponse, 'delete');
    }
}