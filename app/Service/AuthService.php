<?php

namespace App\Service;

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
    public Player|Authenticatable $player;

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
     * @param string $email
     * @param string $password
     * @return JsonResponse
     * @throws PlayerNotFoundException
     * @throws WrongPasswordException
     */
    public function authorize(string $email, string $password): JsonResponse
    {
        $this->logger->notice('find player for logging', [
            'email' => $email,
        ]);

        $this->player = Player::firstWhere('mail', $email);

        if (empty($this->player)) {
            $this->logger->alert('player not found', [
                'email' => $email,
            ]);

            throw new PlayerNotFoundException();
        }

        if(Hash::check($password, $this->player->password)) {
            $token = $this->generateToken('aboba');
        } else {
            $this->logger->alert('player enter wrong password', [
                'email' => $email,
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
    private function generateToken(string $device): string
    {
        return $this->player->createToken($device)->plainTextToken;
    }

    public function logout()
    {
        $this->player->currentAccessToken()->delete();
    }
}
