<?php

namespace Core\Product\Queries;

use Domain\Product\Product;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class GetProductPaginationTest extends TestCase
{
    use DatabaseTransactions;

    public function test_can_get_product_pagination()
    {
        Product::factory()->count(55)->create();

        $query = $this->app->make(IGetProductPagination::class);

        $filter = new GetProductPaginationModel(1);
        $pagination = $query->execute($filter);

        self::assertEquals(55, $pagination->total());
        self::assertEquals(2, $pagination->lastPage());
    }

    public function test_can_get_product_pagination_by_name()
    {
        Product::factory()->count(55)->create();

        $query = $this->app->make(IGetProductPagination::class);

        $filter = new GetProductPaginationModel(1);
        $pagination = $query->execute($filter);

        self::assertEquals(55, $pagination->total());
        self::assertEquals(2, $pagination->lastPage());
    }
}
