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
    public function skinsList()
    {
        $skins = Skin::select(['*'])
            ->orderBy('rating', 'asc')
            ->get();

        return SkinResource::collection($skins);
    }
}
