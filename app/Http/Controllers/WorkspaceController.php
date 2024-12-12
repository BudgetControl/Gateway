<?php
namespace App\Http\Controllers;

use App\Service\JwtService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class WorkspaceController extends Controller
{
    public function list(Request $request): JsonResponse
    {
        $userId = $this->userId($request->token['uuid']);
        $basePath = $this->routes['workspace'];
        $response = Http::get("$basePath/$userId/list");
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

        return response()->json($data, $statusCode);
    }

    public function listByUser(Request $request): JsonResponse
    {
        $userId = $this->userId($request->token['uuid']);
        $basePath = $this->routes['workspace'];
        $response = Http::get("$basePath/$userId/by-user/list");
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

        return response()->json($data, $statusCode);
    }

    public function last(Request $request): JsonResponse
    {
        $userId = $this->userId($request->token['uuid']);
        $basePath = $this->routes['workspace'];
        $response = Http::get("$basePath/$userId/last");
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

        return response()->json($data, $statusCode);
    }

    public function create(Request $request): JsonResponse
    {
        $this->validate($request);
        $userId = $this->userId($request->token['uuid']);
        $basePath = $this->routes['workspace'];
        $response = Http::post("$basePath/$userId/add", $request->all());
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

        return response()->json($data, $statusCode);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $this->validate($request);
        $userId = $this->userId($request->token['uuid']);
        $basePath = $this->routes['workspace'];

        $response = Http::put("$basePath/$userId/update/$id", $request->all());
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

        return response()->json($data, $statusCode);
    }

    public function show(Request $request, $id): Response
    {
        $userId = $this->userId($request->token['uuid']);
        $basePath = $this->routes['workspace'];
        $response = Http::get("$basePath/$userId/$id");
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

    public function activate(Request $request, $id): JsonResponse
    {
        $userId = $this->userId($request->token['uuid']);
        $basePath = $this->routes['workspace'];
        $response = Http::patch("$basePath/$userId/$id/activate");
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

        return response()->json($data, $statusCode);
    }

    public function delete(Request $request, $id): JsonResponse
    {
        $userId = $this->userId($request->token['uuid']);
        $basePath = $this->routes['workspace'];
        $response = Http::delete("$basePath/$id/delete");
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

        return response()->json($data, $statusCode);
    }

    /**
     * validate the request
     * @throws \Illuminate\Validation\ValidationException
     */
    private function validate(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'string',
        ]);
        
    }
    
}
