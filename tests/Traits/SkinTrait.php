<?php

namespace Tests\Traits;

use App\Models\Skin;

trait SkinTrait
{
    protected function createSkin(): Skin
    {
        return Skin::factory()->create();
    }
}
