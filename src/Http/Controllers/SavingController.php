<?php
declare(strict_types=1);

namespace Budgetcontrol\Gateway\Http\Controllers;

use Budgetcontrol\Gateway\Http\Controllers\EntryController;
use Budgetcontrol\Library\Model\Workspace;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Support\Facades\Log;
use Budgetcontrol\Gateway\Entities\QueryString;

class SavingController extends EntryController {

    protected string $entryType = "/saving";

    public function listAll(Request $request, $goalUuid): Response
    {
        //get workspace uuid form headers
        $body = $request->getParsedBody();

        $queryString = new QueryString();
        $this->getQueryParams($request, $queryString);
        $httpBuildQuery = $queryString->__toString();

        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['entry'];

        $response = $this->httpClient()->get("$basePath/$wsid/$goalUuid".$this->entryType.$httpBuildQuery);
        $data = $response->json();

        if (json_encode($data) === null) {
            Log::error('Error: on entry list', ['response' => $response->json()]);
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