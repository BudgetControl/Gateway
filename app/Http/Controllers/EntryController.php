<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Entities\QueryString;
use App\Entities\Param;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class EntryController extends Controller {

    protected string $entryType = "";

    public function list(Request $request): Response
    {
        //get workspace uuid form headers
        $body = $request->all();

        $queryString = new QueryString();
        $this->getQueryParams($request, $queryString);
        $httpBuildQuery = $queryString->__toString();

        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['entry'];

        $response = Http::get("$basePath/$wsid".$this->entryType.$httpBuildQuery);
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

        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['entry'];
        $response = Http::get("$basePath/$wsid".$this->entryType."/$uuid");
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

    /**
     * Retrieve query parameters from the given request.
     *
     * @param Request $request The HTTP request instance.
     * @return QueryString The query parameters as a string.
     */
    protected function getQueryParams(Request|array $request, QueryString &$queryString): QueryString
    {
        $queryParams = is_array($request) ? $request : $request->query();

        foreach ($queryParams as $key => $value) {
            $closure = null;

            if (is_array($value)) {
                $this->getQueryParams($value, $queryString);
            }

            Log::debug('keyValue: ' . $key);

            switch ($key) {
                case 'category_id':
                    $closure = fn($value) => \Budgetcontrol\Library\Model\Category::where('uuid', $value)->first()->id ?? null;
                    break;
                case 'account_id':
                    $closure = fn($value) => \Budgetcontrol\Library\Model\Wallet::where('uuid', $value)->first()->id ?? null;
                    break;
                case 'payee_id':
                    $closure = fn($value) => \Budgetcontrol\Library\Model\Payee::where('uuid', $value)->first()->id ?? null;
                    break;
            }

            $queryString->setParam($key, $value, $closure);

        }

        return $queryString;
    }

}