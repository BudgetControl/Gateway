<?php

namespace Budgetcontrol\Gateway\Http\Controllers;

use Budgetcontrol\Library\Model\Workspace;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoalsController extends Controller
{

    public function list(Request $request): Response
    {
        $body = $request->getParsedBody();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['goals'];
        $response = $this->httpClient()->get("$basePath/$wsid");
        $data = $response->json();

        if ($response->successful()) {
            return response($data, $response->status(), ['Content-Type' => 'application/json']);
        } else {
            Log::error('Error: on goals list', ['response' => $response->json()]);
            return response(["message" => "An error occurred"], $response->status(), ['Content-Type' => 'application/json']);
        }
    }

    public function show(Request $request, $uuid): Response
    {
        $body = $request->getParsedBody();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['goals'];
        $response = $this->httpClient()->get("$basePath/$wsid/$uuid");
        $data = $response->json();

        if ($response->successful()) {
            return response($data, $response->status(), ['Content-Type' => 'application/json']);
        } else {
            Log::error('Error: on goals show', ['response' => $response->json()]);
            return response(["message" => "An error occurred"], $response->status(), ['Content-Type' => 'application/json']);
        }
    }

    public function create(Request $request): Response
    {
        $body = $request->getParsedBody();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['goals'];
        $response = $this->httpClient()->post("$basePath/$wsid", $body);
        $data = $response->json();

        if ($response->successful()) {
            return response($data, $response->status(), ['Content-Type' => 'application/json']);
        } else {
            Log::error('Error: on goals create', ['response' => $response->json()]);
            return response(["message" => "An error occurred"], $response->status(), ['Content-Type' => 'application/json']);
        }
    }

    public function update(Request $request, $uuid): Response
    {
        $body = $request->getParsedBody();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['goals'];
        $response = $this->httpClient()->put("$basePath/$wsid/$uuid", $body);
        $data = $response->json();

        if ($response->successful()) {
            return response($data, $response->status(), ['Content-Type' => 'application/json']);
        } else {
            Log::error('Error: on goals update', ['response' => $response->json()]);
            return response(["message" => "An error occurred"], $response->status(), ['Content-Type' => 'application/json']);
        }
    }

    public function delete(Request $request, $uuid): Response
    {
        $body = $request->getParsedBody();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['goals'];
        $response = $this->httpClient()->delete("$basePath/$wsid/$uuid");
        $data = $response->json();

        if ($response->successful()) {
            return response($data, $response->status(), ['Content-Type' => 'application/json']);
        } else {
            Log::error('Error: on goals delete', ['response' => $response->json()]);
            return response(["message" => "An error occurred"], $response->status(), ['Content-Type' => 'application/json']);
        }
    }

    public function updateStatus(Request $request, $uuid): Response
    {
        $body = $request->getParsedBody();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['goals'];
        $response = $this->httpClient()->patch("$basePath/$wsid/$uuid/status", $body);
        $data = $response->json();

        if ($response->successful()) {
            return response($data, $response->status(), ['Content-Type' => 'application/json']);
        } else {
            Log::error('Error: on goals updateStatus', ['response' => $response->json()]);
            return response(["message" => "An error occurred"], $response->status(), ['Content-Type' => 'application/json']);
        }
    }


}