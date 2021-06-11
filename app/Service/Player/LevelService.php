<?php

namespace App\Service\Player;

use App\Models\Player;
use App\Repository\Player\LevelRepository;
use Illuminate\Contracts\Auth\Authenticatable;
use JetBrains\PhpStorm\Pure;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class LevelService
{
    public Player|Authenticatable $player;

    private LoggerInterface $logger;
    private LevelRepository $levelRepo;

    #[Pure]
    public function __construct(LevelRepository $levelRepo)
    {
        $this->logger = new NullLogger();
        $this->levelRepo = $levelRepo;
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
        $level = new Player\Level();
        $level->player_id = $this->player->id;
        $level->level = Player\Level::START_LEVEL;
        $level->exp = Player\Level::START_EXP;
        $level->points = Player\Level::START_POINTS;

        $level = $this->levelRepo->save($level);

        return $level;
    }
}
