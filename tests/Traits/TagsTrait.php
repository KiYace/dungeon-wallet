<?php

namespace Tests\Traits;

use App\Models\Tags;

trait TagsTrait
{
    protected function createTag(): Tags
    {
        return Tags::factory()->create();
    }
}
