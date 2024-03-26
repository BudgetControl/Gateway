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

        $path = 'http://budgetcontrol-core/' . request()->path() . (request()->getQueryString() ? '?' . request()->getQueryString() : '');

        //mapping the path
        if(strpos($path, '/auth') !== false) {
            $path = str_replace('/api', '', $path);
        }

        $response = \Illuminate\Support\Facades\Http::get($path);
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
