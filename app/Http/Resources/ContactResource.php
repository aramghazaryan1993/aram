<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'phone'       => $this->resource->phone,
            'email'       => $this->resource->email,
            'working'     => $this->resource->working,
            'text_header' => $this->resource->text_header,
            'text_footer' => $this->resource->text_footer,
            'facebook'    => $this->resource->facebook,
            'instagram'   => $this->resource->instagram,
            'logo'        => Storage::url('default/' . $this->resource->logo),
            'image'       => Storage::url('default/' . $this->resource->image)
        ];
    }
}
