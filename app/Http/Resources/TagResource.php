<?php

namespace App\Http\Resources;

use App\Models\Tags;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="Tag",
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
 *          type="string",
 *          description="color",
 *          readOnly=true
 *     ),
 *     @OA\Property(
 *          property="skin",
 *          type="integer",
 *          description="system",
 *          readOnly=true
 *     ),
 * )
 */
class TagResource extends JsonResource
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
         * @var Tags $this
         */
        return [
            'id' => $this->id,
            'name' => $this->name,
            'color' => $this->color,
            'system' => $this->system,
        ];
    }
}
