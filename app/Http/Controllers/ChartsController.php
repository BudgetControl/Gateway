<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\QueryString;
use App\Traits\BuildQuery;
use App\Traits\Cache;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class ChartsController extends StatsController {

    use BuildQuery;

    public function incomingExpensesLineByDate(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->all();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];

        $httpBuildQuery = $this->queryParams($request);
        
        $response = Http::get("$basePath/$wsid/chart/line/incoming-expenses".$httpBuildQuery);
        $data = $response->json();
        
        if(json_encode($data) === null) {
            Log::error('Error: on incoming expenses line by date', ['response' => $response->json()]);
            return response("An error occurred", $response->status(), ['Content-Type' => 'application/json']);
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
        $body = $request->all();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = Http::get("$basePath/$wsid/chart/bar/expenses/category?".$request->getQueryString());
        $data = $response->json();
        
        if(json_encode($data) === null) {
            Log::error('Error: on expenses category bar by date', ['response' => $response->json()]);
            return response("An error occurred", $response->status(), ['Content-Type' => 'application/json']);
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
        $body = $request->all();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = Http::get("$basePath/$wsid/chart/table/expenses/category?".$request->getQueryString());
        $data = $response->json();
        
        if(json_encode($data) === null) {
            Log::error('Error: on expenses category table by date', ['response' => $response->json()]);
            return response("An error occurred", $response->status(), ['Content-Type' => 'application/json']);
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
        $body = $request->all();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = Http::get("$basePath/$wsid/chart/bar/expenses/label?".$request->getQueryString());
        $data = $response->json();
        
        if(json_encode($data) === null) {
            Log::error('Error: on expenses label bar by date', ['response' => $response->json()]);
            return response("An error occurred", $response->status(), ['Content-Type' => 'application/json']);
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
        $body = $request->all();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = Http::get("$basePath/$wsid/chart/bar/incoming/category?".$request->getQueryString());
        $data = $response->json();
        
        if(json_encode($data) === null) {
            Log::error('Error: on incoming category bar by date', ['response' => $response->json()]);
            return response("An error occurred", $response->status(), ['Content-Type' => 'application/json']);
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
        $body = $request->all();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = Http::get("$basePath/$wsid/chart/table/incoming/category?".$request->getQueryString());
        $data = $response->json();
        
        if(json_encode($data) === null) {
            Log::error('Error: on incoming category table by date', ['response' => $response->json()]);
            return response("An error occurred", $response->status(), ['Content-Type' => 'application/json']);
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
        $body = $request->all();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = Http::get("$basePath/$wsid/chart/apple-pie/expenses/label?".$request->getQueryString());
        $data = $response->json();
        
        if(json_encode($data) === null) {
            Log::error('Error: on expenses label apple pie by date', ['response' => $response->json()]);
            return response("An error occurred", $response->status(), ['Content-Type' => 'application/json']);
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