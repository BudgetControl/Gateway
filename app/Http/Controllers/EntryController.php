<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EntryController extends Controller {

    protected string $entryType = "";

    public function list(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->all();
        $queryParams = $this->getQueryParams($request);

        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['entry'];

        $response = Http::get("$basePath/$wsid".$this->entryType.$queryParams);
        $data = $response->json();

        if (json_encode($data) === null) {
            Log::error('Error: on entry list', ['response' => $response->json()]);
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

    public function show(Request $request, $uuid): Response
    {
        //get workspace uuid form headers
        $body = $request->all();
        $queryParams = $this->getQueryParams($request);

        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['entry'];
        $response = Http::get("$basePath/$wsid".$this->entryType."/$uuid".$queryParams);
        $data = $response->json();

        if (json_encode($data) === null) {
            Log::error('Error: on entry show', ['response' => $response->json()]);
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

    public function create(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->all();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['entry'];
        $response = Http::post("$basePath/$wsid".$this->entryType,$body);
        $data = $response->json();

        if (json_encode($data) === null) {
            Log::error('Error: on entry create', ['response' => $response->json()]);
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

    public function update(Request $request, $uuid): Response
    {
        //get workspace uuid form headers
        $body = $request->all();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['entry'];
        $response = Http::put("$basePath/$wsid".$this->entryType."/$uuid",$body);
        $data = $response->json();

        if (json_encode($data) === null) {
            Log::error('Error: on entry update', ['response' => $response->json()]);
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

    public function delete(Request $request, $uuid): Response
    {
        //get workspace uuid form headers
        $body = $request->all();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['entry'];
        $response = Http::delete("$basePath/$wsid".$this->entryType."/$uuid");
        $data = $response->json();

        if (json_encode($data) === null) {
            Log::error('Error: on entry delete', ['response' => $response->json()]);
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