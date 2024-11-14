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
     * Retrieve query parameters from the given request.
     *
     * @param Request $request The HTTP request instance.
     * @return QueryString The query parameters as a string.
     */
    protected function getQueryParams(Request $request): QueryString
    {
        $queryParams = $request->query();
        foreach($queryParams as $key => $value) {
            $params[] = new Param($key, $value);
        }

        $queryParams = new QueryString($params);
        return $queryParams;
        
    }

    /**
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
}
