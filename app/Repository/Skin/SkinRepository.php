<?php

namespace App\Repository\Skin;

use App\Models\Player;
use App\Models\Skin;
use App\Models\Tags;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;

interface SkinRepository
{
    public function findAll(): ?Collection;

    public function find(int $id): Skin;
}
