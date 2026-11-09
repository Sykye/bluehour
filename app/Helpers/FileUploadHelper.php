<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class FileUploadHelper
{
    // Ekstensi berbahaya yang diblokir
    private static array $blockedExtensions = [
        'php', 'php3', 'php4', 'php5', 'phtml',
        'exe', 'sh', 'bat', 'cmd', 'js', 'py',
        'rb', 'pl', 'cgi', 'htaccess',
    ];

    public static function uploadImage(
        UploadedFile $file,
        string $folder = 'uploads'
    ): string {
        // 1. Cek ekstensi ganda (misal: foto.php.jpg)
        $originalName = $file->getClientOriginalName();
        self::checkDoubleExtension($originalName);

        // 2. Validasi MIME type sungguhan (bukan hanya ekstensi)
        $realMime = $file->getMimeType();
        $allowedMimes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
        if (!in_array($realMime, $allowedMimes)) {
            abort(422, 'Tipe file tidak diizinkan.');
        }

        // 3. Generate nama file acak (UUID) — hindari path traversal
        $extension = $file->getClientOriginalExtension();
        $newFilename = Str::uuid() . '.' . strtolower($extension);

        // 4. Simpan ke storage/app/public/{folder}
        $path = $file->storeAs($folder, $newFilename, 'public');

        return $path;
    }

    private static function checkDoubleExtension(string $filename): void
    {
        // Pisahkan semua ekstensi dari nama file
        $parts = explode('.', $filename);

        // Hapus bagian pertama (nama file)
        array_shift($parts);

        // Cek semua ekstensi
        foreach ($parts as $ext) {
            if (in_array(strtolower($ext), self::$blockedExtensions)) {
                abort(422, 'Ekstensi file tidak diizinkan.');
            }
        }
    }
}