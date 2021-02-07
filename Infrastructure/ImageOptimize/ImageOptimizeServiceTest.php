<?php

namespace Infrastructure\ImageOptimize;

use Core\Interfaces\IImageOptimizeService;
use Faker\Factory;
use Tests\TestCase;

class ImageOptimizeServiceTest extends TestCase
{
    public function test_can_get_image_dimensions()
    {
        $service = $this->app->make(IImageOptimizeService::class);
        $faker = Factory::create();
        $dimensions = $service->getImageDimensions($faker->imageUrl(100, 50));
        self::assertEquals(100, $dimensions['x']);
        self::assertEquals(50, $dimensions['y']);
    }

    public function test_can_make_a_copy_of_an_image_scaled_to_percentage()
    {
        $service = $this->app->make(IImageOptimizeService::class);
        $faker = Factory::create();
        $sourceImagePath = 'public/products/test_' . time() . '.jpg';
        $path = $service->scaleByPercentage($faker->imageUrl(100, 50), 2, $sourceImagePath);
        $resultPath = storage_path('app/' . $sourceImagePath);
        list($resultWidth, $resultHeight) = getimagesize($resultPath);
        self::assertEquals($sourceImagePath, $path);
        self::assertFileExists($resultPath);
        self::assertEquals(200, $resultWidth);
        self::assertEquals(100, $resultHeight);
    }
}
