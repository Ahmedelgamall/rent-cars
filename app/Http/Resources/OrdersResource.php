<?php

namespace App\Http\Resources;

use App\Models\ProductReview;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdersResource extends JsonResource
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
             
            'id' => $this->id,
            //'name' => $this->name,
            'city' => $this->area->city->name,
            'area' => $this->area->name,
            'payment_method'=>getTranslatedWords(''.$this->payment_method),
            'address' => $this->address,
            'status'=>getTranslatedWords(''.$this->status),
            'sub_total_price' => $this->sub_total_price,
            'total_without_shipping_fees'=>$this->total_price,
            'shipping fees' => $this->area->shipping_fees,
            'total_price'=>$this->area->shipping_fees+$this->total_price,
            'created_at'=>$this->created_at,
            'products' => OrderProductsResource::collection($this->whenLoaded('products')),
            'trackings' => OrderTrackingsResource::collection($this->whenLoaded('trackings')),
            'coupon'=>$this->coupon->code ?? ''
           
        ];
    }
}
 