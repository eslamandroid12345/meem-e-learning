<?php

namespace App\Repository\Eloquent;

use App\Models\ResetPassword;
use App\Repository\ResetPasswordRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ResetPasswordRepository extends Repository implements ResetPasswordRepositoryInterface
{
    protected Model $model;

    public function __construct(ResetPassword $model)
    {
        parent::__construct($model);
    }

    public function getCount()
    {
        return $this->model::query()->count();
    }

    public function deleteByUserId($user_id)
    {
        return $this->model::query()->where('user_id', $user_id)->delete();
    }

    public function getByConfirm($confirm,$user_id)
    {
        return $this->model::query()->where('reset',$confirm)->where('user_id',$user_id)->first();
    }

}
