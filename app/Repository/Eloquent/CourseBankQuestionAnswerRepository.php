<?php

namespace App\Repository\Eloquent;

use App\Models\CourseBankQuestionAnswer;
use App\Repository\CourseBankQuestionAnswerRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CourseBankQuestionAnswerRepository extends Repository implements CourseBankQuestionAnswerRepositoryInterface
{

    protected Model $model;

    public function __construct(CourseBankQuestionAnswer $model)
    {
        parent::__construct($model);
    }

}
