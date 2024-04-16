<?php

namespace App\Repository\Eloquent;

use App\Models\CourseAttachment;
use App\Repository\CourseAttachmentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CourseAttachmentRepository extends Repository implements CourseAttachmentRepositoryInterface
{
    protected Model $model;

    public function __construct(CourseAttachment $model)
    {
        parent::__construct($model);
    }


    public function getCourseAttachments($id){
        return $this->model::where('course_id' , $id)->where('is_active' , true)->get();

    }
}
