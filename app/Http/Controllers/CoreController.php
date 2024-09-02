<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CoreController extends EntryController {

    public function paymentTypes(Request $request): Response
    {
        //get workspace uuid form headers
        $basePath = $this->routes['core'];

        $response = Http::get("$basePath/payment-types");
        $data = $response->json();

        if (json_encode($data) === null) {
            Log::error('Error: on getting payment types', ['response' => $response->json()]);
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

    public function currencies(Request $request): Response
    {
        //get workspace uuid form headers
        $basePath = $this->routes['core'];

        $response = Http::get("$basePath/currencies");
        $data = $response->json();

        if (json_encode($data) === null) {
            Log::error('Error: on getting currencies', ['response' => $response->json()]);
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

    public function categories(Request $request): Response
    {
        //get workspace uuid form headers
        $basePath = $this->routes['core'];

        $response = Http::get("$basePath/categories");
        $data = $response->json();

        if (json_encode($data) === null) {
            Log::error('Error: on getting categories', ['response' => $response->json()]);
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

    public function categoriesSubcategories(Request $request): Response
    {
        //get workspace uuid form headers
        $basePath = $this->routes['core'];

        $response = Http::get("$basePath/categories-subcategories");
        $data = $response->json();

        if (json_encode($data) === null) {
            Log::error('Error: on getting categories and sub categories', ['response' => $response->json()]);
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