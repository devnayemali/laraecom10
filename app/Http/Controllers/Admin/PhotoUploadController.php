<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class PhotoUploadController extends Controller
{
    // overginal size image upload
    // public static function imageUpload(string $name, string $path, $file): string
    // {
    //     $image_name = $name . '.webp';

    //     Image::make($file)->fit($width, $height)->save(public_path($path) . $image_name, 100, 'webp');

    //     return $image_name;
    // }


    // crop image upload
    public static function imageUpload(string $name, int $width, int $height, string $path, $file): string
    {
        $image_name = $name .'-'. time() . '.webp';
        Image::make($file)->fit($width, $height)->save(public_path($path) . $image_name, 100, 'webp');
        return $image_name;
    }

    // image delete
    public static function imageUnlink($path, $name): void
    {
        $image_path = public_path($path) . $name;
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }
}
