<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestsDTO\Player\RegisterRequest;
use App\Http\Resources\PlayerResource;
use App\Service\PlayerService;

class PlayerController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/player/",
     *     summary="Регистрация игрока",
     *     tags={"Player"},
     *     description="Регистрация игрока",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Pass user credentials",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="nickname",
     *                 type="string",
     *                 description="nickname"
     *             ),
     *             @OA\Property(
     *                 property="mail",
     *                 type="string",
     *                 description="Email"
     *             ),
     *             @OA\Property(
     *                 property="password",
     *                 type="string",
     *                 description="Пароль"
     *             ),
     *             @OA\Property(
     *                 property="password_confirm",
     *                 type="string",
     *                 description="Подтверждение пароля"
     *             ),
     *             @OA\Property(
     *                 property="skin",
     *                 type="integer",
     *                 description="ID скина"
     *             ),
     *             @OA\Property(
     *                 property="push_enabled",
     *                 type="boolean",
     *                 description="PUSH enabled"
     *             ),
     *             @OA\Property(
     *                 property="push_token",
     *                 type="string",
     *                 description="PUSH token"
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 ref="#/components/schemas/Player"
     *             ),
     *             @OA\Property(
     *                 property="token",
     *                 type="string",
     *                 description="Токен доступа"
     *             ),
     *         )
     *     )
     * )
     * @param RegisterRequest $request
     * @throws \Exception
     * @return PlayerResource
     */
    public function store(RegisterRequest $request): PlayerResource
    {
        $PlayerService = new PlayerService();
        return $PlayerService->register($request->getDto());
    }
}
