<?php

namespace App\Repository\Player;

use App\Models\Player\Level;

class EloquentLevelRepository implements LevelRepository
{
    public function save(Level $level): Level
    {
        $level->save();
        return $level;
    }
}
