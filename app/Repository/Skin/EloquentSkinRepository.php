<?php

namespace App\Repository\Tag;

use App\Models\Skin;
use App\Models\Tags;
use App\Repository\Skin\SkinRepository;
use Illuminate\Database\Eloquent\Collection;

class EloquentSkinRepository implements SkinRepository
{
    public function findAll(): ?Collection
    {
        $skins = Skin::select(['*'])
            ->orderBy('rating', 'asc')
            // TODO php8.0.6 fix
//            ->where('system', true)
//            ->orWhere('player_id', $this->player->id)
            ->get();

        return $skins;
    }

    public function find(int $id): Skin
    {
        $skin = Skin::find($id);
        return $skin;
    }
}
