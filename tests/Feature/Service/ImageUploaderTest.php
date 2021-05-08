<?php

namespace Tests\Feature\Service;

use App\Service\Image\ImageUploader;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImageUploaderTest extends TestCase
{
    const BASE64 = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVQYV2NgYAAAAAMAAWgmWQ0AAAAASUVORK5CYII=';

    public function testImageUpload()
    {
        /**
         * @var ImageUploader $ImageUploader
         */
        $ImageUploader = app()->make(ImageUploader::class);
        Storage::fake($ImageUploader->getDisk());

        $filePath = $ImageUploader->storeBase64(self::BASE64);

        $this->assertIsString($filePath);
        $this->assertTrue(Storage::disk($ImageUploader->getDisk())->exists($filePath));
    }
}
