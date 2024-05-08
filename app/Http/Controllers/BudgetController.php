<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class BudgetController extends Controller {

    public function list(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->all();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['budget'];
        $response = Http::get("$basePath/$wsid");
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

    public function show(Request $request, $uuid): Response
    {
        $body = $request->all();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['budget'];
        $response = Http::get("$basePath/$wsid/$uuid");
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

    public function create(Request $request): Response
    {
        $body = $request->all();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['budget'];
        $response = Http::post("$basePath/$wsid", $body);
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

    public function update(Request $request, $uuid): Response
    {
        $body = $request->all();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['budget'];
        $response = Http::put("$basePath/$wsid/$uuid", $body);
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

    public function delete(Request $request, $uuid): Response
    {
        $body = $request->all();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['budget'];
        $response = Http::delete("$basePath/$wsid/$uuid");
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

    public function expired(Request $request, $uuid): Response
    {
        $body = $request->all();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['budget'];
        $response = Http::get("$basePath/$wsid/$uuid/expired");
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

    public function exceeded(Request $request, $uuid): Response
    {
        $body = $request->all();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['budget'];
        $response = Http::get("$basePath/$wsid/$uuid/exceeded");
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

    public function status(Request $request, $uuid): Response
    {
        $body = $request->all();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['budget'];
        $response = Http::get("$basePath/$wsid/$uuid/status");
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