<?php

namespace Tests\Traits;

use App\Models\Player;

trait PlayerTrait
{
    protected function createPlayer(): Player
    {
        return Player::factory()->create();
    }
}
