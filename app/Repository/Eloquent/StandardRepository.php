<?php

namespace App\Repository\Eloquent;

use App\Models\Standard;
use App\Repository\FieldRepositoryInterface;
use App\Repository\StandardRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class StandardRepository extends Repository implements StandardRepositoryInterface
{
    protected Model $model;

    public function __construct(Standard $model){
        parent::__construct($model);
    }


}
