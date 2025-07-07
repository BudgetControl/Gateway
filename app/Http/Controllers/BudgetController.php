<?php

namespace App\Http\Controllers;

use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BudgetController extends Controller
{

    public function list(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->all();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['budget'];
        $response = $this->httpClient()->get("$basePath/$wsid");
        $data = $response->json();

        // Process the response
        if ($response->successful()) {
            $statusCode = $response->status();
        } else {
            // Handle the error
            Log::error('Error: on budget list', ['response' => $response->json()]);
            return response("An error occurred", $response->status(), ['Content-Type' => 'application/json']);
        }

        return response($data, $statusCode, ['Content-Type' => 'application/json']);
    }

    public function show(Request $request, $uuid): Response
    {
        $body = $request->all();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['budget'];
        $response = $this->httpClient()->get("$basePath/$wsid/$uuid");
        $data = $response->json();

        // Process the response
        if ($response->successful()) {
            $statusCode = $response->status();
        } else {
            // Handle the error
            Log::error('Error: on budget show', ['response' => $response->json()]);
            return response("An error occurred", $response->status(), ['Content-Type' => 'application/json']);
        }

        return response($data, $statusCode, ['Content-Type' => 'application/json']);
    }

    public function create(Request $request): Response
    {
        $body = $request->all();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['budget'];
        $response = $this->httpClient()->post("$basePath/$wsid/budget", $body);
        $data = $response->json();

        // Process the response
        if ($response->successful()) {
            $statusCode = $response->status();
        } else {
            // Handle the error
            Log::error('Error: on budget create', ['response' => $response->json()]);
            return response("An error occurred", $response->status(), ['Content-Type' => 'application/json']);
        }

        return response($data, $statusCode, ['Content-Type' => 'application/json']);
    }

    public function update(Request $request, $uuid): Response
    {
        $body = $request->all();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['budget'];
        $response = $this->httpClient()->put("$basePath/$wsid/budget/$uuid", $body);
        $data = $response->json();
           
        // Process the response
        if ($response->successful()) {
            $statusCode = $response->status();
        } else {
            // Handle the error
            Log::error('Error: on budget update', ['response' => $response->json()]);
            return response("An error occurred", $response->status(), ['Content-Type' => 'application/json']);
        }

        return response($data, $statusCode, ['Content-Type' => 'application/json']);
    }

    public function delete(Request $request, $uuid): Response
    {
        $body = $request->all();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['budget'];
        $response = $this->httpClient()->delete("$basePath/$wsid/budget/$uuid");
        $data = $response->json();

        // Process the response
        if ($response->successful()) {
            $statusCode = $response->status();
        } else {
            // Handle the error
            Log::error('Error: on budget delete', ['response' => $response->json()]);
            return response("An error occurred", $response->status(), ['Content-Type' => 'application/json']);
        }

        return response($data, $statusCode, ['Content-Type' => 'application/json']);
    }

    public function expired(Request $request, $uuid): Response
    {
        $body = $request->all();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['budget'];
        $response = $this->httpClient()->get("$basePath/$wsid/budget/$uuid/expired");
        $data = $response->json();

        // Process the response
        if ($response->successful()) {
            $statusCode = $response->status();
        } else {
            // Handle the error
            Log::error('Error: on budget expired', ['response' => $response->json()]);
            return response("An error occurred", $response->status(), ['Content-Type' => 'application/json']);
        }

        return response($data, $statusCode, ['Content-Type' => 'application/json']);
    }

    public function exceeded(Request $request, $uuid): Response
    {
        $body = $request->all();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['budget'];
        $response = $this->httpClient()->get("$basePath/$wsid/budget/$uuid/exceeded");
        $data = $response->json();

        // Process the response
        if ($response->successful()) {
            $statusCode = $response->status();
        } else {
            // Handle the error
            Log::error('Error: on budget expired', ['response' => $response->json()]);
            return response("An error occurred", $response->status(), ['Content-Type' => 'application/json']);
        }

        return response($data, $statusCode, ['Content-Type' => 'application/json']);
    }

    public function status(Request $request, $uuid): Response
    {
        $body = $request->all();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['budget'];
        $response = $this->httpClient()->get("$basePath/$wsid/budget/$uuid/status");
        $data = $response->json();

        // Process the response
        if ($response->successful()) {
            $statusCode = $response->status();
        } else {
            // Handle the error
            Log::error('Error: on budget status', ['response' => $response->json()]);
            return response("An error occurred", $response->status(), ['Content-Type' => 'application/json']);
        }

        return response($data, $statusCode, ['Content-Type' => 'application/json']);
    }

    public function budgetStats(Request $request, $uuid): Response
    {
        $body = $request->all();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['budget'];
        $response = $this->httpClient()->get("$basePath/$wsid/budget/$uuid/stats");
        $data = $response->json();

        // Process the response
        if ($response->successful()) {
            $statusCode = $response->status();
        } else {
            // Handle the error
            Log::error('Error: on budget stats', ['response' => $response->json()]);
            return response("An error occurred", $response->status(), ['Content-Type' => 'application/json']);
        }

        return response($data, $statusCode, ['Content-Type' => 'application/json']);
    }

    public function budgetsStats(Request $request): Response
    {
        $body = $request->all();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['budget'];
        $response = $this->httpClient()->get("$basePath/$wsid/budgets/stats");
        $data = $response->json();

        // Process the response
        if ($response->successful()) {
            $statusCode = $response->status();
        } else {
            // Handle the error
            Log::error('Error: on budget stats', ['response' => $response->json()]);
            return response("An error occurred", $response->status(), ['Content-Type' => 'application/json']);
        }

        return response($data, $statusCode, ['Content-Type' => 'application/json']);
    }

    public function entryList(Request $request, $uuid): Response
    {
        $body = $request->all();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['budget'];
        $response = $this->httpClient()->get("$basePath/$wsid/budget/$uuid/entry-list");
        $data = $response->json();

        // Process the response
        if ($response->successful()) {
            $statusCode = $response->status();
        } else {
            // Handle the error
            Log::error('Error: on budgets entry-list', ['response' => $response->json()]);
            return response("An error occurred", $response->status(), ['Content-Type' => 'application/json']);
        }

        return response($data, $statusCode, ['Content-Type' => 'application/json']);
    }
}
