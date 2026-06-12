<?php

if (!function_exists('storage_url')) {
    function storage_url(?string $path): string
    {
        if (!$path) return '';

        if (PHP_OS_FAMILY !== 'Windows') {
            $bucket = config('gcs.bucket', 'carwell-app-media');
            return "https://storage.googleapis.com/{$bucket}/{$path}";
        }

        return asset('storage/' . $path);
    }
}

if (!function_exists('storage_base_url')) {
    function storage_base_url(): string
    {
        if (PHP_OS_FAMILY !== 'Windows') {
            $bucket = config('gcs.bucket', 'carwell-app-media');
            return "https://storage.googleapis.com/{$bucket}";
        }

        return asset('storage');
    }
}
