<?php

namespace App\DTO\Expense;

final class CreateDTO
{
    private string $name;
    private string $description;
    private int $player_id;
    private int $category_id;
    private string $repeat_at;
    private float $sum;

    public function __construct(
        string $name,
        string $description,
        int $category_id,
        string $repeat_at,
        float $sum,
    )
    {
        $this->name = $name;
        $this->description = $description;
        $this->category_id = $category_id;
        $this->repeat_at = $repeat_at;
        $this->sum = $sum;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    /**
     * @return string
     */
    public function getRepeatAt(): string
    {
        return $this->repeat_at;
    }

    /**
     * @return float
     */
    public function getSum(): float
    {
        return $this->sum;
    }
}
