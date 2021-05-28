<?php

namespace Tests\Traits;

use App\Models\Tags;

trait TagsTrait
{
    protected function createTag(array $attributes = []): Tags
    {
        return Tags::factory()->create($attributes);
    }
}
