<?php

namespace App\Repository\Eloquent;

use App\Models\Category;
use App\Models\Field;
use App\Repository\CategoryRepositoryInterface;
use App\Repository\FieldRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository extends Repository implements CategoryRepositoryInterface
{
    protected Model $model;

    public function __construct(Category $model){
        parent::__construct($model);
    }

    public function getFields($id){
        $category = $this->model::find($id);
        return $category->fields->where('is_active' , 1);
    }



}
