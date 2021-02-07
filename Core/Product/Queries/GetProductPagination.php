<?php

namespace Core\Product\Queries;

use Core\Product\Repositories\IProductRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GetProductPagination implements IGetProductPagination
{
    private IProductRepository $repository;

    public function __construct(IProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(GetProductPaginationModel $model): LengthAwarePaginator
    {
        return $this->repository->getProductsPagination($model);
    }
}
