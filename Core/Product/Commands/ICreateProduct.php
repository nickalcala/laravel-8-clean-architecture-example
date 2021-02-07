<?php

namespace Core\Product\Commands;

use Domain\Product\Product;

interface ICreateProduct
{
    public function execute(CreateProductModel $model): Product;
}
