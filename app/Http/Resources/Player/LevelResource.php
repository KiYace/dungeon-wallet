<?php

namespace App\Http\Resources\Player;

use App\Models\Player;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="Level",
 *     @OA\Property(
 *          property="id",
 *          type="integer",
 *          description="ID",
 *          readOnly=true
 *     ),
 *     @OA\Property(
 *          property="player_id",
 *          type="integer",
 *          description="ID пользователя",
 *          readOnly=true
 *     ),
 *     @OA\Property(
 *          property="level",
 *          type="integer",
 *          description="Уровень",
 *          readOnly=true
 *     ),
 *     @OA\Property(
 *          property="exp",
 *          type="integer",
 *          description="Опыт",
 *          readOnly=true
 *     ),
 *     @OA\Property(
 *          property="points",
 *          type="integer",
 *          description="Очки",
 *          readOnly=true
 *     ),
 * )
 */
class LevelResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /**
         * @var Player\Level $this
         */
        return [
            'id' => $this->id,
            'player_id' => $this->player_id,
            'level' => $this->level,
            'exp' => $this->exp,
            'points' => $this->points,
        ];
    }
}
