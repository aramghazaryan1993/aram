<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PriceListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'      => $this->resource->id,
            'title'   => $this->resource->title,
            'price'   => $this->resource->price,
            'text'    => $this->resource->text,
            'menu_id' => $this->resource->menu_id,
        ];
    }
}
