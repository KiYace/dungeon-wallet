<?php

namespace App\Service;

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

class AuthService
{
    private Player|Authenticatable|null $player;

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
     * @param AuthDTO $authDTO
     * @return JsonResponse
     * @throws PlayerNotFoundException
     * @throws WrongPasswordException
     */
    public function authorize(AuthDTO $authDTO): JsonResponse
    {
        $this->logger->notice('find player for logging', [
            'email' => $authDTO->getEmail(),
        ]);

        $this->player = Player::firstWhere('mail', $authDTO->getEmail());

        if (empty($this->player)) {
            $this->logger->alert('player not found', [
                'email' => $authDTO->getEmail(),
            ]);

            throw new PlayerNotFoundException('player not found');
        }

        if(Hash::check($authDTO->getPassword(), $this->player->password)) {
            $token = $this->generateToken('');
        } else {
            $this->logger->alert('player enter wrong password', [
                'email' => $authDTO->getEmail(),
                'player' => $this->player->id,
            ]);

            throw new WrongPasswordException('Wrong password');
        }

        return response()->json([
           'token' => $token
        ]);
    }

    /**
     * @param string $device
     * @return string
     */
    public function generateToken(string $device): string
    {
        return $this->player->createToken($device)->plainTextToken;
    }

    public function logout()
    {
        $this->player->currentAccessToken()->delete();
    }
}
