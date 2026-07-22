<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

echo "Starting WebP conversion process...\n";

// Function to convert a single image file on disk to webp and return new relative path or filename
function convertSingleFile($absolutePath, $quality = 85) {
    if (!file_exists($absolutePath)) return null;

    $info = pathinfo($absolutePath);
    $ext = strtolower($info['extension'] ?? '');

    if (!in_array($ext, ['png', 'jpg', 'jpeg', 'gif'])) {
        return null;
    }

    $mime = mime_content_type($absolutePath);
    $img = match ($mime) {
        'image/jpeg', 'image/jpg' => @imagecreatefromjpeg($absolutePath),
        'image/png' => @imagecreatefrompng($absolutePath),
        'image/gif' => @imagecreatefromgif($absolutePath),
        default => @imagecreatefromstring(file_get_contents($absolutePath)),
    };

    if (!$img) return null;

    if ($mime === 'image/png') {
        imagepalettetotruecolor($img);
        imagealphablending($img, true);
        imagesavealpha($img, true);
    }

    $newAbsolutePath = $info['dirname'] . '/' . $info['filename'] . '.webp';
    imagewebp($img, $newAbsolutePath, $quality);
    imagedestroy($img);

    // If new file exists and is different from original, remove original (if extension wasn't webp)
    if ($ext !== 'webp' && file_exists($newAbsolutePath)) {
        @unlink($absolutePath);
    }

    return $newAbsolutePath;
}

// 1. Convert public/images/logo.png -> logo.webp
$logoPath = public_path('images/logo.png');
if (file_exists($logoPath)) {
    convertSingleFile($logoPath);
    echo "Converted public/images/logo.png -> logo.webp\n";
}

// 2. Convert uploads in public/uploads/profil
$profilDir = public_path('uploads/profil');
if (is_dir($profilDir)) {
    foreach (File::files($profilDir) as $file) {
        convertSingleFile($file->getRealPath());
    }
    echo "Converted public/uploads/profil images to WebP\n";
}

// 3. Convert storage/app/public images
$storageDir = storage_path('app/public');
if (is_dir($storageDir)) {
    foreach (File::allFiles($storageDir) as $file) {
        $ext = strtolower($file->getExtension());
        if (in_array($ext, ['png', 'jpg', 'jpeg', 'gif'])) {
            convertSingleFile($file->getRealPath());
        }
    }
    echo "Converted storage/app/public images to WebP\n";
}

// 4. Update Database references for Users (foto)
$users = DB::table('users')->whereNotNull('foto')->get();
foreach ($users as $user) {
    if ($user->foto && !str_ends_with($user->foto, '.webp')) {
        $info = pathinfo($user->foto);
        if (isset($info['extension']) && in_array(strtolower($info['extension']), ['png', 'jpg', 'jpeg', 'gif'])) {
            $newFoto = ($info['dirname'] !== '.' ? $info['dirname'] . '/' : '') . $info['filename'] . '.webp';
            DB::table('users')->where('id', $user->id)->update(['foto' => $newFoto]);
        }
    }
}
echo "Updated users table foto references.\n";

// 5. Update Database references for FormulirPendaftaran (upload_surat_izin, upload_skd, upload_kk)
$formulirs = DB::table('formulir_pendaftaran')->get();
foreach ($formulirs as $f) {
    $updates = [];
    foreach (['upload_surat_izin', 'upload_skd', 'upload_kk'] as $field) {
        $val = $f->{$field};
        if ($val && !str_ends_with($val, '.webp')) {
            $info = pathinfo($val);
            if (isset($info['extension']) && in_array(strtolower($info['extension']), ['png', 'jpg', 'jpeg', 'gif'])) {
                $updates[$field] = ($info['dirname'] !== '.' ? $info['dirname'] . '/' : '') . $info['filename'] . '.webp';
            }
        }
    }
    if (!empty($updates)) {
        DB::table('formulir_pendaftaran')->where('id', $f->id)->update($updates);
    }
}
echo "Updated formulir_pendaftaran table image references.\n";

// 6. Update Database references for Berita (gambar_sampul)
$beritas = DB::table('beritas')->whereNotNull('gambar_sampul')->get();
foreach ($beritas as $b) {
    if ($b->gambar_sampul && !str_ends_with($b->gambar_sampul, '.webp')) {
        $info = pathinfo($b->gambar_sampul);
        if (isset($info['extension']) && in_array(strtolower($info['extension']), ['png', 'jpg', 'jpeg', 'gif'])) {
            $newPath = ($info['dirname'] !== '.' ? $info['dirname'] . '/' : '') . $info['filename'] . '.webp';
            DB::table('beritas')->where('id', $b->id)->update(['gambar_sampul' => $newPath]);
        }
    }
}
echo "Updated beritas table image references.\n";

// 7. Update Database references for Galeri (file_foto)
$galeris = DB::table('galeri')->whereNotNull('file_foto')->get();
foreach ($galeris as $g) {
    if ($g->file_foto && !str_ends_with($g->file_foto, '.webp')) {
        $info = pathinfo($g->file_foto);
        if (isset($info['extension']) && in_array(strtolower($info['extension']), ['png', 'jpg', 'jpeg', 'gif'])) {
            $newPath = ($info['dirname'] !== '.' ? $info['dirname'] . '/' : '') . $info['filename'] . '.webp';
            DB::table('galeri')->where('id', $g->id)->update(['file_foto' => $newPath]);
        }
    }
}
echo "Updated galeri table image references.\n";

// 8. Update Database references for Informasi (konten for images)
$informasis = DB::table('informasi')->get();
foreach ($informasis as $inf) {
    if ($inf->konten && !str_ends_with($inf->konten, '.webp')) {
        $info = pathinfo($inf->konten);
        if (isset($info['extension']) && in_array(strtolower($info['extension']), ['png', 'jpg', 'jpeg', 'gif'])) {
            $newKonten = ($info['dirname'] !== '.' ? $info['dirname'] . '/' : '') . $info['filename'] . '.webp';
            DB::table('informasi')->where('id', $inf->id)->update(['konten' => $newKonten]);
        }
    }
}
echo "Updated informasi table image references.\n";

echo "All images converted to WebP successfully!\n";
