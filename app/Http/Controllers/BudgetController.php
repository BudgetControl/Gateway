<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class BudgetController extends Controller {

    public function budgetsList(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->all();
        $wsid = $body['token']['current_ws'];
        $basePath = $this->routes['budgets'];
        $response = Http::get("$basePath/$wsid/list");
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