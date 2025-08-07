<?php
declare(strict_types=1);

namespace Budgetcontrol\Gateway\Http\Controllers;

use Budgetcontrol\Gateway\Traits\BuildQuery;
use Budgetcontrol\Library\Model\Workspace;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LabelController extends Controller {

    use BuildQuery;

    public function list(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['label'];
        $queryParams = $this->queryParams($request);
        $apiResponse = $this->httpClient()->get("$basePath/$wsid/list", $queryParams);

        return $this->handleApiResponse($apiResponse, 'list');
    }

    public function update(Request $request, Response $response, $arg): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $label_id = $arg['label_id'];
        $basePath = $this->routes['label'];
        $body = $request->getParsedBody();
        $apiResponse = $this->httpClient()->put("$basePath/$wsid/$label_id", $body);
        
        return $this->handleApiResponse($apiResponse, 'update');
    }

    public function insert(Request $request, Response $response, $arg): Response
    {
        $body = $request->getParsedBody();
        $label_id = $arg['label_id'];
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['label'];
        $apiResponse = $this->httpClient()->post("$basePath/$wsid/insert", $body);

        return $this->handleApiResponse($apiResponse, 'insert');
    }

    public function show(Request $request, Response $response, $arg): Response
    {
        $body = $request->getParsedBody();
        $label_id = $arg['label_id'];
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['label'];
        $apiResponse = $this->httpClient()->get("$basePath/$wsid/$label_id");

        return $this->handleApiResponse($apiResponse, 'show');
    }

    public function patch(Request $request, Response $response, $arg): Response
    {
        $body = $request->getParsedBody();
        $label_id = $arg['label_id'];
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $basePath = $this->routes['label'];
        $apiResponse = $this->httpClient()->patch("$basePath/$wsid/$label_id", $body);
        
        return $this->handleApiResponse($apiResponse, 'patch');
    }

    public function delete(Request $request, Response $response, $arg): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $label_id = $arg['label_id'];
        $basePath = $this->routes['label'];
        $apiResponse = $this->httpClient()->delete("$basePath/$wsid/$label_id");
        
        return $this->handleApiResponse($apiResponse, 'delete');
    }
}