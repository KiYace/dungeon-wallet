<?php

namespace App\DTO\Tag;

final class UpdateDTO
{
    private string $name;
    private string $color;

    public function __construct(
        string $name,
        string $color,
    )
    {
        $this->name = $name;
        $this->color = $color;
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
    public function getColor(): string
    {
        return $this->color;
    }
}
