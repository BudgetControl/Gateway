<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LabelController extends Controller {

    public function list(Request $request): Response
    {
        $body = $request->all();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['label'];
        $queryParams = $request->query();
        $response = Http::get("$basePath/$wsid/list?".http_build_query($queryParams));
        $data = $response->json();

        if (json_encode($data) === null) {
            Log::error('Error: on labels list', ['response' => $response->json()]);
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

    public function update(Request $request, string $label_id): Response
    {
        $body = $request->all();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['label'];
        $response = Http::put("$basePath/$wsid/$label_id", $body);
        $data = $response->json();

        if (json_encode($data) === null) {
            Log::error('Error: on labels update', ['response' => $response->json()]);
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

    public function insert(Request $request, string $label_id): Response
    {
        $body = $request->all();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['label'];
        $response = Http::post("$basePath/$wsid/$label_id", $body);
        $data = $response->json();

        if (json_encode($data) === null) {
            Log::error('Error: on labels insert', ['response' => $response->json()]);
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

    public function show(Request $request, string $label_id): Response
    {
        $body = $request->all();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['label'];
        $response = Http::get("$basePath/$wsid/$label_id");
        $data = $response->json();

        if (json_encode($data) === null) {
            Log::error('Error: on labels show', ['response' => $response->json()]);
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

    public function patch(Request $request, string $label_id): Response
    {
        $body = $request->all();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['label'];
        $response = Http::patch("$basePath/$wsid/$label_id", $body);
        $data = $response->json();

        if (json_encode($data) === null) {
            Log::error('Error: on labels patch', ['response' => $response->json()]);
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

    public function delete(Request $request, string $label_id): Response
    {
        $body = $request->all();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['label'];
        $response = Http::delete("$basePath/$wsid/$label_id");
        $data = $response->json();

        if (json_encode($data) === null) {
            Log::error('Error: on labels delete', ['response' => $response->json()]);
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