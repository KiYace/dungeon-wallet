<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestsDTO\Player\ChangePasswordRequest;
use App\Http\Requests\RequestsDTO\Player\ChangeRequest;
use App\Http\Requests\RequestsDTO\Player\RegisterRequest;
use App\Http\Resources\PlayerResource;
use App\Service\PlayerService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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

    /**
     * @OA\Put(
     *     path="/api/player/",
     *     summary="Изменение данных игрока",
     *     tags={"Player"},
     *     description="Изменение данных игрока",
     *     security={
     *         {"bearer": {}},
     *     },
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
     *                 property="skin",
     *                 type="integer",
     *                 description="ID скина"
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
     *         )
     *     )
     * )
     * @param ChangeRequest $request
     * @throws \Exception
     * @return PlayerResource
     */
    public function update(ChangeRequest $request): PlayerResource
    {
        $Player = Auth::user();
        $PlayerService = new PlayerService();
        $PlayerService->setPlayer($Player);
        return $PlayerService->change($request->getDto());
    }

    /**
     * @OA\Put(
     *     path="/api/player/change_password",
     *     summary="Изменение пароля",
     *     tags={"Player"},
     *     description="Изменение пароля",
     *     security={
     *         {"bearer": {}},
     *     },
     *     @OA\RequestBody(
     *         required=true,
     *         description="Pass user credentials",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="password_old",
     *                 type="string",
     *                 description="Пароль"
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
     *         )
     *     )
     * )
     * @param ChangePasswordRequest $request
     * @throws \Exception
     * @return Response
     */
    public function changePassword(ChangePasswordRequest $request): Response
    {
        $Player = Auth::user();
        $PlayerService = new PlayerService();
        $PlayerService->setPlayer($Player);
        return $PlayerService->changePassword($request->getDto());
    }
}
