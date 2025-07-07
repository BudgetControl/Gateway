<?php
namespace Budgetcontrol\Gateway\Http\Controllers;

use App\Service\JwtService;
use Illuminate\Support\Facades\Http;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Support\Facades\Log;

class WorkspaceController extends Controller
{
    private function getUserId(Request $request): int
    {
        return $this->userId($request->getAttribute('token')['uuid']);
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

    public function update(Request $request, Response $response, $id): Response
    {
        $userId = $this->getUserId($request);
        $basePath = $this->routes['workspace'];
        $body = $request->getParsedBody();
        $apiResponse = $this->httpClient()->put("$basePath/$userId/update/$id", $body);
        
        return $this->handleApiResponse($apiResponse, 'update');
    }

    public function show(Request $request, Response $response, $id): Response
    {
        $userId = $this->getUserId($request);
        $basePath = $this->routes['workspace'];
        $apiResponse = $this->httpClient()->get("$basePath/$userId/$id");
        
        return $this->handleApiResponse($apiResponse, 'show');
    }

    public function activate(Request $request, Response $response, $id): Response
    {
        $userId = $this->getUserId($request);
        $basePath = $this->routes['workspace'];
        $apiResponse = $this->httpClient()->patch("$basePath/$userId/$id/activate");
        
        return $this->handleApiResponse($apiResponse, 'activate');
    }

    public function delete(Request $request, Response $response, $id): Response
    {
        $userId = $this->getUserId($request);
        $basePath = $this->routes['workspace'];
        $apiResponse = $this->httpClient()->delete("$basePath/$id/delete");
        
        return $this->handleApiResponse($apiResponse, 'delete');
    }
}