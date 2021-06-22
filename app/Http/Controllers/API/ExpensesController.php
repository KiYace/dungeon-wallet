<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestsDTO\Expense\CreateRequest;
use App\Http\Resources\ExpenseResource;
use App\Repository\Expense\ExpenseRepository;
use App\Service\ExpenseService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class ExpensesController extends Controller
{
    private ExpenseRepository $expenseRepo;

    public function __construct(ExpenseRepository $expenseRepo)
    {
        $this->expenseRepo = $expenseRepo;
    }

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
        $ExpensesService = new ExpenseService($this->expenseRepo);
        $ExpensesService->setPlayer(Auth::user());
        return ExpenseResource::collection($ExpensesService->expensesList());
    }

    /**
     * @OA\Post(
     *     path="/api/expenses",
     *     summary="Создание расхода",
     *     tags={"Expenses"},
     *     description="Создание расхода",
     *     security={
     *         {"bearer": {}},
     *     },
     *     @OA\RequestBody(
     *         required=true,
     *         description="Pass user credentials",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="name",
     *                 type="string",
     *                 description="Название"
     *             ),
     *             @OA\Property(
     *                 property="color",
     *                 type="string",
     *                 description="Цвет"
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Tag")
     *             ),
     *         )
     *     )
     * )
     * @param CreateRequest $request
     * @throws \Exception
     * @return ExpenseResource
     */
    public function store(CreateRequest $request): ExpenseResource
    {
        $ExpenseService = new ExpenseService($this->expenseRepo);
        $ExpenseService->setPlayer(Auth::user());
        return new ExpenseResource($ExpenseService->create($request->getDto()));
    }
}
