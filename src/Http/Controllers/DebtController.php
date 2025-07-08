<?php
namespace Budgetcontrol\Gateway\Http\Controllers;

use Budgetcontrol\Library\Model\Workspace;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Support\Facades\Log;

class DebtController extends Controller {

    public function payeeList(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['debt'];
        $queryParams = $request->getQueryParams();
        $apiResponse = $this->httpClient()->get("$basePath/$wsid/payees?".http_build_query($queryParams));
        
        return $this->handleApiResponse($apiResponse, 'payees list');
    }

    public function deleteDebt(Request $request, Response $response, $arg): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['debt'];
        $uuid = $arg['uuid'];
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