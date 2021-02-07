<?php

namespace Core\Product\Queries;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface IGetProductPagination
{
    public function execute(GetProductPaginationModel $model): LengthAwarePaginator;
}
