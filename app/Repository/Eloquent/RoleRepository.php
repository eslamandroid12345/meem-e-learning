<?php

namespace App\Repository\Eloquent;

use App\Models\Role;
use App\Repository\RoleRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class RoleRepository extends Repository implements RoleRepositoryInterface
{
    protected Model $model;

    public function __construct(Role $model)
    {
        parent::__construct($model);
    }

    public function getNames() {
        return $this->model::query()->select()->where('is_deletable' , 1)->pluck('display_name_'.app()->getLocale(), 'name');
    }

    public function getByName(string $name) {
        return $this->model::query()->where('name', $name)->first();
    }

    public function isExisted(string $name) {
        return $this->model::query()->where('name', $name)->exists();
    }




}
