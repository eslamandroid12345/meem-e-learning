<?php

namespace App\Repository\Eloquent;

use App\Models\Answer;
use App\Models\Contact;
use App\Repository\AnswerRepositoryInterface;
use App\Repository\ContactRepositoryInterface;
use App\Repository\QuestionRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ContactRepository extends Repository implements ContactRepositoryInterface
{
    protected Model $model;

    public function __construct(Contact $model){
        parent::__construct($model);
    }

    public function count() {
        return $this->model::query()->count();
    }

}
