<?php
namespace Budgetcontrol\Gateway\Http\Controllers;

use Budgetcontrol\Library\Model\Workspace;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WalletController extends Controller {

    public function list(Request $request): Response
    {
        $body = $request->getParsedBody();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['wallet'];
        $queryParams = $request->getQueryParams();
        $response = $this->httpClient()->get("$basePath/$wsid/list?".http_build_query($queryParams));
        $data = $response->json();

        if (json_encode($data) === null) {
            Log::error('Error: on wallet list', ['response' => $response->json()]);
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

    public function show(Request $request, $uuid): Response
    {
        $body = $request->getParsedBody();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['wallet'];
        $response = $this->httpClient()->get("$basePath/$wsid/show/$uuid");
        $data = $response->json();

        if (json_encode($data) === null) {
            Log::error('Error: on wallet show', ['response' => $response->json()]);
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

    public function create(Request $request): Response
    {
        $body = $request->getParsedBody();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['wallet'];
        $response = $this->httpClient()->post("$basePath/$wsid/create", $body);
        $data = $response->json();

        if (json_encode($data) === null) {
            Log::error('Error: on wallet create', ['response' => $response->json()]);
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

    public function update(Request $request, $uuid): Response
    {
        $body = $request->getParsedBody();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['wallet'];
        $response = $this->httpClient()->put("$basePath/$wsid/update/$uuid", $body);
        $data = $response->json();

        if (json_encode($data) === null) {
            Log::error('Error: on wallet update', ['response' => $response->json()]);
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

    public function delete(Request $request, $uuid): Response
    {
        $body = $request->getParsedBody();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['wallet'];
        $response = $this->httpClient()->delete("$basePath/$wsid/$uuid");
        $data = $response->json();

        if (json_encode($data) === null) {
            Log::error('Error: on wallet update', ['response' => $response->json()]);
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

    public function restore(Request $request, $uuid): Response
    {
        $body = $request->getParsedBody();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['wallet'];
        $response = $this->httpClient()->patch("$basePath/$wsid/restore/$uuid", $body);
        $data = $response->json();

        if (json_encode($data) === null) {
            Log::error('Error: on wallet update', ['response' => $response->json()]);
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

    public function sorting(Request $request, $uuid): Response
    {
        $body = $request->getParsedBody();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['wallet'];
        $response = $this->httpClient()->patch("$basePath/$wsid/sorting/$uuid", $body);
        $data = $response->json();

        if (json_encode($data) === null) {
            Log::error('Error: on wallet update', ['response' => $response->json()]);
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
    
    public function archive(Request $request, $uuid): Response
    {
        $body = $request->getParsedBody();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['wallet'];
        $response = $this->httpClient()->patch("$basePath/$wsid/archive/$uuid", $body);
        $data = $response->json();

        if (json_encode($data) === null) {
            Log::error('Error: on wallet archive', ['response' => $response->json()]);
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

    public function balance(Request $request, $uuid): Response
    {
        $body = $request->getParsedBody();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['wallet'];
        $response = $this->httpClient()->patch("$basePath/$wsid/balance/$uuid", $body);
        $data = $response->json();

        if (json_encode($data) === null) {
            Log::error('Error: on wallet balance', ['response' => $response->json()]);
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