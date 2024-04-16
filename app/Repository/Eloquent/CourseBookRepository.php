<?php

namespace App\Repository\Eloquent;

use App\Models\CourseBook;
use App\Repository\CourseBookRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CourseBookRepository extends Repository implements CourseBookRepositoryInterface
{
    protected Model $model;

    public function __construct(CourseBook $model)
    {
        parent::__construct($model);
    }

    public function getCourseBooks($id){
        return $this->model::where('course_id' , $id)->get();
    }


    public function filterStoreBooks($perPage = 10  ,array $columns = ['*'], array $relations = [] , $orderBy = "DESC")
    {
        $books =  $this->model::query();
        if (request()->has('search') && request()->search !== null){
            $books->where(function ($query){
                $query->where('name_ar' , 'LIKE' , '%' . \request()->search .'%')
                    ->orWhere('name_en' , 'LIKE' , '%' . \request()->search .'%');
            });
        }
        return $books->where('show_in_store' , true)->with($relations)->select($columns)->orderBy("id" ,$orderBy)
            ->paginate($perPage);
    }

    public function getProfileBooks(){
        return $this->model::query()->where(function ($query){
            $query->whereHas('users' , function ($query){
                $query->where('users.id' , auth('api')->id());
            });
        })->orWhere(function ($query){
            $query->whereHas('course' , function ($query){
                $query->where('is_active', true);
                $query->whereHas('users' , function ($query){
                    $query->where('users.id' , auth('api')->id());
                });
            });
        })->get();
    }

    public function isExisted($course_book_id) {
        return $this->model::query()->where('course_books.id', $course_book_id)->exists();
    }
}
