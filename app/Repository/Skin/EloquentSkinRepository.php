<?php

namespace App\Repository\Skin;

use App\Models\Skin;
use Illuminate\Database\Eloquent\Collection;

class EloquentSkinRepository implements SkinRepository
{
    public function findAll(): ?Collection
    {
        $skins = Skin::select(['*'])
            ->orderBy('rating', 'asc')
            ->get();

        return $skins;
    }

    public function find(int $id): Skin
    {
        $skin = Skin::find($id);
        return $skin;
    }
}
