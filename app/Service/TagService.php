<?php

namespace App\Service;

use App\DTO\Tag\CreateDTO;
use App\DTO\Tag\UpdateDTO;
use App\Http\Requests\RequestsDTO\Tag\CreateRequest;
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

    /**
     * @param CreateDTO $createDTO
     * @return TagResource
     */
    public function create(CreateDTO $createDTO): TagResource
    {
        $tag = Tags::create([
            'name' => $createDTO->getName(),
            'color' => $createDTO->getColor(),
            'player_id' => $this->player ? $this->player->id : null,
        ]);

        return new TagResource($tag);
    }

    /**
     * @param int $id
     * @param UpdateDTO $updateDTO
     * @return TagResource
     */
    public function update(int $id, UpdateDTO $updateDTO): TagResource
    {
        $tag = Tags::select(['*']);
            // TODO fix php8.0.6
//            ->where('system', false);

        if (!empty($this->player)) {
            $tag = $tag->where('player_id', $this->player->id);
        }

        $tag = $tag->firstOrFail();

        $tag->update([
            'name' => $updateDTO->getName(),
            'color' => $updateDTO->getColor()
        ]);

        return new TagResource($tag);
    }
}
