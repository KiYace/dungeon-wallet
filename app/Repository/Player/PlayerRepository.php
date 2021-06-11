<?php

namespace App\Repository\Player;

use App\Models\Player;

interface PlayerRepository
{
    public function save(Player $player): Player;
}
