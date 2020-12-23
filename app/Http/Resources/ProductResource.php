<?php

namespace App\Http\Resources;

use App\Models\CartItem;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return[
            'id' => $this->id,
            'title' => $this->title,
            'current_price' =>$this->current_price,
            "feature_image" => $this->feature_image,
            "cart" => new CartResource($this->cartItem)
                    //  'threads' => ThreadResource::collection($this->threads),
        ];
    }
}
