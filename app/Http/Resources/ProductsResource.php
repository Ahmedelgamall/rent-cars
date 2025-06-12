<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'details' => $this->details,
            'categories' => $this->show_categories(),
            'price' => $this->price,
            'price_before' => $this->price_before,
            'is_available' => (bool)$this->is_available,
            'is_favourite'=>$this->is_favourite(),
            'images' => $this->product_images(),
            'avearge_rate'=>round($this->reviews()->avg('rate')),
            'reviews' => $this->whenLoaded('reviews', function () {
                return ProductReviewsResource::collection($this->reviews->take(3));
            }),
            'product_page_link'=>route('product-details',$this->slug)
           
        ];
    }
}
