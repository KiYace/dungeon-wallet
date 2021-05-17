<?php

namespace App\DTO\Player;

final class RegisterDTO
{
    private string $nickname;
    private string $email;
    private string $password;
    private int $skin;
    private bool|null $push_enabled;
    private string|null $push_token;

    public function __construct(
        string $nickname,
        string $email,
        string $password,
        int $skin,
        bool $push_enabled = true,
        string $push_token = null
    )
    {
        $this->nickname = $nickname;
        $this->email = $email;
        $this->password = $password;
        $this->skin = $skin;
        $this->push_enabled = $push_enabled;
        $this->push_token = $push_token;
    }

    /**
     * @return string
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return int
     */
    public function getSkin(): int
    {
        return $this->skin;
    }

    /**
     * @return bool|null
     */
    public function getPushEnabled(): ?bool
    {
        return $this->push_enabled;
    }

    /**
     * @return string|null
     */
    public function getPushToken(): ?string
    {
        return $this->push_token;
    }
}
