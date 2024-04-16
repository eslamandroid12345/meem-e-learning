<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends Repository implements UserRepositoryInterface
{
    protected Model $model;

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function getCount()
    {
        return $this->model::query()->count();
    }

    public function getByEmail($email)
    {
        return $this->model::query()->where('email', $email)->first();
    }


}
