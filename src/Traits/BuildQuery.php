<?php
declare(strict_types=1);

namespace Budgetcontrol\Gateway\Traits;

use Budgetcontrol\Gateway\Entities\QueryString;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

trait BuildQuery {

    abstract protected function getQueryParams(Request $request, QueryString &$queryString, string $index = null): void;

    public function queryParams(Request $request): string
    {
        $queryString = new QueryString();
        $this->getQueryParams($request, $queryString);
        return $queryString->__toString();
    }
}