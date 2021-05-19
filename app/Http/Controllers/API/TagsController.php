<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Service\TagService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class TagsController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/tags",
     *     summary="Теги",
     *     tags={"Tags"},
     *     description="Теги",
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
     *                 @OA\Items(ref="#/components/schemas/Tag")
     *             ),
     *         )
     *     )
     * )
     * @throws \Exception
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $TagService = new TagService();
        $TagService->setPlayer(Auth::user());
        return $TagService->tagsList();
    }
}
