<?php

namespace App\Repository\Tag;

use App\Models\Player;
use App\Models\Tags;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;

interface TagRepository
{
    public function findAllByPlayerOrSystem(Player|Authenticatable|null $player): ?Collection;

    public function save(Tags $tag): Tags;

    public function delete(Tags $tag);
}
