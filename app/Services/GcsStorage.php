<?php

namespace App\Services;

use Google\Cloud\Storage\StorageClient;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class GcsStorage
{
    public static function store(UploadedFile $file, string $folder): string
    {
        if (PHP_OS_FAMILY === 'Windows') {
            return $file->store($folder, 'public');
        }

        $objectName = $folder . '/' . $file->hashName();
        $client = new StorageClient();
        $client->bucket(config('gcs.bucket'))->upload(
            fopen($file->getRealPath(), 'r'),
            ['name' => $objectName]
        );

        return $objectName;
    }

    public static function delete(?string $objectName): void
    {
        if (!$objectName) return;

        if (PHP_OS_FAMILY === 'Windows') {
            Storage::disk('public')->delete($objectName);
            return;
        }

        try {
            $client = new StorageClient();
            $client->bucket(config('gcs.bucket'))->object($objectName)->delete();
        } catch (\Exception $e) {
            // objeto pode não existir
        }
    }
}
