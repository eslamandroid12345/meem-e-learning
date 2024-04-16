<?php

namespace App\Repository\Eloquent;

use App\Models\Lecture;
use App\Repository\LectureRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class LectureRepository extends Repository implements LectureRepositoryInterface
{
    protected Model $model;

    public function __construct(Lecture $model)
    {
        parent::__construct($model);
    }

    public function isAuthorizedToEmbed($id) {
        return $this->model::query()
            ->where('id', $id)
            ->where(function ($query) {
                $query->where(function ($query) {
                    $query->whereHas('standard', function ($query) {
                        $query->whereHas('course', function ($query) {
                            $query->whereHas('users', function ($query) {
                                $query->where('users.id', auth('api')?->id());
                            });
                        });
                    });
                });
                $query->orWhere('is_free', true);
            })
            ->exists();
    }
}
