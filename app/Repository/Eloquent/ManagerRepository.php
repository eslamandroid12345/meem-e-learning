<?php

namespace App\Repository\Eloquent;

use App\Models\Manager;
use App\Models\Role;
use App\Repository\ManagerRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ManagerRepository extends Repository implements ManagerRepositoryInterface
{
    protected Model $model;

    public function __construct(Manager $model){
        parent::__construct($model);
    }

    public function getManagers($role , $columns = ['*']){
        return $this->model::whereRoleIs($role)->select($columns);
    }

    public function getCooperators($columns = ['*']){
        return $this->model::whereDoesntHave('roles', function ($query) {
            $query->whereIn('name', ['admin', 'teacher' , 'super-admin']);
        })->select($columns);
    }

    public function getTeachersCount(){
        return $this->model::whereRoleIs("teacher")->count();
    }

}
