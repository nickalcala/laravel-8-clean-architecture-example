<?php

namespace Infrastructure\Product;

use Core\Product\Queries\GetProductPaginationModel;
use Core\Product\Repositories\IProductRepository;
use Domain\Product\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Infrastructure\Repository\Repository;

class ProductRepository extends Repository implements IProductRepository
{
    protected function model(): string
    {
        return Product::class;
    }

    public function getProductsPagination(GetProductPaginationModel $model): LengthAwarePaginator
    {
        if ($model->name) {
            $this->addCriteria(new NameCriteria($model->name));
        }

        $this->addCriteria(new OrderByLatest());
        return $this->paginator(50, $model->page);
    }
}
