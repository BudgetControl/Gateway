<?php
declare(strict_types=1);

namespace Budgetcontrol\Gateway\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Budgetcontrol\Gateway\Http\Controllers\ChartsController;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class AverangeController extends ChartsController {

    public function averageExpenses(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->getParsedBody();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = $this->httpClient()->get("$basePath/$wsid/average-expenses");
        $data = $response->json();
        
        // Process the response
        if ($response->successful()) {
            $statusCode = $response->status();
        } else {
            // Handle the error
            Log::error('Error: on average-expenses', ['response' => $response->json()]);
            return response(["message" => "An error occurred"], $response->status(), ['Content-Type' => 'application/json']);
        }

        return response($data, $statusCode, ['Content-Type' => 'application/json']);
    }

    public function averageIncoming(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->getParsedBody();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = $this->httpClient()->get("$basePath/$wsid/average-incoming");
        $data = $response->json();
        
        // Process the response
        if ($response->successful()) {
            $statusCode = $response->status();
        } else {
            // Handle the error
            Log::error('Error: on average-incoming', ['response' => $response->json()]);
            return response(["message" => "An error occurred"], $response->status(), ['Content-Type' => 'application/json']);
        }

        return response($data, $statusCode, ['Content-Type' => 'application/json']);
    }

    public function averageSavings(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->getParsedBody();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = $this->httpClient()->get("$basePath/$wsid/average-savings");
        $data = $response->json();
        
        // Process the response
        if ($response->successful()) {
            $statusCode = $response->status();
        } else {
            // Handle the error
            Log::error('Error: on average-savings', ['response' => $response->json()]);
            return response(["message" => "An error occurred"], $response->status(), ['Content-Type' => 'application/json']);
        }

        return response($data, $statusCode, ['Content-Type' => 'application/json']);
    }


    public function totalLoanInstallmentsOfCurrentMonth(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->getParsedBody();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = $this->httpClient()->get("$basePath/$wsid/total-loan-installments");
        $data = $response->json();
        
        // Process the response
        if ($response->successful()) {
            $statusCode = $response->status();
        } else {
            // Handle the error
            Log::error('Error: on total-loan-installments', ['response' => $response->json()]);
            return response(["message" => "An error occurred"], $response->status(), ['Content-Type' => 'application/json']);
        }

        return response($data, $statusCode, ['Content-Type' => 'application/json']);
    }

    public function totalPlannedRemainingOfCurrentMonth(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->getParsedBody();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = $this->httpClient()->get("$basePath/$wsid/total/planned/remaining");
        $data = $response->json();
        
        // Process the response
        if ($response->successful()) {
            $statusCode = $response->status();
        } else {
            // Handle the error
            Log::error('Error: on total/planned/remaining', ['response' => $response->json()]);
            return response(["message" => "An error occurred"], $response->status(), ['Content-Type' => 'application/json']);
        }

        return response($data, $statusCode, ['Content-Type' => 'application/json']);
    }

    public function totalPlannedMonthly(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->getParsedBody();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['stats'];
        $response = $this->httpClient()->get("$basePath/$wsid/total/planned/monthly");
        $data = $response->json();
        
        // Process the response
        if ($response->successful()) {
            $statusCode = $response->status();
        } else {
            // Handle the error
            Log::error('Error: on total/planned/monthly', ['response' => $response->json()]);
            return response(["message" => "An error occurred"], $response->status(), ['Content-Type' => 'application/json']);
        }

        return response($data, $statusCode, ['Content-Type' => 'application/json']);
    }
}