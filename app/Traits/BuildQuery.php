<?php
declare(strict_types=1);

namespace App\Traits;

use Illuminate\Http\Request;
use App\Entities\QueryString;

trait BuildQuery {

    abstract protected function getQueryParams(Request $request, QueryString &$queryString, string $index = null): void;

    public function queryParams(Request $request): string
    {
        $queryString = new QueryString();
        $this->getQueryParams($request, $queryString);
        return $queryString->__toString();
    }
}