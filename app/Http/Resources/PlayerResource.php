<?php

namespace App\Http\Resources;

use App\Models\Player;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="Player",
 *     @OA\Property(
 *          property="id",
 *          type="integer",
 *          description="ID",
 *          readOnly=true
 *     ),
 *     @OA\Property(
 *          property="nickname",
 *          type="string",
 *          description="Ник",
 *          readOnly=true
 *     ),
 *     @OA\Property(
 *          property="mail",
 *          type="string",
 *          description="Email",
 *          readOnly=true
 *     ),
 *     @OA\Property(
 *          property="skin_id",
 *          type="integer",
 *          description="ID скина",
 *          readOnly=true
 *     ),
 *     @OA\Property(
 *          property="push_enabled",
 *          type="boolean",
 *          description="PUSH enabled",
 *          readOnly=true
 *     ),
 *     @OA\Property(
 *          property="push_token",
 *          type="string",
 *          description="PUSH token",
 *          readOnly=true
 *     ),
 * )
 */
class PlayerResource extends JsonResource
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
         * @var Player $this
         */
        return [
            'id' => $this->id,
            'nickname' => $this->nickname,
            'mail' => $this->mail,
            'skin' => $this->skin_id,
            'push_enabled' => $this->push_enabled,
            'push_token' => $this->push_token,
        ];
    }
}
