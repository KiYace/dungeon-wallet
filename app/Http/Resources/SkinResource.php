<?php

namespace App\Http\Resources;

use App\Models\Skin;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="Skin",
 *     @OA\Property(
 *          property="id",
 *          type="integer",
 *          description="ID",
 *          readOnly=true
 *     ),
 *     @OA\Property(
 *          property="name",
 *          type="string",
 *          description="Назавние",
 *          readOnly=true
 *     ),
 *     @OA\Property(
 *          property="rating",
 *          type="integer",
 *          description="Рейтинг",
 *          readOnly=true
 *     ),
 *     @OA\Property(
 *          property="skin",
 *          type="string",
 *          description="Скин",
 *          readOnly=true
 *     ),
 * )
 */
class SkinResource extends JsonResource
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
         * @var Skin $this
         */
        return [
            'id' => $this->id,
            'name' => $this->name,
            'rating' => $this->rating,
            'skin' => $this->skin,
        ];
    }
}
