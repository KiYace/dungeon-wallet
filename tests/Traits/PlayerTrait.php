<?php

namespace Tests\Traits;

use App\Models\Player;
use Illuminate\Support\Facades\Auth;

trait PlayerTrait
{
    protected function createPlayer(): Player
    {
        return Player::factory()->create();
    }

    protected function mockPlayer()
    {
        $player = $this->createPlayer();
        Auth::shouldReceive('user')
            ->andReturn($player);

        return $player;
    }
}
