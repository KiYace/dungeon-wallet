<?php

namespace App\DTO\Player;

final class ChangePasswordDTO
{
    private string $passwordOld;
    private string $password;

    public function __construct(
        string $passwordOld,
        string $password,
    )
    {
        $this->passwordOld = $passwordOld;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPasswordOld(): string
    {
        return $this->passwordOld;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
