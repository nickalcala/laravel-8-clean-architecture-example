<?php

namespace Core\Product\Repositories;

use Core\Product\Queries\GetProductPaginationModel;
use Core\Repository\IRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface IProductRepository extends IRepository
{
    public function getProductsPagination(GetProductPaginationModel $model): LengthAwarePaginator;
}
