<?php

namespace App\Service\Image;

use Psr\Log\LoggerInterface;

interface ImageUploader
{
    public function setLogger(LoggerInterface $logger);

    public function storeBase64(string $base64): string;

    public function storeBlob(string $blob): string;

    public function setDisk(string $disk): void;

    public function getDisk(): string;

    public function setPath(string $path): void;
}
