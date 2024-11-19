<?php

namespace App\Http\Controllers;

use Closure;
use App\Entities\QueryString;
use App\Models\User;
use GuzzleHttp\Client;
use App\Entities\Param;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Budgetcontrol\Library\Model\Model;

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

    /**
     * Retrieves query parameters from the given request or array and updates the provided QueryString object.
     *
     * @param Request|array $request The request object or array containing query parameters.
     * @param QueryString $queryString The QueryString object to be updated with the query parameters.
     * @param string|null $index Optional index to specify a particular subset of query parameters.
     *
     * @return void
     */
    protected function getQueryParams(Request $request, QueryString &$queryString, string $index = null): void
    {
        $queryParams = is_array($request) ? $request : $request->query();
        $queryParams = $queryString->removeParamsByConfig($queryParams);

        foreach($queryParams as $key => $value) {
            if(is_null($value)) {
                Log::debug('Removed keyValue: ' . $key . ' value: ' . $value);
            }

            if(!is_null($value)) {
                $queryString->setParam($key, $value, null, $index);
            }
        }
        
    }

    /**
     * Retrieve the ID of a specific model based on its UUID.
     *
     * @param string $uuid The UUID of the model.
     * @param Model $model The model instance to search within.
     * @return int The ID of the model.
     */
    protected function getIdOfSpecificModel(string $uuid, Model $model): int
    {

        $record = $model->where('uuid', $uuid)->first();
        
        if ($record) {
            return $record->id;
        }
    
        Log::error('Error: ID not found for given UUID in any model', ['uuid' => $uuid]);
        throw new InvalidArgumentException('Invalid UUID: Resource not found');
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
        $userAgent = $request->header('User-Agent');
        \Illuminate\Support\Facades\Log::debug('User agent: ' . $userAgent);

        switch ($userAgentName) {
            case 'android':
                return strpos($userAgent, 'Android') !== false;
            case 'ios':
                return strpos($userAgent, 'iPhone') !== false || strpos($userAgent[0], 'iPad') !== false;
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
