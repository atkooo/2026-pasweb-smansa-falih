<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageHelper
{
    /**
     * Convert an uploaded image file or path to webp format and store it on disk.
     *
     * @param UploadedFile|string $file
     * @param string $folder
     * @param string $disk
     * @param int $quality
     * @return string Relative path of the saved webp file
     */
    public static function convertToWebp($file, string $folder = 'uploads', string $disk = 'public', int $quality = 85): string
    {
        if ($file instanceof UploadedFile) {
            $realPath = $file->getRealPath();
            $mime = $file->getMimeType();
        } else {
            $realPath = Storage::disk($disk)->path($file);
            if (!file_exists($realPath)) {
                return $file;
            }
            $mime = mime_content_type($realPath);
        }

        // Non-image files (e.g. PDF) remain as is
        if (!str_contains($mime, 'image') || $mime === 'image/svg+xml') {
            if ($file instanceof UploadedFile) {
                return $file->store($folder, $disk);
            }
            return $file;
        }

        // Load image using GD
        $img = match ($mime) {
            'image/jpeg', 'image/jpg' => @imagecreatefromjpeg($realPath),
            'image/png' => @imagecreatefrompng($realPath),
            'image/gif' => @imagecreatefromgif($realPath),
            'image/webp' => @imagecreatefromwebp($realPath),
            default => @imagecreatefromstring(file_get_contents($realPath)),
        };

        if (!$img) {
            if ($file instanceof UploadedFile) {
                return $file->store($folder, $disk);
            }
            return $file;
        }

        // Handle PNG transparency
        if ($mime === 'image/png') {
            imagepalettetotruecolor($img);
            imagealphablending($img, true);
            imagesavealpha($img, true);
        }

        // Generate filename
        $filename = Str::random(40) . '.webp';
        $relativeDir = trim($folder, '/');
        $destinationPath = storage_path("app/public/{$relativeDir}/{$filename}");

        // Ensure directory exists
        $dir = dirname($destinationPath);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        // Convert and save to webp
        imagewebp($img, $destinationPath, $quality);
        imagedestroy($img);

        return "{$relativeDir}/{$filename}";
    }
}
