<?php

namespace App\Repository\Eloquent;

use App\Models\CourseBankQuestion;
use App\Repository\CourseBankQuestionRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CourseBankQuestionRepository extends Repository implements CourseBankQuestionRepositoryInterface
{


    protected Model $model;

    public function __construct(CourseBankQuestion $model)
    {
        parent::__construct($model);
    }


    public function getBankQuestionsByCourse(Request $request): array
    {
        return $this->model::query()
            ->where('course_id','=',$request->course_id)
            ->select('id','content','course_id')
            ->get()
             ->toArray();
    }
}
