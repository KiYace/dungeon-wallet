<?php

namespace App\Repository\Expense;

use App\Models\Expense;
use App\Models\Player;
use Illuminate\Database\Eloquent\Collection;

interface ExpenseRepository
{
    public function findAllByPlayer(Player $player): ?Collection;

    public function find(int $id): Expense;

    public function save(Expense $expense): Expense;
}
