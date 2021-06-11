<?php

namespace App\Repository\Player;

use App\Models\Player;

class EloquentPlayerRepository implements PlayerRepository
{
    public function save(Player $player): Player
    {
        $player->save();
        return $player;
    }
}
