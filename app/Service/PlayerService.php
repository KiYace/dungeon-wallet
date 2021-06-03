<?php

namespace App\Service;

use App\DTO\Player\ChangeDTO;
use App\DTO\Player\ChangePasswordDTO;
use App\DTO\Player\RegisterDTO;
use App\Models\Player;
use App\Repository\Player\PlayerRepository;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use JetBrains\PhpStorm\Pure;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class PlayerService
{
    private Player|Authenticatable|null $player;

    private LoggerInterface $logger;
    private PlayerRepository $playerRepo;

    #[Pure]
    public function __construct(PlayerRepository $playerRepo)
    {
        $this->logger = new NullLogger();
        $this->playerRepo = $playerRepo;
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
     * @return Player
     */
    public function register(RegisterDTO $registerDTO): Player
    {
        $this->logger->notice('register new player', [
            'nickname' => $registerDTO->getNickname(),
            'email' => $registerDTO->getEmail(),
        ]);

        // TODO вынести пуш токены в отдельную таблицу
        $player = new Player();
        $player->nickname = $registerDTO->getNickname();
        $player->mail = $registerDTO->getEmail();
        $player->password = Hash::make($registerDTO->getPassword());
        $player->skin_id = $registerDTO->getSkin();
        $player->push_token = $registerDTO->getPushToken();

        $player = $this->playerRepo->save($player);

        return $player;
    }

    /**
     * @param ChangeDTO $changeDTO
     * @return Player
     */
    public function change(ChangeDTO $changeDTO): Player
    {
        $this->player->nickname = $changeDTO->getNickname();
        $this->player->skin_id = $changeDTO->getSkin();

        $this->player = $this->playerRepo->save($this->player);

        return $this->player;
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
       $this->player = $this->playerRepo->save($this->player);

       return response('Пароль успешно изменен', 200);
    }
}
