<?php

namespace App\Repository\Eloquent;

use App\Models\Field;
use App\Repository\FieldRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class FieldRepository extends Repository implements FieldRepositoryInterface
{
    protected Model $model;

    public function __construct(Field $model){
        parent::__construct($model);
    }



    public function getCommonQuestions($courseId) {
        $questions = $this->model::query()
            ->select('id', 'common_questions')
            ->whereHas('categories', function ($query) use ($courseId) {
                $query->whereHas('courses', function ($query) use ($courseId) {
                    $query->where('courses.id', $courseId);
                });
            })
            ->first();
        return $questions->common_questions ?? [];
    }

    public function getNavbarFields() {
        return $this->model::query()->where('show_in_navbar', true)->get();
    }


}
