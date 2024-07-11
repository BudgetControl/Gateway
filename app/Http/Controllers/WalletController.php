<?php
namespace App\Http\Controllers;

use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WalletController extends Controller {

    public function list(Request $request): Response
    {
        $body = $request->all();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['wallet'];
        $response = Http::get("$basePath/$wsid/list");
        $data = $response->json();

        if (json_encode($data) === null) {
            Log::error('Error: on wallet list', ['response' => $response->json()]);
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
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['wallet'];
        $response = Http::get("$basePath/$wsid/show/$uuid");
        $data = $response->json();

        if (json_encode($data) === null) {
            Log::error('Error: on wallet show', ['response' => $response->json()]);
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
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['wallet'];
        $response = Http::get("$basePath/$wsid/create");
        $data = $response->json();

        if (json_encode($data) === null) {
            Log::error('Error: on wallet create', ['response' => $response->json()]);
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
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['wallet'];
        $response = Http::get("$basePath/$wsid/update/$uuid");
        $data = $response->json();

        if (json_encode($data) === null) {
            Log::error('Error: on wallet update', ['response' => $response->json()]);
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
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['wallet'];
        $response = Http::get("$basePath/$wsid/$uuid");
        $data = $response->json();

        if (json_encode($data) === null) {
            Log::error('Error: on wallet update', ['response' => $response->json()]);
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

    public function restore(Request $request, $uuid): Response
    {
        $body = $request->all();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['wallet'];
        $response = Http::get("$basePath/$wsid/restore/$uuid");
        $data = $response->json();

        if (json_encode($data) === null) {
            Log::error('Error: on wallet update', ['response' => $response->json()]);
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

    public function sorting(Request $request, $uuid): Response
    {
        $body = $request->all();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['wallet'];
        $response = Http::get("$basePath/$wsid/sorting/$uuid");
        $data = $response->json();

        if (json_encode($data) === null) {
            Log::error('Error: on wallet update', ['response' => $response->json()]);
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