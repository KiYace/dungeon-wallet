<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\ExpenseTrait;

class ExpensesTest extends TestCase
{
    use DatabaseTransactions, ExpenseTrait;

    public function testExpensesList()
    {
        $response = $this->getJson('api/expenses/');
        $response->assertStatus(401);

        $this->createExpense();
        $this->withoutMiddleware();
        $response = $this->getJson('api/expenses/');
        $response->assertStatus(200);
        $this->assertNotEmpty($response->getContent());
    }

    public function testCreateExpense()
    {
        $response = $this->postJson('api/expenses/');
        $response->assertStatus(401);

        $this->withoutMiddleware();
        $expense = $this->makeExpense();
        $response = $this->postJson('api/expenses/', [
            'name' => $expense->name,
            'description' => $expense->description,
            'category_id' => $expense->category_id,
            'repeat_at' => $expense->repeat_at,
            'sum' => $expense->sum,
        ]);

        $response->assertStatus(201);
        $this->assertNotEmpty($response->getContent());
    }
}
