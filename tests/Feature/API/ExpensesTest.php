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
}
