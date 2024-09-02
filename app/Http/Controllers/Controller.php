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

    protected function getQueryParams(Request $request): string
    {
        $queryParams = $request->query();
        unset($queryParams['token']);
        return "?".http_build_query($queryParams);
    }
}
