<?php

namespace App\Repository\Eloquent;

use App\Models\BookSolution;
use App\Repository\CourseBookSolutionRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CourseBookSolutionRepository extends Repository implements CourseBookSolutionRepositoryInterface
{
    protected Model $model;

    public function __construct(BookSolution $model)
    {
        parent::__construct($model);
    }

    public function getCourseBooksSolutions($id){
            return $this->model::where('course_id' , $id)->get();
    }


}
