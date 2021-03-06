<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdressMenuResource extends JsonResource
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
            'name'    => $this->resource->name,
            'url'     => $this->resource->url,
            'type'    => $this->resource->type,
            'menu_id' => $this->resource->menu_id,
        ];
    }
}
