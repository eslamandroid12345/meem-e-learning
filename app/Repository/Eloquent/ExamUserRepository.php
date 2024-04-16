<?php

namespace App\Repository\Eloquent;

use App\Models\ExamUser;
use App\Repository\ExamUserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ExamUserRepository extends Repository implements ExamUserRepositoryInterface
{
    protected Model $model;

    public function __construct(ExamUser $model)
    {
        parent::__construct($model);
    }

    public function getMine($exam_id) {
        return $this->model::query()->my()->whereHas('exam', function ($query) use ($exam_id) {
            $query->where('id', $exam_id);
//            $query->whereHas('questions', function ($query) {
//                $query->where('is_active', true);
//            });
        })->get();
    }
}
