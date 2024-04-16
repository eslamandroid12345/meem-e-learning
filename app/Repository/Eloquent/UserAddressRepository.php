<?php

namespace App\Repository\Eloquent;

use App\Models\UserAddress;
use App\Repository\UserAddressRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class UserAddressRepository extends Repository implements UserAddressRepositoryInterface
{
    protected Model $model;

    public function __construct(UserAddress $model)
    {
        parent::__construct($model);
    }
}
