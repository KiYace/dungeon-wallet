<?php

namespace App\Service;

use App\DTO\Player\ChangeDTO;
use App\DTO\Player\ChangePasswordDTO;
use App\DTO\Player\RegisterDTO;
use App\Http\Resources\Player\LevelResource;
use App\Http\Resources\PlayerResource;
use App\Models\Player;
use App\Service\Player\LevelService;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use JetBrains\PhpStorm\Pure;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class PlayerService
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
     * @param RegisterDTO $registerDTO
     * @return PlayerResource
     */
    public function register(RegisterDTO $registerDTO): PlayerResource
    {
        $this->logger->notice('register new player', [
            'nickname' => $registerDTO->getNickname(),
            'email' => $registerDTO->getEmail(),
        ]);

        // TODO вынести пуш токены в отдельную таблицу
        $player = Player::create([
            'nickname' => $registerDTO->getNickname(),
            'mail' => $registerDTO->getEmail(),
            'password' => Hash::make($registerDTO->getPassword()),
            'skin_id' => $registerDTO->getSkin(),
            // TODO fix push_enabled
//            'push_enabled' => (bool) $registerDTO->isPushEnabled(),
            'push_token' => $registerDTO->getPushToken()
        ]);

        $AuthService = new AuthService();
        $AuthService->setLogger($this->logger);
        $AuthService->setPlayer($player);
        $token = $AuthService->generateToken('');

        $LevelService = new LevelService();
        $LevelService->setLogger($this->logger);
        $LevelService->setPlayer($player);
        $level = $LevelService->createFirstLevel();

        return (new PlayerResource($player))
            ->additional([
                'token' => $token,
                'level' => new LevelResource($level),
            ]);
    }

    /**
     * @param ChangeDTO $changeDTO
     * @return PlayerResource
     */
    public function change(ChangeDTO $changeDTO): PlayerResource
    {
        $this->player->update([
            'nickname' => $changeDTO->getNickname(),
            'skin_id' => $changeDTO->getSkin(),
        ]);

        return new PlayerResource($this->player);
    }

    /**
     * @param ChangePasswordDTO $changePasswordDTO
     * @throws \InvalidArgumentException
     * @return \Illuminate\Http\Response
     */
    public function changePassword(ChangePasswordDTO $changePasswordDTO): Response
    {
       if(!Hash::check($changePasswordDTO->getPasswordOld(), $this->player->password)) {
           throw new \InvalidArgumentException('Старый пароль введен неверно');
       }

       $this->player->password = Hash::make($changePasswordDTO->getPassword());
       $this->player->save();

       return response('Пароль успешно изменен', 200);
    }
}
