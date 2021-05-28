<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Service\ExpensesService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ExpensesController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/expenses",
     *     summary="Расходы",
     *     tags={"Expenses"},
     *     description="Расходы",
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Expense")
     *             ),
     *         )
     *     )
     * )
     * @throws \Exception
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $ExpensesService = new ExpensesService();
        return $ExpensesService->expensesList();
    }
}
