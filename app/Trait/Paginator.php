<?php
namespace App\Trait;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator as BasePaginator;

trait Paginator
{
    protected int $perPage = 10;

    public function paginateData(array $data)
    {
        $perPage = $this->perPage;
        $currentPage = BasePaginator::resolveCurrentPage();
    
        $currentPageItems = array_slice($data, ($currentPage - 1) * $perPage, $perPage);
    
        $paginator = new LengthAwarePaginator(
            $currentPageItems,
            count($data),
            $perPage,
            $currentPage,
            ['path' => BasePaginator::resolveCurrentPath()]
        );
    
        return $paginator;
    }
}