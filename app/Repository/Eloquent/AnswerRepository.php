<?php

namespace App\Repository\Eloquent;

use App\Models\Answer;
use App\Repository\AnswerRepositoryInterface;
use App\Repository\QuestionRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class AnswerRepository extends Repository implements AnswerRepositoryInterface
{
    protected Model $model;

    public function __construct(Answer $model){
        parent::__construct($model);
    }

}
