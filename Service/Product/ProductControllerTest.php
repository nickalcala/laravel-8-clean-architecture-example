<?php

namespace Service\Product;

use Dingo\Api\Auth\Auth;
use Domain\Product\Product;
use Domain\User\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_can_get_products()
    {
        Product::factory()->create();
        Product::factory()->create();
        $latestProduct = Product::factory()->create();

        $user = User::factory()->create();

        $this->app->make(Auth::class)->setUser($user);
        $response = $this->get('api/products')->decodeResponseJson();
        $response->assertPath('data.0.attributes.name', $latestProduct->name);
    }

    public function test_can_create_products()
    {
        $faker = Factory::create();
        $payload = [
            'name' => $faker->words(3, true),
            'description' => $faker->paragraph,
            'price' => $faker->randomFloat(2, 1, 100),
            'image' => UploadedFile::fake()->image('test.jpg'),
        ];

        $user = User::factory()->create();
        $this->app->make(Auth::class)->setUser($user);

        $response = $this->post('api/products', $payload)->decodeResponseJson();
        $response->assertPath('data.attributes.name', $payload['name']);
        $response->assertPath('data.attributes.description', $payload['description']);
        $response->assertPath('data.attributes.price', $payload['price']);
        self::assertMatchesRegularExpression('/^products\/test_\w+\.jpg$/i', $response->json('data.attributes.image'));
        self::assertFileExists(storage_path('app/public/' . $response->json('data.attributes.image')));
        self::assertFileExists(storage_path('app/public/' . str_replace('.jpg', '_thumbnail.jpg', $response->json('data.attributes.image'))));
    }
}
