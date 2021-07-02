<?php

namespace App\Repository\Player;

use App\Models\Player\Balance;

class EloquentBalanceRepository implements BalanceRepository
{
    public function save(Balance $balance): Balance
    {
        $balance->save();
        return $balance;
    }
}
