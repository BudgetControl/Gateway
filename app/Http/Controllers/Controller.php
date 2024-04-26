<?php

namespace App\Http\Controllers;

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
        $path = 'http://budgetcontrol-core/' . request()->path() . (request()->getQueryString() ? '?' . request()->getQueryString() : '?');
        $method = request()->method();

        //mapping the path
        if(strpos($path, '/auth') !== false) {
            $path = str_replace('/api', '', $path);
        }

        $client = new Request();
        $client->headers->set('Authorization', $request->getHeader('Authorization'));
        $client->headers->set('X-Bc-Token', $request->getHeader('X-Bc-Token'));

        switch ($method) {
            case 'GET':
                $response = $client->get($path);
                break;
            case 'POST':
                $response = $client->post($path, $request->all());
                break;
            case 'PUT':
                $response = $client->put($path, $request->all());
                break;
            case 'DELETE':
                $response = $client->delete($path);
                break;
            default:
                return response()->json(['message' => 'Method not allowed'], 405);
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

        return response()->json($response->getBody()->getContents(), $response->getStatusCode());
    }
}
