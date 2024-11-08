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
            return response(['message' => 'Something went wrong '. $e->getCode()], 500);
        }
        
        return response([], 200, ['Content-Type' => 'application/json']);
    }

    protected function getQueryParams(Request $request): string
    {
        $queryParams = $request->query();
        unset($queryParams['token']);
        return "?".http_build_query($queryParams);
    }

    /**
     * Checks if the user agent in the request matches the specified user agent name.
     *
     * @param Request $request The HTTP request object.
     * @param string $userAgentName The name of the user agent to check against.
     * @return bool Returns true if the user agent matches, false otherwise.
     */
    private function checkUserAgent(Request $request, string $userAgentName): bool
    {
        $userAgent = $request->getHeader('User-Agent');
        \Illuminate\Support\Facades\Log::debug('User agent: ' . $userAgent[0]);

        switch ($userAgentName) {
            case 'android':
                return strpos($userAgent[0], 'Android') !== false;
            case 'ios':
                return strpos($userAgent[0], 'iPhone') !== false || strpos($userAgent[0], 'iPad') !== false;
            default:
                return false;
        }
    }

    /**
     * Checks if a specific header exists in the given request.
     *
     * @param Request $request The HTTP request object.
     * @param string $headerName The name of the header to check for.
     * @return bool Returns true if the header exists, false otherwise.
     */
    protected function existHeader(Request $request, string $headerName): bool 
    {
        return $request->getHeader($headerName) !== null;
    }

    /**
     * Checks if the request is coming from an Android device.
     *
     * @param Request $request The HTTP request object.
     * @return bool Returns true if the request is from an Android device, false otherwise.
     */
    protected function isAndroid(Request $request): bool
    {
        return $this->checkUserAgent($request, 'android');
    }
    
    /**
     * Checks if the request is coming from an iOS device.
     *
     * @param Request $request The HTTP request object.
     * @return bool Returns true if the request is from an iOS device, false otherwise.
     */
    protected function isIos(Request $request): bool
    {
        return $this->checkUserAgent($request, 'ios');
    }
}
