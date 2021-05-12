<?php

namespace App\Http\Controllers\API;

use App\DTO\AuthDTO;
use App\Http\Controllers\Controller;
use App\Service\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     summary="Авторизация пользователя",
     *     tags={"Auth"},
     *     description="Авторизация пользователя",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Pass user credentials",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="email",
     *                 type="string",
     *                 description="Email"
     *             ),
     *             @OA\Property(
     *                 property="password",
     *                 type="string",
     *                 description="Пароль"
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="token",
     *                 type="string",
     *                 description="Токен доступа"
     *             ),
     *         )
     *     )
     * )
     * @param Request $request
     * @throws \Exception
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $AuthDTO = new AuthDTO($request->get('email'), $request->get('password'));
        $AuthService = new AuthService();
        return $AuthService->authorize($AuthDTO);
    }

    /**
     * @OA\Post(
     *     path="/api/auth/logout",
     *     summary="Логаут",
     *     tags={"Auth"},
     *     description="Логаут",
     *     security={
     *         {"bearer": {}},
     *     },
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="token",
     *                 type="string",
     *                 description="Токен доступа"
     *             ),
     *         )
     *     )
     * )
     * @throws \Exception
     */
    public function logout(): void
    {
        $Player = Auth::user();
        $AuthService = new AuthService();
        $AuthService->setPlayer($Player);
        $AuthService->logout();
    }
}
