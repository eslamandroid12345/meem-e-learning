<?php

namespace App\Repository\Eloquent;

use App\Models\LecturePin;
use App\Repository\LecturePinRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class LecturePinRepository extends Repository implements LecturePinRepositoryInterface
{
    protected Model $model;

    public function __construct(LecturePin $model)
    {
        parent::__construct($model);
    }

    public function getByLectureId($id){
        $pins =  $this->model::query()->where('lecture_id' , $id);
        if (\request()->has('search') && \request()->search !== null ){
            $pins->where(function ($query){
                $query->where('name_ar' , 'LIKE' , '%' . \request()->search .'%')
                    ->orWhere('name_en' , 'LIKE' , '%' . \request()->search .'%')
                    ->orWhere('description_ar' , 'LIKE' , '%' . \request()->search .'%')
                    ->orWhere('description_ar' , 'LIKE' , '%' . \request()->search .'%')
                    ->orWhere('time' , 'LIKE' , '%' . \request()->search .'%');
            });
        }
        return $pins->get();
    }
}
