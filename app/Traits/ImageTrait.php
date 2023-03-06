<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

trait ImageTrait
{
    public function saveAndResize($image): void
    {
        try {
            $img = Image::make($image->getRealPath());
            $img->resize(500,300);
            $imageName  = $image->getClientOriginalName();

            $pathToSave = public_path('storage/categoryImages/'.$imageName);

            $img->save($pathToSave);
        } catch (\Exception $e) {
            Log::info('image_save_error', [
                'info' => $e->getMessage()
            ]);
        }
    }
}
