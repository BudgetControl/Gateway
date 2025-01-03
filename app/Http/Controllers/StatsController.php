<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class StatsController extends Controller {

    public function incoming(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->all();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = Http::get("$basePath/$wsid/incoming?".$request->getQueryString());
        $data = $response->json();
        
        if(json_encode($data) === null) {
            Log::error('Error: on incoming', ['response' => $response->json()]);
            return response(["An error occurred"], $response->status(), ['Content-Type' => 'application/json']);
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
        $body = $request->all();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = Http::get("$basePath/$wsid/expenses?".$request->getQueryString());
        $data = $response->json();
        
        if(json_encode($data) === null) {
            Log::error('Error: on expenses', ['response' => $response->json()]);
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

    public function debits(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->all();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = Http::get("$basePath/$wsid/debits?".$request->getQueryString());
        $data = $response->json();
        
        if(json_encode($data) === null) {
            Log::error('Error: on debits', ['response' => $response->json()]);
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

    public function total(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->all();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = Http::get("$basePath/$wsid/total?".$request->getQueryString());
        $data = $response->json();
        
        if(json_encode($data) === null) {
            Log::error('Error: on total', ['response' => $response->json()]);
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

    public function wallets(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->all();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = Http::get("$basePath/$wsid/wallets");
        $data = $response->json();
        
        if(json_encode($data) === null) {
            Log::error('Error: on wallets', ['response' => $response->json()]);
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

    public function health(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->all();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = Http::get("$basePath/$wsid/health");
        $data = $response->json();
        
        if(json_encode($data) === null) {
            Log::error('Error: on health', ['response' => $response->json()]);
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

    public function totalPlanned(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->all();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = Http::get("$basePath/$wsid/planned?".$request->getQueryString());
        $data = $response->json();
        
        if(json_encode($data) === null) {
            Log::error('Error: on total planned', ['response' => $response->json()]);
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

    public function entries(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->all();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = Http::post("$basePath/$wsid/stats/entries", $request->all());
        $data = $response->json();
        
        if(json_encode($data) === null) {
            Log::error('Error: on stats entries', ['response' => $response->json()]);
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