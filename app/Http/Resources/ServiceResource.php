<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'title' => $this->resource->title,
            'image' => Storage::url('service/' . $this->resource->image),
            'text' => $this->resource->text,
            'text_header' => $this->resource->text_header,
            'menu_id' => $this->resource->menu_id,
        ];
    }
}
