<?php

namespace Tests\Traits;

use App\Models\Expense;

trait ExpenseTrait
{
    protected function createExpense(): Expense
    {
        return Expense::factory()->create();
    }
}
