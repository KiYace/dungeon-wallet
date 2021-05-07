<?php

namespace Tests\Feature\Service;

use App\Service\Image\ImageUploader;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ImageUploaderTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testImageUpload()
    {
        /**
         * @var ImageUploader $ImageUploader
         */
        $ImageUploader = app()->make(ImageUploader::class);
        $fileName = $ImageUploader->storeBase64('dwadawd');

        $this->assertNotEmpty($fileName);
    }
}
