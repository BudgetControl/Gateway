<?php
namespace Budgetcontrol\Gateway\Http\Controllers;

use Budgetcontrol\Library\Model\Workspace;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Support\Facades\Log;

class DebtController extends Controller {

    public function payeeList(Request $request): Response
    {
        $body = $request->getParsedBody();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['debt'];
        $queryParams = $request->getQueryParams();
        $response = $this->httpClient()->get("$basePath/$wsid/payees?".http_build_query($queryParams));
        $data = $response->json();

        if (json_encode($data) === null) {
            Log::error('Error: on payees list', ['response' => $response->json()]);
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

    public function deleteDebt(Request $request, $uuid): Response
    {
        $body = $request->getParsedBody();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['debt'];
        $response = $this->httpClient()->delete("$basePath/$wsid/debt/$uuid");
        $data = $response->json();

        if (json_encode($data) === null) {
            Log::error('Error: on debt delete', ['response' => $response->json()]);
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

    public function getDebits(Request $request): Response
    {
        $body = $request->getParsedBody();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['debt'];

        $response = $this->httpClient()->get("$basePath/$wsid/debits");
        $data = $response->json();

        if (json_encode($data) === null) {
            Log::error('Error: on debits list', ['response' => $response->json()]);
            return response(["message" => "An error occurred"], $response->status(), ['Content-Type' => 'application/json']);
        }
        // Process the response
        $statusCode = $response->status();

        return response($data, $statusCode, ['Content-Type' => 'application/json']);
    }

}