<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait FileTrait
{
    protected function createPostImage($image)
    {
        $imagesFolder = 'images';
        if (!file_exists($imagesFolder)) {
            mkdir($imagesFolder, 0777, true);
        }

        $filename = time() . '_' . rand(1, 1000) . '_' . $image->getClientOriginalName();

        $image->move($imagesFolder, $filename);

        return $imagesFolder . '/' . $filename;
    }


    protected function updatePostImage($image, $oldImage)
    {
        $imagesFolder = 'images';

        if ($oldImage && file_exists($oldImage)) {
            File::delete($oldImage);
        }

        $filename = time() . '_' . rand(1, 1000) . '_' . $image->getClientOriginalName();

        $image->move($imagesFolder, $filename);

        return $imagesFolder . '/' . $filename;
    }

}
