<?php

namespace App\Service\Player;

use App\DTO\AuthDTO;
use App\Exceptions\Auth\WrongPasswordException;
use App\Exceptions\Player\PlayerNotFoundException;
use App\Models\Player;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use JetBrains\PhpStorm\Pure;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class LevelService
{
    public Player|Authenticatable|null $player;

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
     * @return Player\Level
     */
    public function createFirstLevel(): Player\Level
    {
        $level = Player\Level::create([
            'player_id' => $this->player->id,
            'level' => Player\Level::START_LEVEL,
            'exp' => Player\Level::START_EXP,
            'points' => Player\Level::START_POINTS,
        ]);

        return $level;
    }
}
