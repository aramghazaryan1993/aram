<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
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
            'id'   => $this->resource->id,
            'menu' => $this->resource->menu,[
                'SubMenu' => $this->resource->Menu,[
                    'ChiledMenu' => $this->resource->chiledMenu,
                    
                ]
            ],
        ];
    }
}
