<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\EntryController;
use App\Entities\QueryString;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class SavingController extends EntryController {

    protected string $entryType = "/saving";

    public function listAll(Request $request, $goalUuid): Response
    {
        //get workspace uuid form headers
        $body = $request->all();

        $queryString = new QueryString();
        $this->getQueryParams($request, $queryString);
        $httpBuildQuery = $queryString->__toString();

        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['entry'];

        $response = Http::get("$basePath/$wsid/$goalUuid".$this->entryType.$httpBuildQuery);
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

}