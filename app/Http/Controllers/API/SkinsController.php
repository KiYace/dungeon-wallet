<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Service\SkinsService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SkinsController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/skins",
     *     summary="Скины",
     *     tags={"Skins"},
     *     description="Скины",
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Skin")
     *             ),
     *         )
     *     )
     * )
     * @throws \Exception
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $SkinsService = new SkinsService();
        return $SkinsService->skinsList();
    }
}
