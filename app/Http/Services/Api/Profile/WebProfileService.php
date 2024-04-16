<?php

namespace App\Http\Services\Api\Profile;

use App\Http\Resources\Course\CourseResource;

class WebProfileService extends ProfileService
{

    public function progressCourses(){
        return $this->get->handle(CourseResource::class, $this->courseRepository, method: 'getUserCoursesByProgress',
            parameters: [auth('api')->id() , "PROGRESS"], is_instance: false);

    }

    public function finishedCourses(){
        return $this->get->handle(CourseResource::class, $this->courseRepository, method: 'getUserCoursesByProgress',
            parameters: [auth('api')->id() , "FINISHED"], is_instance: false);
    }


}
