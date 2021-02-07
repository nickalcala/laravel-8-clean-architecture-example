<?php

namespace Core\Product\Commands;

use Domain\Product\Product;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    use DatabaseTransactions;

    public function test_can_create_product()
    {
        $faker = Factory::create();

        $model = new CreateProductModel();
        $model->name = $faker->words(3, true);
        $model->description = $faker->paragraph(1);
        $model->price = $faker->randomFloat(2, 1, 100);
        $model->image = UploadedFile::fake()->image('test.jpg');

        $command = $this->app->make(ICreateProduct::class);
        $product = $command->execute($model);

        self::assertEquals($product->name, $model->name);
        self::assertEquals($product->description, $model->description);
        self::assertEquals($product->price, $model->price);
        self::assertMatchesRegularExpression('/^products\/test_\w+\.jpg$/i', $product->image);
        self::assertFileExists(storage_path('app/public/' . $product->image));
        self::assertFileExists(storage_path('app/public/' . str_replace('.jpg', '_thumbnail.jpg', $product->image)));
    }
}
