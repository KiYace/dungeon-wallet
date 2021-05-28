<?php

namespace App\Service;

use App\Http\Resources\SkinResource;
use App\Models\Skin;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SkinsService
{
    /**
     * @return AnonymousResourceCollection
     */
    public function skinsList(): AnonymousResourceCollection
    {
        $skins = Skin::select(['*'])
            ->orderBy('rating', 'asc')
            ->get();

        return SkinResource::collection($skins);
    }

    /**
     * @param int $id
     * @return SkinResource
     */
    public function getSkin(int $id): SkinResource
    {
        $skin = Skin::findOrFail($id);

        return new SkinResource($skin);
    }
}
