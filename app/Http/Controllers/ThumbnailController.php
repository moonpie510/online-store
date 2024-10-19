<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image;

class ThumbnailController extends Controller
{
    public function __invoke(string $dir, string $method, string $size, string $file)
    {
        abort_if(
            !in_array($size, config('thumbnail.allowed_sizes', [])),
            403,
            'Invalid size'
        );

        $storage = Storage::disk('images');

        $realPath = "$dir/$file";
        $newDirPath = "$dir/$method/$size";
        $resultPath = "$newDirPath/$file";

        if (!$storage->exists($newDirPath)) {
            $storage->makeDirectory($newDirPath);
        }

        if (!$storage->exists($realPath)) {
            $image = Image::make($storage->path($realPath));

            [$w, $h] = explode('x', $size);

            $image->{$method}($w, $h);

            $image->save($storage->path($realPath));
        }

        return response()->file($storage->path($realPath));
    }
}
