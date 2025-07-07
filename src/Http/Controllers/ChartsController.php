<?php
namespace Budgetcontrol\Gateway\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Budgetcontrol\Gateway\Traits\BuildQuery;
use Illuminate\Support\Facades\Log;

class ChartsController extends StatsController {

    use BuildQuery;

    public function incomingExpensesLineByDate(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->getParsedBody();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];

        $httpBuildQuery = $this->queryParams($request);
        
        $response = $this->httpClient()->get("$basePath/$wsid/chart/line/incoming-expenses".$httpBuildQuery);
        $data = $response->json();
        
        if(json_encode($data) === null) {
            Log::error('Error: on incoming expenses line by date', ['response' => $response->json()]);
            return response(["message" => "An error occurred"], $response->status(), ['Content-Type' => 'application/json']);
        }
        // Process the response
        if ($response->successful()) {
            $statusCode = $response->status();
        } else {
            // Handle the error
            $statusCode = $response->status();
            // Handle the error based on the status code
        }

        return response($data, $statusCode, ['Content-Type' => 'application/json']);
    }

    public function expensesCategoryBarByDate(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->getParsedBody();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = $this->httpClient()->get("$basePath/$wsid/chart/bar/expenses/category?".$request->getQueryParams());
        $data = $response->json();
        
        if(json_encode($data) === null) {
            Log::error('Error: on expenses category bar by date', ['response' => $response->json()]);
            return response(["message" => "An error occurred"], $response->status(), ['Content-Type' => 'application/json']);
        }
        // Process the response
        if ($response->successful()) {
            $statusCode = $response->status();
        } else {
            // Handle the error
            $statusCode = $response->status();
            // Handle the error based on the status code
        }

        return response($data, $statusCode, ['Content-Type' => 'application/json']);
    }

    public function expensesCategoryTableByDate(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->getParsedBody();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = $this->httpClient()->get("$basePath/$wsid/chart/table/expenses/category?".$request->getQueryParams());
        $data = $response->json();
        
        if(json_encode($data) === null) {
            Log::error('Error: on expenses category table by date', ['response' => $response->json()]);
            return response(["message" => "An error occurred"], $response->status(), ['Content-Type' => 'application/json']);
        }
        // Process the response
        if ($response->successful()) {
            $statusCode = $response->status();
        } else {
            // Handle the error
            $statusCode = $response->status();
            // Handle the error based on the status code
        }

        return response($data, $statusCode, ['Content-Type' => 'application/json']);
    }

    public function expensesLabelBarByDate(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->getParsedBody();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = $this->httpClient()->get("$basePath/$wsid/chart/bar/expenses/label?".$request->getQueryParams());
        $data = $response->json();
        
        if(json_encode($data) === null) {
            Log::error('Error: on expenses label bar by date', ['response' => $response->json()]);
            return response(["message" => "An error occurred"], $response->status(), ['Content-Type' => 'application/json']);
        }
        // Process the response
        if ($response->successful()) {
            $statusCode = $response->status();
        } else {
            // Handle the error
            $statusCode = $response->status();
            // Handle the error based on the status code
        }

        return response($data, $statusCode, ['Content-Type' => 'application/json']);
    }

    public function incomingCategoryBarByDate(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->getParsedBody();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = $this->httpClient()->get("$basePath/$wsid/chart/bar/incoming/category?".$request->getQueryParams());
        $data = $response->json();
        
        if(json_encode($data) === null) {
            Log::error('Error: on incoming category bar by date', ['response' => $response->json()]);
            return response(["message" => "An error occurred"], $response->status(), ['Content-Type' => 'application/json']);
        }
        // Process the response
        if ($response->successful()) {
            $statusCode = $response->status();
        } else {
            // Handle the error
            $statusCode = $response->status();
            // Handle the error based on the status code
        }

        return response($data, $statusCode, ['Content-Type' => 'application/json']);
    }

    public function incomingCategoryTableByDate(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->getParsedBody();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = $this->httpClient()->get("$basePath/$wsid/chart/table/incoming/category?".$request->getQueryParams());
        $data = $response->json();
        
        if(json_encode($data) === null) {
            Log::error('Error: on incoming category table by date', ['response' => $response->json()]);
            return response(["message" => "An error occurred"], $response->status(), ['Content-Type' => 'application/json']);
        }
        // Process the response
        if ($response->successful()) {
            $statusCode = $response->status();
        } else {
            // Handle the error
            $statusCode = $response->status();
            // Handle the error based on the status code
        }

        return response($data, $statusCode, ['Content-Type' => 'application/json']);
    }

    public function expensesLabelApplePieByDate(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->getParsedBody();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = $this->httpClient()->get("$basePath/$wsid/chart/apple-pie/expenses/label?".$request->getQueryParams());
        $data = $response->json();
        
        if(json_encode($data) === null) {
            Log::error('Error: on expenses label apple pie by date', ['response' => $response->json()]);
            return response(["message" => "An error occurred"], $response->status(), ['Content-Type' => 'application/json']);
        }
        // Process the response
        if ($response->successful()) {
            $statusCode = $response->status();
        } else {
            // Handle the error
            $statusCode = $response->status();
            // Handle the error based on the status code
        }

        return response($data, $statusCode, ['Content-Type' => 'application/json']);
    }
}