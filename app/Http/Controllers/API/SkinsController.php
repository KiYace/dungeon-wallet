<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\SkinResource;
use App\Repository\Skin\SkinRepository;
use App\Service\SkinService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SkinsController extends Controller
{
    private SkinRepository $skinRepo;

    public function __construct(SkinRepository $skinRepo)
    {
        $this->skinRepo = $skinRepo;
    }

    /**
     * @OA\Get(
     *     path="/api/skins",
     *     summary="Скины",
     *     tags={"Skins"},
     *     description="Скины",
     *     security={
     *         {"bearer": {}},
     *     },
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
        $SkinsService = new SkinService();
        return $SkinsService->skinsList();
    }

    /**
     * @OA\Get(
     *     path="/api/skin/{id}",
     *     summary="Скин",
     *     tags={"Skins"},
     *     description="Скин",
     *     security={
     *         {"bearer": {}},
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="id",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 ref="#/components/schemas/Skin"
     *             ),
     *         )
     *     )
     * )
     * @param $id
     * @throws \Exception
     * @return SkinResource
     */
    public function show(int $id): SkinResource
    {
        $SkinsService = new SkinService();
        return $SkinsService->getSkin($id);
    }
}
