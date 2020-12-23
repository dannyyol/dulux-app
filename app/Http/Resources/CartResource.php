<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'product_id' => $this->product_id,
            'product_name' =>$this->product_name,
            "feature_image" => $this->feature_image,
            "product_quantity" => $this->product_quantity,
            "product_price" => $this->product_price,
            "sub_total" => $this->sub_total,
            "produc_id" => $this->product_id

        ];
    }
}
