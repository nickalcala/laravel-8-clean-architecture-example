<?php

namespace Infrastructure\Product;

use Core\Repository\ICriteria;
use Illuminate\Database\Eloquent\Builder;

class OrderByLatest implements ICriteria
{
    public function apply(Builder $query): Builder
    {
        $query->orderByDesc('products.id');
        return $query;
    }
}
