<?php

namespace App\Service\Image;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\Pure;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

final class ImageLocalUploader implements ImageUploader
{
    private string $path = '';
    private string $disk = 'local';

    private LoggerInterface $logger;

    #[Pure]
    public function __construct()
    {
        $this->logger = new NullLogger();
    }

    /**
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param string $disk
     */
    public function setDisk(string $disk): void
    {
        $this->disk = $disk;
    }

    /**
     * @return string
     */
    public function getDisk(): string
    {
        return $this->disk;
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    /**
     * @param string $base64
     * @throws \Exception
     * @return string
     */
    public function storeBase64(string $base64): string
    {
        $this->logger->notice('get image from base64', [
            'base64' => $base64
        ]);

        try {
            $extension = $this->getImageExtension($base64);
            $filename = Str::uuid() . '.' . $extension;
            $filepath = $this->path . '/' . $filename;
            $base64 = explode('base64,', $base64);
            Storage::disk($this->disk)->put($filepath, base64_decode($base64[1]));

            $filepath = Storage::disk($this->disk)->url($filepath);
        } catch (\Exception $e) {
            $this->logger->alert('cant parse image', [
                'message' => $e->getMessage(),
                'base64' => $base64,
                'trace' => $e->getTraceAsString(),
            ]);
            throw new \Exception($e->getMessage());
        }

        $this->logger->notice('successful upload image', [
            'filename' => $filepath,
        ]);

        return $filepath;
    }

    /**
     * @param string $blob
     * @return string
     */
    public function storeBlob(string $blob): string
    {
        $base64 = file_get_contents($blob);
        $filename = $this->storeBase64($base64);
        return $filename;
    }

    /**
     * @param string $base64
     * @return string
     */
    private function getImageExtension(string $base64): string
    {
        return explode('/', mime_content_type($base64))[1];
    }
}
