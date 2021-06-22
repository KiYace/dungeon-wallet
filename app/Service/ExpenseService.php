<?php

namespace App\Service;

use App\DTO\Expense\CreateDTO;
use App\Models\Expense;
use App\Models\Player;
use App\Repository\Expense\ExpenseRepository;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class ExpenseService
{
    private Player|Authenticatable $player;
    private LoggerInterface $logger;
    private ExpenseRepository $expenseRepo;

    /**
     * ExpenseService constructor.
     * @param ExpenseRepository $expenseRepo
     */
    public function __construct(ExpenseRepository $expenseRepo)
    {
        $this->logger = new NullLogger();
        $this->expenseRepo = $expenseRepo;
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
     * @return Collection
     */
    public function expensesList()
    {
        $expenses = $this->expenseRepo->findAllByPlayer($this->player);
        return $expenses;
    }

    /**
     * @param CreateDTO $createDTO
     * @return Expense
     */
    public function create(CreateDTO $createDTO): Expense
    {
        $expense = new Expense();
        $expense->name = $createDTO->getName();
        $expense->description = $createDTO->getDescription();
        $expense->player_id = $this->player->id;
        $expense->category_id = $createDTO->getCategoryId();
        $expense->repeat_at = $createDTO->getRepeatAt();
        $expense->sum = $createDTO->getSum();

        $expense = $this->expenseRepo->save($expense);
        return $expense;
    }
}
