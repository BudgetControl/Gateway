<?php

namespace App\Http\Controllers;

use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoalsController extends Controller
{

    public function list(Request $request): Response
    {
        $body = $request->all();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['goals'];
        $response = Http::get("$basePath/$wsid");
        $data = $response->json();

        if ($response->successful()) {
            return response($data, $response->status(), ['Content-Type' => 'application/json']);
        } else {
            Log::error('Error: on goals list', ['response' => $response->json()]);
            return response("An error occurred", $response->status(), ['Content-Type' => 'application/json']);
        }
    }

    public function show(Request $request, $uuid): Response
    {
        $body = $request->all();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['goals'];
        $response = Http::get("$basePath/$wsid/$uuid");
        $data = $response->json();

        if ($response->successful()) {
            return response($data, $response->status(), ['Content-Type' => 'application/json']);
        } else {
            Log::error('Error: on goals show', ['response' => $response->json()]);
            return response("An error occurred", $response->status(), ['Content-Type' => 'application/json']);
        }
    }

    public function create(Request $request): Response
    {
        $body = $request->all();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['goals'];
        $response = Http::post("$basePath/$wsid", $body);
        $data = $response->json();

        if ($response->successful()) {
            return response($data, $response->status(), ['Content-Type' => 'application/json']);
        } else {
            Log::error('Error: on goals create', ['response' => $response->json()]);
            return response("An error occurred", $response->status(), ['Content-Type' => 'application/json']);
        }
    }

    public function update(Request $request, $uuid): Response
    {
        $body = $request->all();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['goals'];
        $response = Http::put("$basePath/$wsid/$uuid", $body);
        $data = $response->json();

        if ($response->successful()) {
            return response($data, $response->status(), ['Content-Type' => 'application/json']);
        } else {
            Log::error('Error: on goals update', ['response' => $response->json()]);
            return response("An error occurred", $response->status(), ['Content-Type' => 'application/json']);
        }
    }

    public function delete(Request $request, $uuid): Response
    {
        $body = $request->all();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['goals'];
        $response = Http::delete("$basePath/$wsid/$uuid");
        $data = $response->json();

        if ($response->successful()) {
            return response($data, $response->status(), ['Content-Type' => 'application/json']);
        } else {
            Log::error('Error: on goals delete', ['response' => $response->json()]);
            return response("An error occurred", $response->status(), ['Content-Type' => 'application/json']);
        }
    }


}