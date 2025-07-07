<?php
namespace Budgetcontrol\Gateway\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class StatsController extends Controller {

    public function incoming(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->getParsedBody();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = $this->httpClient()->get("$basePath/$wsid/incoming?".$request->getQueryParams());
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
        $body = $request->getParsedBody();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = $this->httpClient()->get("$basePath/$wsid/expenses?".$request->getQueryParams());
        $data = $response->json();
        
        if(json_encode($data) === null) {
            Log::error('Error: on expenses', ['response' => $response->json()]);
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

    public function debits(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->getParsedBody();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = $this->httpClient()->get("$basePath/$wsid/debits?".$request->getQueryParams());
        $data = $response->json();
        
        if(json_encode($data) === null) {
            Log::error('Error: on debits', ['response' => $response->json()]);
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

    public function debitsTotalNegative(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->getParsedBody();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = $this->httpClient()->get("$basePath/$wsid/debits/total-negative");
        $data = $response->json();
        
        if(json_encode($data) === null) {
            Log::error('Error: on debits total negative', ['response' => $response->json()]);
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

    public function debitsTotalPositive(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->getParsedBody();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = $this->httpClient()->get("$basePath/$wsid/debits/total-positive");
        $data = $response->json();
        
        if(json_encode($data) === null) {
            Log::error('Error: on debits total positive', ['response' => $response->json()]);
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

    public function total(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->getParsedBody();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = $this->httpClient()->get("$basePath/$wsid/total?".$request->getQueryParams());
        $data = $response->json();
        
        if(json_encode($data) === null) {
            Log::error('Error: on total', ['response' => $response->json()]);
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

    public function wallets(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->getParsedBody();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = $this->httpClient()->get("$basePath/$wsid/wallets");
        $data = $response->json();
        
        if(json_encode($data) === null) {
            Log::error('Error: on wallets', ['response' => $response->json()]);
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

    public function health(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->getParsedBody();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = $this->httpClient()->get("$basePath/$wsid/health");
        $data = $response->json();
        
        if(json_encode($data) === null) {
            Log::error('Error: on health', ['response' => $response->json()]);
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

    public function totalPlanned(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->getParsedBody();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = $this->httpClient()->get("$basePath/$wsid/planned?".$request->getQueryParams());
        $data = $response->json();
        
        if(json_encode($data) === null) {
            Log::error('Error: on total planned', ['response' => $response->json()]);
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

    public function entries(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->getParsedBody();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = $this->httpClient()->post("$basePath/$wsid/stats/entries", $request->getParsedBody());
        $data = $response->json();
        
        if(json_encode($data) === null) {
            Log::error('Error: on stats entries', ['response' => $response->json()]);
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