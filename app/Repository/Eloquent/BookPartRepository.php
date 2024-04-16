<?php

namespace App\Repository\Eloquent;

use App\Models\Answer;
use App\Models\BookPart;
use App\Repository\AnswerRepositoryInterface;
use App\Repository\BookPartRepositoryInterface;
use App\Repository\QuestionRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BookPartRepository extends Repository implements BookPartRepositoryInterface
{
    protected Model $model;

    public function __construct(BookPart $model){
        parent::__construct($model);
    }

}
