<?php

namespace Core\Product\Commands;

use Illuminate\Http\UploadedFile;

class CreateProductModel
{
    public string $name;
    public ?string $description;
    public ?UploadedFile $image;
    public float $price = 0.0;
}
