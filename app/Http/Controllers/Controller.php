<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

abstract class Controller
{
    protected $routes;

    public function __construct()
    {
        $this->routes = config('routes');
    }

    public function getRoutes(Request $request): JsonResponse
    {
        $basePath = $this->routes['core'];
        $path = $basePath. "/" . request()->path() . (request()->getQueryString() ? '?' . request()->getQueryString() : '?');
        $method = request()->method();

        //mapping the path
        if(strpos($path, '/auth') !== false) {
            $path = str_replace('/api', '', $path);
        }

        $xBcToken = $request->header('X-Bc-Token');
        $authorization = $request->header('Authorization');

        $client = new Client();

        try {
            switch ($method) {
                case 'GET':
                    $response = $client->request('GET', $path, [
                        'headers' => [
                            'X-Bc-Token' => $xBcToken,
                            'Authorization' => $authorization
                        ]
                    ]);
                    break;
                case 'POST':
                    $response = $client->request('POST', $path, [
                        'headers' => [
                            'X-Bc-Token' => $xBcToken,
                            'Authorization' => $authorization
                        ],
                        'json' => $request->all()
                        
                    ]);
                    break;
                case 'PUT':
                    $response = $client->request('PUT', $path, [
                        'headers' => [
                            'X-Bc-Token' => $xBcToken,
                            'Authorization' => $authorization
                        ],
                        'json' => $request->all()
                        
                    ]);
                    break;
                case 'DELETE':
                    $response = $client->request('DELETE', $path, [
                        'headers' => [
                            'X-Bc-Token' => $xBcToken,
                            'Authorization' => $authorization
                        ]
                    ]);
                    break;
                default:
                    return response()->json(['message' => 'Method not allowed'], 405);
            }
        } catch (\Exception $e) {
            Log::error('Error while calling the API', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Something went wrong'], $e->getCode());
        }
      
        if ($response->getStatusCode() == 401) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        if($response->getStatusCode() == 404) {
            return response()->json(['message' => 'Not found'], 404);
        }

        if($response->getStatusCode() == 500) {
            Log::error('Internal server error', ['response' => $response]);
            return response()->json(['message' => 'Internal server error'], 500);
        }

        $jsonResponse = json_decode($response->getBody()->getContents(), true);
        return response()->json($jsonResponse, $response->getStatusCode());
    }

    /**
     * Get the user ID based on the provided UUID.
     *
     * @param string $uuid The UUID of the user.
     * @return int The user ID.
     */
    public function userId(string $uuid): int
    {
        return User::where('uuid', $uuid)->first()->id;
    }

    /**
     * Monitor the request and return a response.
     *
     * @param Request $request The incoming request.
     * @return Response The response to the request.
     */
    public function monitor(Request $request, $ms): Response
    {
        $client = new Client();
        $path = $this->routes[$ms];

        try {
            $client->request('GET', $path . "/monitor");
        } catch (\Exception $e) {
            Log::error('Error while calling the API', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Something went wrong'], $e->getCode());
        }
        
        return response([], 200, ['Content-Type' => 'application/json']);
    }
}
