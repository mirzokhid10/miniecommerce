<?php

namespace App\Helpers;

use Intervention\Image\ImageManager;
// use Intervention\Image\Facades\Image;
use Image;

use Illuminate\Support\Str;

class FakeImageHelper
{
    public static function generate($folder = 'products', $width = 600, $height = 600)
    {
        // Create directory if not exists
        $directory = public_path("uploads/$folder");
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        // File name
        $filename = Str::random(20) . '.jpg';
        $fullPath = $directory . '/' . $filename;

        // --- Create blank image using GD ---
        $image = imagecreatetruecolor($width, $height);

        // Random color background
        $color = imagecolorallocate(
            $image,
            rand(50, 200),
            rand(50, 200),
            rand(50, 200)
        );

        imagefilledrectangle($image, 0, 0, $width, $height, $color);

        // Add simple text "Product"
        $textColor = imagecolorallocate($image, 255, 255, 255);
        imagestring($image, 5, $width / 2 - 40, $height / 2 - 8, "Product", $textColor);

        // Save image
        imagejpeg($image, $fullPath, 90);

        imagedestroy($image);

        return "uploads/$folder/$filename";
    }
}
