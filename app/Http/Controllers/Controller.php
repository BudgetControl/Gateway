<?php

namespace App\Http\Controllers;

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
        $path .= '&auth=' . $request->header('Authorization');
        $method = request()->method();

        //mapping the path
        if(strpos($path, '/auth') !== false) {
            $path = str_replace('/api', '', $path);
        }

        switch ($method) {
            case 'GET':
                $response = Http::get($path);
                break;
            case 'POST':
                $response = Http::post($path, $request->all());
                break;
            case 'PUT':
                $response = Http::put($path, $request->all());
                break;
            case 'DELETE':
                $response = Http::delete($path);
                break;
            default:
                return response()->json(['message' => 'Method not allowed'], 405);
        }
        
        $data = $response->json();

        if ($response->status() == 401) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        if($response->status() == 404) {
            return response()->json(['message' => 'Not found'], 404);
        }

        if($response->status() == 500) {
            Log::error('Internal server error', ['response' => $response]);
            return response()->json(['message' => 'Internal server error'], 500);
        }

        return response()->json($data);
    }
}
