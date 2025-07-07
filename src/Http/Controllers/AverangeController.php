<?php
declare(strict_types=1);

namespace Budgetcontrol\Gateway\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Budgetcontrol\Gateway\Http\Controllers\ChartsController;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class AverangeController extends ChartsController {


    public function averageExpenses(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['stats'];
        $apiResponse = $this->httpClient()->get("$basePath/$wsid/average-expenses");
        
        return $this->handleApiResponse($apiResponse, 'average-expenses');
    }

    public function averageIncoming(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['stats'];
        $apiResponse = $this->httpClient()->get("$basePath/$wsid/average-incoming");
        
        return $this->handleApiResponse($apiResponse, 'average-incoming');
    }

    public function averageSavings(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['stats'];
        $apiResponse = $this->httpClient()->get("$basePath/$wsid/average-savings");
        
        return $this->handleApiResponse($apiResponse, 'average-savings');
    }


    public function totalLoanInstallmentsOfCurrentMonth(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['stats'];
        $apiResponse = $this->httpClient()->get("$basePath/$wsid/total-loan-installments");
        
        return $this->handleApiResponse($apiResponse, 'total-loan-installments');
    }

    public function totalPlannedRemainingOfCurrentMonth(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['stats'];
        $apiResponse = $this->httpClient()->get("$basePath/$wsid/total/planned/remaining");
        
        return $this->handleApiResponse($apiResponse, 'total/planned/remaining');
    }

    public function totalPlannedMonthly(Request $request, Response $response): Response
    {
        $wsid = $this->getWorkspaceId($request);
        $basePath = $this->routes['stats'];
        $apiResponse = $this->httpClient()->get("$basePath/$wsid/total/planned/monthly");
        
        return $this->handleApiResponse($apiResponse, 'total/planned/monthly');
    }
}