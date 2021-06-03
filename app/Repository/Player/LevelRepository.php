<?php

namespace App\Repository\Player;

use App\Models\Player\Level;

interface LevelRepository
{
    public function save(Level $level): Level;
}
