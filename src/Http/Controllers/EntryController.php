<?php
declare(strict_types=1);

namespace Budgetcontrol\Gateway\Http\Controllers;

use Budgetcontrol\Gateway\Entities\QueryString;
use App\Entities\Param;
use Budgetcontrol\Library\Model\Workspace;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Support\Facades\Log;

class EntryController extends Controller {

    protected string $entryType = "";

    public function list(Request $request, Response $response): Response
    {
        $queryString = new QueryString();
        $this->getQueryParams($request, $queryString);
        $httpBuildQuery = $queryString->__toString();

        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['entry'];

        $apiResponse = $this->httpClient()->get("$basePath/$wsid".$this->entryType.$httpBuildQuery);
        
        return $this->handleApiResponse($apiResponse, 'entry list');
    }

    public function show(Request $request, Response $response, $arg): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['entry'];
        $uuid = $arg['uuid'];
        $apiResponse = $this->httpClient()->get("$basePath/$wsid".$this->entryType."/$uuid");
        
        return $this->handleApiResponse($apiResponse, 'entry show');
    }

    public function create(Request $request, Response $response): Response
    {
        $body = $request->getParsedBody();
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['entry'];
        $apiResponse = $this->httpClient()->post("$basePath/$wsid".$this->entryType, $body);
        
        return $this->handleApiResponse($apiResponse, 'entry create');
    }

    public function update(Request $request, Response $response, $arg): Response
    {
        $body = $request->getParsedBody();
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['entry'];
        $uuid = $arg['uuid'];
        $apiResponse = $this->httpClient()->put("$basePath/$wsid".$this->entryType."/$uuid", $body);
        
        return $this->handleApiResponse($apiResponse, 'entry update');
    }

    public function delete(Request $request, Response $response, $arg): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['entry'];
        $uuid = $arg['uuid'];
        $apiResponse = $this->httpClient()->delete("$basePath/$wsid".$this->entryType."/$uuid");
        
        return $this->handleApiResponse($apiResponse, 'entry delete');
    }


    /**
     * Retrieves query parameters from the given request or array and updates the provided QueryString object.
     *
     * @param Request|array $request The request object or array containing query parameters.
     * @param QueryString $queryString The QueryString object to be updated with the query parameters.
     * @param string|null $index Optional index to specify a particular subset of query parameters.
     *
     * @return void
     */
    protected function getQueryParams(Request|array $request, QueryString &$queryString, string $index = null): void
    {
        $queryParams = is_array($request) ? $request : $request->getQueryParams();
        $queryParams = $queryString->removeParamsByenv($queryParams);

        foreach ($queryParams as $key => $value) {
            $closure = null;

            if (is_array($value)) {
                $this->getQueryParams($value, $queryString, $key);
                return;
            }

            Log::debug('keyValue: ' . $key);

            switch ($key) {
                case 'account_id':
                    $closure = fn($value) => \Budgetcontrol\Library\Model\Wallet::where('uuid', $value)->first()->id ?? null;
                    break;
                case 'payee_id':
                    $closure = fn($value) => \Budgetcontrol\Library\Model\Payee::where('uuid', $value)->first()->id ?? null;
                    break;
            }

            if(is_null($value)) {
                Log::debug('Removed keyValue: ' . $key . ' value: ' . $value);
            }

            if(!is_null($value)) {
                $queryString->setParam($key, $value, $closure, $index);
            }

        }

    }

}