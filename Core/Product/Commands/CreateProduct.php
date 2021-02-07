<?php

namespace Core\Product\Commands;

use Domain\Product\Product;
use Core\Interfaces\IImageOptimizeService;

class CreateProduct implements ICreateProduct
{
    private IImageOptimizeService $imageOptimizeService;

    public function __construct(IImageOptimizeService $imageOptimizeService)
    {
        $this->imageOptimizeService = $imageOptimizeService;
    }

    public function execute(CreateProductModel $model): Product
    {
        $extension = $model->image->getClientOriginalExtension();
        $basename = str_replace('.' . $extension, '', $model->image->getClientOriginalName());
        $uniqueId = uniqid();

        $imageName = sprintf('%s_%s.%s', $basename, $uniqueId, $extension);
        $imageNameThumbnail = sprintf('%s_%s_thumbnail.%s', $basename, $uniqueId, $extension);

        $model->image->storePubliclyAs('public/products', $imageName);
        $this->imageOptimizeService->scaleByPercentage(
            storage_path('app/public/products/' . $imageName),
            0.25,
            storage_path('app/public/products/' . $imageNameThumbnail)
        );

        $product = new Product();
        $product->name = $model->name;
        $product->description = $model->description;
        $product->price = $model->price;
        $product->image = 'products/' . $imageName;
        $product->save();

        return $product;
    }
}
