<?php
namespace Budgetcontrol\Gateway\Http\Controllers;

use App\Service\JwtService;
use Illuminate\Support\Facades\Http;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Support\Facades\Log;

class WorkspaceController extends Controller
{
    public function list(Request $request): Response
    {
        $userId = $this->userId($request->token['uuid']);
        $basePath = $this->routes['workspace'];
        $response = $this->httpClient()->get("$basePath/$userId/list");
        $data = $response->json();
        
        // Process the response
        if ($response->successful()) {
            $statusCode = $response->status();
        } else {
            // Handle the error
            Log::error('Error: on workspace list', ['response' => $response->json()]);
            $statusCode = $response->status();
            // Handle the error based on the status code
        }

        return response($data, $statusCode);
    }

    public function listByUser(Request $request): Response
    {
        $userId = $this->userId($request->token['uuid']);
        $basePath = $this->routes['workspace'];
        $response = $this->httpClient()->get("$basePath/$userId/by-user/list");
        $data = $response->json();
        
        // Process the response
        if ($response->successful()) {
            $statusCode = $response->status();
        } else {
            // Handle the error
            Log::error('Error: on workspace list by user', ['response' => $response->json()]);
            $statusCode = $response->status();
            // Handle the error based on the status code
        }

        return response($data, $statusCode);
    }

    public function last(Request $request): Response
    {
        $userId = $this->userId($request->token['uuid']);
        $basePath = $this->routes['workspace'];
        $response = $this->httpClient()->get("$basePath/$userId/last");
        $data = $response->json();
        
        // Process the response
        if ($response->successful()) {
            $statusCode = $response->status();
        } else {
            // Handle the error
            Log::error('Error: on workspace last', ['response' => $response->json()]);
            $statusCode = $response->status();
            // Handle the error based on the status code
        }

        return response($data, $statusCode);
    }

    public function create(Request $request): Response
    {
        $userId = $this->userId($request->token['uuid']);
        $basePath = $this->routes['workspace'];
        $response = $this->httpClient()->post("$basePath/$userId/add", $request->getParsedBody());
        $data = $response->json();
        
        // Process the response
        if ($response->successful()) {
            $statusCode = $response->status();
        } else {
            // Handle the error
            Log::error('Error: on workspace create', ['response' => $response->json()]);
            $statusCode = $response->status();
            // Handle the error based on the status code
        }

        return response($data, $statusCode);
    }

    public function update(Request $request, $id): Response
    {
        $userId = $this->userId($request->token['uuid']);
        $basePath = $this->routes['workspace'];

        $response = $this->httpClient()->put("$basePath/$userId/update/$id", $request->getParsedBody());
        $data = $response->json();

        // Process the response
        if ($response->successful()) {
            $statusCode = $response->status();
        } else {
            // Handle the error
            Log::error('Error: on workspace update', ['response' => $response->json()]);
            $statusCode = $response->status();
            // Handle the error based on the status code
        }

        return response($data, $statusCode);
    }

    public function show(Request $request, $id): Response
    {
        $userId = $this->userId($request->token['uuid']);
        $basePath = $this->routes['workspace'];
        $response = $this->httpClient()->get("$basePath/$userId/$id");
        $data = $response->json();
        
        // Process the response
        if ($response->successful()) {
            $statusCode = $response->status();
        } else {
            // Handle the error
            Log::error('Error: on workspace show', ['response' => $response->json()]);
            $statusCode = $response->status();
            // Handle the error based on the status code
        }

        // encode response with JWT
        return new Response($data,$statusCode,[
            'Content-Type' => 'application/json',
        ]);
    }

    public function activate(Request $request, $id): Response
    {
        $userId = $this->userId($request->token['uuid']);
        $basePath = $this->routes['workspace'];
        $response = $this->httpClient()->patch("$basePath/$userId/$id/activate");
        $data = $response->json();
        
        // Process the response
        if ($response->successful()) {
            $statusCode = $response->status();
        } else {
            // Handle the error
            Log::error('Error: on workspace activate', ['response' => $response->json()]);
            $statusCode = $response->status();
            // Handle the error based on the status code
        }

        return response($data, $statusCode);
    }

    public function delete(Request $request, $id): Response
    {
        $userId = $this->userId($request->token['uuid']);
        $basePath = $this->routes['workspace'];
        $response = $this->httpClient()->delete("$basePath/$id/delete");
        $data = $response->json();
        
        // Process the response
        if ($response->successful()) {
            $statusCode = $response->status();
        } else {
            // Handle the error
            Log::error('Error: on workspace delete', ['response' => $response->json()]);
            $statusCode = $response->status();
            // Handle the error based on the status code
        }

        return response($data, $statusCode);
    }

    
}
