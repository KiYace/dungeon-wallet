<?php

namespace App\DTO\Player;

final class ChangeDTO
{
    private string $nickname;
    private int $skin;

    public function __construct(
        string $nickname,
        int $skin,
    )
    {
        $this->nickname = $nickname;
        $this->skin = $skin;
    }

    /**
     * @return string
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }

    /**
     * @return int
     */
    public function getSkin(): int
    {
        return $this->skin;
    }
}
