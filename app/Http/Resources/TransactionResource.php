<?php

namespace App\Http\Resources;

use App\Enum\EnumCategory;
use App\Enum\EnumType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'user' => $this->user ? $this->user->name : null,
            'payer_id' => $this->payer_id,
            'payer' => $this->payer ? $this->payer->name : null,
            'type' => EnumType::getTypeName($this->type),
            'category' => EnumCategory::getCategoryName($this->category),
            'value' => number_format($this->value, 2, ',', '.'),
            'description' => $this->description,
            'created_at' => $this->created_at->format('d/m/Y H:i:s'),
        ];
    }
}
