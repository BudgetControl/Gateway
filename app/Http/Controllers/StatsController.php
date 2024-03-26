<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class StatsController extends Controller {

    public function incoming(Request $request): Response
    {
        //get workspace uuid form headers
        $wsid = $request->header('X-BC-WS');
        $basePath = $this->routes['stats'];
        $response = Http::get("$basePath/$wsid/incoming?".$request->getQueryString());
        $data = $response->json();
        
        if(json_encode($data) === null) {
            return response(["An error occurred"], 500, ['Content-Type' => 'application/json']);
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

    public function expenses(Request $request): Response
    {
        //get workspace uuid form headers
        $wsid = $request->header('X-BC-WS');
        $basePath = $this->routes['stats'];
        $response = Http::get("$basePath/$wsid/expenses?".$request->getQueryString());
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

    public function total(Request $request): Response
    {
        //get workspace uuid form headers
        $wsid = $request->header('X-BC-WS');
        $basePath = $this->routes['stats'];
        $response = Http::get("$basePath/$wsid/total?".$request->getQueryString());
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

    public function wallets(Request $request): Response
    {
        //get workspace uuid form headers
        $wsid = $request->header('X-BC-WS');
        $basePath = $this->routes['stats'];
        $response = Http::get("$basePath/$wsid/wallets");
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

    public function health(Request $request): Response
    {
        //get workspace uuid form headers
        $wsid = $request->header('X-BC-WS');
        $basePath = $this->routes['stats'];
        $response = Http::get("$basePath/$wsid/health");
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

    public function totalPlanned(Request $request): R
    {
        //get workspace uuid form headers
        $wsid = $request->header('X-BC-WS');
        $basePath = $this->routes['stats'];
        $response = Http::get("$basePath/$wsid/total-planned?".$request->getQueryString());
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