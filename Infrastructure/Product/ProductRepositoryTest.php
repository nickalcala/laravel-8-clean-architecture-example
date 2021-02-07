<?php

namespace Infrastructure\Product;

use Core\Product\Repositories\IProductRepository;
use Domain\Product\Product;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProductRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    public function test_can_get_products()
    {
        $product = Product::factory()->create();

        $repository = $this->app->make(IProductRepository::class);
        $products = $repository->all();
        $latestProduct = $products->last();

        self::assertEquals($latestProduct->name, $product->name);
        self::assertEquals($latestProduct->description, $product->description);
        self::assertEquals($latestProduct->image, $product->image);
        self::assertEquals($latestProduct->price, $product->price);
    }

    public function test_can_get_products_by_name()
    {
        Product::factory()->create();
        $product2 = Product::factory()->create();
        Product::factory()->create();

        $repository = $this->app->make(IProductRepository::class);
        $foundProduct = $repository->addCriteria(new NameCriteria($product2->name))->first();

        self::assertEquals($foundProduct->name, $product2->name);
        self::assertEquals($foundProduct->description, $product2->description);
        self::assertEquals($foundProduct->image, $product2->image);
        self::assertEquals($foundProduct->price, $product2->price);
    }

    public function test_can_get_products_order_by_latest()
    {
        Product::factory()->create();
        Product::factory()->create();
        $product3 = Product::factory()->create();

        $repository = $this->app->make(IProductRepository::class);
        $foundProduct = $repository->addCriteria(new OrderByLatest())->first();

        self::assertEquals($foundProduct->name, $product3->name);
        self::assertEquals($foundProduct->description, $product3->description);
        self::assertEquals($foundProduct->image, $product3->image);
        self::assertEquals($foundProduct->price, $product3->price);
    }
}
