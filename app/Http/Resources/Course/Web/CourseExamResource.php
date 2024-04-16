<?php

namespace App\Http\Resources\Course\Web;

use App\Http\Resources\Course\CourseExamsByTypeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseExamResource extends JsonResource
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
            'type' => __('dashboard.'.strtolower($this['type']).'_exams'),
            'exams' => CourseExamsByTypeResource::collection($this['exams']),
        ];
    }
}
