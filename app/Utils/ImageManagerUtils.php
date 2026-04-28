<?php

namespace App\Utils;
use File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageManagerUtils
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    // upload images
    public function uploadImages($images, $modal, $disk)
    {
        foreach ($images as $image) {
            $file_name = $this->generateImageName($image);
            $this->storeImageInLocal($image, '/', $file_name, $disk);
            $modal->images()->create([
                'file_name' => $file_name,
            ]);
        }
    }

    // upload single image
    public function uploadSingleImage($path, $image, $disk, $file_name = null)
    {
        if (!$file_name) {
            $file_name = $this->generateImageName($image);
        }

        $this->storeImageInLocal($image, $path, $file_name, $disk);
        return $file_name;
    }

    // generate file name
    public function generateFileName($file, $employeeName, $month, $year)
    {
        $extension = $file->getClientOriginalExtension();
        $cleanName = Str::slug($employeeName, '_');
        return $cleanName . '_' . $month . '_' . $year . '_' . time() . '.' . $extension;
    }

    // generate image name
    public function generateImageName($image)
    {
        $file_name = Str::uuid() . time() . '.' . $image->getClientOriginalExtension();
        return $file_name;
    }

    // store image in local
    private function storeImageInLocal($image, $path, $file_name, $disk)
    {
        $image->storeAs($path, $file_name, ['disk' => $disk]);
    }

    // remove image from local
    public function removeImageFromLocal($image, $disk)
    {
        Storage::disk($disk)->delete($image);
        // $public_path =
        //  public_path('uploads\\' . $disk . '\\' . $image);
        // if (File::exists($public_path)) {
        //     File::delete($public_path);
        // }
    }

    // save resize image
    public function saveResizeImage($image,$disk, $width, $height)
    {

        $file_name = $this->generateImageName($image);

        // Create an image manager instance
        $manager = new ImageManager(new Driver());

        // Read the image and perform manipulations
        $img = $manager->read($image->getRealPath());
        $img->resize($width, $height);

        $encodedImage = $img->encode();

        Storage::disk($disk)->put($file_name, $encodedImage);

        return $file_name;
    }
}
