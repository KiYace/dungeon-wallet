<?php

namespace App\Repository\Expense;

use App\Models\Expense;
use App\Models\Player;
use Illuminate\Database\Eloquent\Collection;

class EloquentExpenseRepository implements ExpenseRepository
{
    public function findAllByPlayer(Player $player): ?Collection
    {
        $expenses = Expense::select(['*'])
            ->orderBy('created_at', 'desc')
            ->where('player_id', $player->id)
            ->get();

        return $expenses;
    }

    public function find(int $id): Expense
    {
        $expense = Expense::find($id);
        return $expense;
    }

    public function save(Expense $expense): Expense
    {
        $expense->save();
        return $expense;
    }
}
