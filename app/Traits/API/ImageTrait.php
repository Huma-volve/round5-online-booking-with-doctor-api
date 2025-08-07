<?php

namespace App\Traits\API;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait ImageTrait {
    public function uploadImage(UploadedFile $image, string $path = 'uploads') {
        return $image->store($path, 'public');
    }
    public function updateImage(UploadedFile $image, string $oldImagePath = null, string $path = 'uploads') {
        if ($oldImagePath && Storage::disk('public')->exists($oldImagePath)) {
            Storage::disk('public')->delete($oldImagePath);
        }
        return $this->uploadImage($image, $path);
    }
    public function deleteImage(string $imagePath) {
        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }
    public function getImageUrl(string $imagePath) {
        return $imagePath ? Storage::disk('public')->url($imagePath) : null;
    }
}
