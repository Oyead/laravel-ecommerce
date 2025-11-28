<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            "product_id" => $this->id,
            "name" => $this->name,
            "desc" => $this->desc,
            "price" => $this->price,
            "quantity" => $this->quantity,
            "image" => asset("storage/" .$this->image),

        ];
    }
}
