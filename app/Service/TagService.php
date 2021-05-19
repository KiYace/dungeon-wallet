<?php

namespace App\Service;

use App\Http\Resources\TagResource;
use App\Models\Player;
use App\Models\Tags;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TagService
{
    private Player|Authenticatable|null $player;

    /**
     * @param Player|Authenticatable|null $player
     */
    public function setPlayer(Player|Authenticatable|null $player): void
    {
        $this->player = $player;
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function tagsList()
    {
        $tags = Tags::select(['*'])
            ->orderBy('system', 'desc')
            // TODO php8.0.6 fix
//            ->where('system', true)
//            ->orWhere('player_id', $this->player->id)
            ->get();

        return TagResource::collection($tags);
    }
}
