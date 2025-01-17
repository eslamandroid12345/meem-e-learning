<?php

namespace App\Http\Resources\Structure\Home;

use Illuminate\Http\Resources\Json\JsonResource;

class SectionFiveImagesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->image;
    }
}
