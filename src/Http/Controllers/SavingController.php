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

    protected function getWorkspaceId(Request $request): int
    {
        $body = $request->getParsedBody();
        return Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
    }

    public function listAll(Request $request, Response $response, $goalUuid): Response
    {
        $queryString = new QueryString();
        $this->getQueryParams($request, $queryString);
        $httpBuildQuery = $queryString->__toString();

        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['entry'];

        $apiResponse = $this->httpClient()->get("$basePath/$wsid/$goalUuid".$this->entryType.$httpBuildQuery);
        
        return $this->handleApiResponse($apiResponse, 'saving list', $response);
    }
}