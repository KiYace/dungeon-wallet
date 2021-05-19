<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestsDTO\Tag\CreateRequest;
use App\Http\Requests\RequestsDTO\Tag\UpdateRequest;
use App\Http\Resources\TagResource;
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

    /**
     * @OA\Post(
     *     path="/api/tags",
     *     summary="Создание тега",
     *     tags={"Tags"},
     *     description="Создание тега",
     *     security={
     *         {"bearer": {}},
     *     },
     *     @OA\RequestBody(
     *         required=true,
     *         description="Pass user credentials",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="name",
     *                 type="string",
     *                 description="Название"
     *             ),
     *             @OA\Property(
     *                 property="color",
     *                 type="string",
     *                 description="Цвет"
     *             ),
     *         ),
     *     ),
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
     * @param CreateRequest $request
     * @throws \Exception
     * @return TagResource
     */
    public function store(CreateRequest $request): TagResource
    {
        $TagService = new TagService();
        $TagService->setPlayer(Auth::user());
        return $TagService->create($request->getDto());
    }

    /**
     * @OA\Put(
     *     path="/api/tags/{id}",
     *     summary="Изменения тега",
     *     tags={"Tags"},
     *     description="Изменения тега",
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
     *     @OA\RequestBody(
     *         required=true,
     *         description="Pass user credentials",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="name",
     *                 type="string",
     *                 description="Название"
     *             ),
     *             @OA\Property(
     *                 property="color",
     *                 type="string",
     *                 description="Цвет"
     *             ),
     *         ),
     *     ),
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
     * @param int $id
     * @param UpdateRequest $request
     * @throws \Exception
     * @return TagResource
     */
    public function update(int $id, UpdateRequest $request): TagResource
    {
        $TagService = new TagService();
        $TagService->setPlayer(Auth::user());
        return $TagService->update($id, $request->getDto());
    }
}
