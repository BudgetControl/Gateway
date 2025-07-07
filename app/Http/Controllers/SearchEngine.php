<?php

namespace App\Http\Controllers;

use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SearchEngine extends Controller
{

    public function find(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->all();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['searchengine'];
        $response = $this->httpClient()->post("$basePath/find/$wsid", $body);
        $data = $response->json();

        if (json_encode($data) === null) {
            Log::error('Error: on search enging find method', ['response' => $response->json()]);
            return response("An error occurred", $response->status(), ['Content-Type' => 'application/json']);
        }
        // Process the response
        if ($response->successful()) {
            $statusCode = $response->status();
        } else {
            // Handle the error
            $statusCode = $response->status();
            Log::error('Error: on search enging find method', ['response' => $response->json()]);
            return response("Ops an error occurred", $statusCode, ['Content-Type' => 'application/json']);
        }

        return response($data, $statusCode, ['Content-Type' => 'application/json']);
    }

}
