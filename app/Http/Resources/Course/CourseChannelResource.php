<?php

namespace App\Http\Resources\Course;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseChannelResource extends JsonResource
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
            'whatsapp_link' => $this->whatsapp_link ?? null,
            'telegram_link' => $this->telegram_link ?? null,
            'telegram_channel_link' => $this->telegram_channel_link ?? null,
        ];
    }
}
