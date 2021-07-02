<?php

namespace App\Repository\Player;

use App\Models\Player\Balance;

interface BalanceRepository
{
    public function save(Balance $balance): Balance;
}
