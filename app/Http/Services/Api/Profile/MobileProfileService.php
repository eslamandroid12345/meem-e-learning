<?php

namespace App\Http\Services\Api\Profile;

use App\Http\Resources\Course\CourseResource;

class MobileProfileService extends ProfileService
{

    public function myCourses(){
        return $this->get->handle(CourseResource::class, $this->courseRepository, method: 'getUserCoursesByProgress',
            parameters: [auth('api')->id() , "ALL"], is_instance: false);
    }

}
