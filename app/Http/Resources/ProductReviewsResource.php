<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductReviewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'rate' => $this->rate,
            'review' => $this->review,
            'created_at'=>$this->created_at,
            'product' => new ProductsResource($this->whenLoaded('product')),
            'customer' => $this->customer
            
        ];
    }
}
