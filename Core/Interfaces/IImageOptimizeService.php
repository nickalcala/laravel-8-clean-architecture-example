<?php

namespace Core\Interfaces;

interface IImageOptimizeService
{
    /**
     * Get the width and height on an image.
     * @param string $imagePath
     * @return array [x=width, y=height]
     */
    public function getImageDimensions(string $imagePath): array;

    /**
     * Scale an image by the specified percentage.
     * @param string $sourceImagePath
     * @param float $scale
     * @param string $destImagePath
     * @return string The path to the new scaled image.
     */
    public function scaleByPercentage(string $sourceImagePath, float $scale, string $destImagePath): string;
}
