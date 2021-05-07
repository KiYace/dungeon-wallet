<?php

namespace App\Service\Image;

use Illuminate\Support\Facades\Storage;
use JetBrains\PhpStorm\Pure;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

final class ImageLocalUploader implements ImageUploader
{
    private LoggerInterface $logger;

    #[Pure]
    public function __construct()
    {
        $this->logger = new NullLogger();
    }

    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function storeBase64(string $base64): string
    {
        $this->logger->notice('get image from base64', [
            'base64' => $base64
        ]);

        return $base64;
    }

    public function storeBlob(string $blob): string
    {
        // TODO: Implement storeBlob() method.
    }
}
