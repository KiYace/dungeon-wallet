<?php

namespace App\Service;

use App\DTO\Expense\CreateDTO;
use App\Http\Resources\ExpenseResource;
use App\Models\Expense;
use App\Models\Player;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use JetBrains\PhpStorm\Pure;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class ExpenseService
{
    private Player|Authenticatable|null $player;

    private LoggerInterface $logger;

    #[Pure]
    public function __construct()
    {
        $this->logger = new NullLogger();
    }

    /**
     * @param Player|Authenticatable $player
     */
    public function setPlayer(Player|Authenticatable $player): void
    {
        $this->player = $player;
    }

    /**
     * @param LoggerInterface|NullLogger $logger
     */
    public function setLogger(NullLogger|LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function expensesList()
    {
        $expenses = Expense::select(['*'])
            ->orderBy('created_at', 'desc');

        if (isset($this->palyer)) {
            $expenses->where('player_id', $this->player->id);
        }

        $expenses = $expenses->get();

        return ExpenseResource::collection($expenses);
    }

    /**
     * @param CreateDTO $createDTO
     * @return ExpenseResource
     */
    public function create(CreateDTO $createDTO): ExpenseResource
    {
        $expense = Expense::create([
            'name' => $createDTO->getName(),
            'description' => $createDTO->getDescription(),
            'player_id' => $this->player ? $this->player->id : null,
            'category_id' => $createDTO->getCategoryId(),
            'repeat_at' => $createDTO->getRepeatAt(),
            'sum' => $createDTO->getSum(),
        ]);

        return new ExpenseResource($expense);
    }
}
