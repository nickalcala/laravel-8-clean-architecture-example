<?php

namespace Database\Factories;

use Domain\Product\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $createdAt = $this->faker->dateTimeBetween('-10 days');

        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph(1),
            'image' => $this->faker->imageUrl(),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }
}
