<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class ChartsController extends Controller {

    public function incomingExpensesLineByDate(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->all();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = Http::get("$basePath/$wsid/chart/line/incoming-expenses?".$request->getQueryString());
        $data = $response->json();
        
        if(json_encode($data) === null) {
            return response("An error occurred", 500, ['Content-Type' => 'application/json']);
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
            return response("An error occurred", 500, ['Content-Type' => 'application/json']);
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
            return response("An error occurred", 500, ['Content-Type' => 'application/json']);
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
            return response("An error occurred", 500, ['Content-Type' => 'application/json']);
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
            return response("An error occurred", 500, ['Content-Type' => 'application/json']);
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
            return response("An error occurred", 500, ['Content-Type' => 'application/json']);
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