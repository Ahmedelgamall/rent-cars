<?php

namespace App\Http\Resources;

use App\Models\ProductReview;
use Illuminate\Http\Resources\Json\JsonResource;

class FavouritesResource extends JsonResource
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
             
            'id' => $this->product->id,
            'name' => $this->product->name,
            'details' => $this->product->details,
            'category' => $this->product->show_categories(),
            'price' => $this->product->price,
            'price_before' => $this->product->price_before,
            'is_available' => (bool)$this->product->is_available,
            'is_favourite'=>$this->product->is_favourite(),
            'images' => $this->product->product_images(),
            'avearge_rate'=>round($this->product->reviews()->avg('rate'),1),
            'product_page_link'=>route('product-details',$this->product->slug),
           
           
        ];
    }
}
 