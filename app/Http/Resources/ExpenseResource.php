<?php

namespace App\Http\Resources;

use App\Models\Expense;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="Expense",
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
 *          property="description",
 *          type="string",
 *          description="Описание",
 *          readOnly=true
 *     ),
 *     @OA\Property(
 *          property="category_id",
 *          type="integer",
 *          description="ID категории",
 *          readOnly=true
 *     ),
 *     @OA\Property(
 *          property="repeat_at",
 *          type="string",
 *          description="Режим повтора",
 *          readOnly=true
 *     ),
 *     @OA\Property(
 *          property="sum",
 *          type="integer",
 *          description="Сумма",
 *          readOnly=true
 *     ),
 * )
 */
class ExpenseResource extends JsonResource
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
         * @var Expense $this
         */
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'repeat_at' => $this->repeat_at,
            'sum' => $this->sum,
        ];
    }
}
