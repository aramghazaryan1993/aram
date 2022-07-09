<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdressResource extends JsonResource
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
            'map'              => $this->resource->map,
            'text'             => $this->resource->text,
            'adress_menu_id'   => $this->resource->adress_menu_id,
            'adress_menu_name' => $this->resource->name,
        ];
    }
}
