<?php

namespace Infrastructure\ImageOptimize;

use Core\Interfaces\IImageOptimizeService;

class ImageOptimizeService implements IImageOptimizeService
{
    public function getImageDimensions(string $imagePath): array
    {
        list($width, $height) = getimagesize($imagePath);
        return [
            'x' => $width,
            'y' => $height
        ];
    }

    public function scaleByPercentage(string $sourceImagePath, float $scale, string $destImagePath): string
    {
        $file = file_get_contents($sourceImagePath);
        $info = getimagesizefromstring($file);

        $w = $info[0];
        $h = $info[1];
        $newWidth = $w * $scale;
        $newHeight = $h * $scale;

        $image = imagecreatefromstring($file);
        $tmp = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($tmp, $image, 0, 0, 0, 0, $newWidth, $newHeight, $w, $h);
        imagejpeg($tmp, $destImagePath, 100);

        return $destImagePath;
    }
}
