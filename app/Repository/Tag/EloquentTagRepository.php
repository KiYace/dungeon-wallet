<?php

namespace App\Repository\Tag;

use App\Models\Player;
use App\Models\Tags;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;

class EloquentTagRepository implements TagRepository
{
    public function findAllByPlayerOrSystem(Player|Authenticatable|null $player): ?Collection
    {
        $tags = Tags::select(['*'])
            ->orderBy('system', 'desc')
            // TODO php8.0.6 fix
//            ->where('system', true)
//            ->orWhere('player_id', $this->player->id)
            ->get();

        return $tags;
    }

    public function save(Tags $tag): Tags
    {
        $tag->save();
        return $tag;
    }

    public function delete(Tags $tag)
    {
        $tag->delete();
    }

}
