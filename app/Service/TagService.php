<?php

namespace App\Service;

use App\DTO\Tag\CreateDTO;
use App\DTO\Tag\UpdateDTO;
use App\Models\Player;
use App\Models\Tags;
use App\Repository\Tag\TagRepository;
use Illuminate\Contracts\Auth\Authenticatable;

class TagService
{
    private Player|Authenticatable $player;
    private TagRepository $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * @param Player|Authenticatable $player
     */
    public function setPlayer(Player|Authenticatable $player): void
    {
        $this->player = $player;
    }

    /**
     * @param CreateDTO $createDTO
     * @return Tags
     */
    public function create(CreateDTO $createDTO): Tags
    {
        $tag = new Tags();
        $tag->name = $createDTO->getName();
        $tag->color = $createDTO->getName();
        $tag->player_id = $this->player ? $this->player->id : null;

        $tag = $this->tagRepository->save($tag);
        return $tag;
    }

    /**
     * @param int $id
     * @param UpdateDTO $updateDTO
     * @return Tags
     */
    public function update(int $id, UpdateDTO $updateDTO): Tags
    {
        $tag = Tags::select(['*']);
            // TODO fix php8.0.6
//            ->where('system', false);

        if (!empty($this->player)) {
            $tag = $tag->where('player_id', $this->player->id);
        }

        $tag = $tag->firstOrFail();

        $tag->name = $updateDTO->getName();
        $tag->color = $updateDTO->getColor();

        $tag = $this->tagRepository->save($tag);

        return $tag;
    }

    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        $tag = Tags::select(['*']);
        // TODO fix php8.0.6
//            ->where('system', false);

        if (!empty($this->player)) {
            $tag = $tag->where('player_id', $this->player->id);
        }

        $tag = $tag->firstOrFail();

        $this->tagRepository->delete($tag);
    }
}
