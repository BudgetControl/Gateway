<?php
namespace Budgetcontrol\Gateway\Http\Controllers;

use Budgetcontrol\Library\Model\Workspace;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Support\Facades\Log;

class DebtController extends Controller {

    private function getWorkspaceId(Request $request): int
    {
        $body = $request->getParsedBody();
        return Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
    }


    public function payeeList(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['debt'];
        $queryParams = $request->getQueryParams();
        $apiResponse = $this->httpClient()->get("$basePath/$wsid/payees?".http_build_query($queryParams));
        
        return $this->handleApiResponse($apiResponse, 'payees list');
    }

    public function deleteDebt(Request $request, Response $response, $uuid): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['debt'];
        $apiResponse = $this->httpClient()->delete("$basePath/$wsid/debt/$uuid");
        
        return $this->handleApiResponse($apiResponse, 'debt delete');
    }

    public function getDebits(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['debt'];
        $apiResponse = $this->httpClient()->get("$basePath/$wsid/debits");
        
        return $this->handleApiResponse($apiResponse, 'debits list');
    }
}