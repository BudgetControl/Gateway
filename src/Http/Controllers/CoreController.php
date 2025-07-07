<?php
declare(strict_types=1);

namespace Budgetcontrol\Gateway\Http\Controllers;

use Budgetcontrol\Library\Model\Workspace;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CoreController extends EntryController {


    public function paymentTypes(Request $request, Response $response): Response
    {
        $basePath = $this->routes['core'];
        $apiResponse = $this->httpClient()->get("$basePath/payment-types");
        
        return $this->handleApiResponse($apiResponse, 'payment types');
    }

    public function currencies(Request $request, Response $response): Response
    {
        $basePath = $this->routes['core'];
        $apiResponse = $this->httpClient()->get("$basePath/currencies");
        
        return $this->handleApiResponse($apiResponse, 'currencies');
    }

    public function categories(Request $request, Response $response): Response
    {
        $basePath = $this->routes['core'];
        $apiResponse = $this->httpClient()->get("$basePath/categories");
        
        return $this->handleApiResponse($apiResponse, 'categories');
    }

    public function categoriesSubcategories(Request $request, Response $response): Response
    {
        $basePath = $this->routes['core'];
        $apiResponse = $this->httpClient()->get("$basePath/categories-subcategories");
        
        return $this->handleApiResponse($apiResponse, 'categories and sub categories');
    }
}