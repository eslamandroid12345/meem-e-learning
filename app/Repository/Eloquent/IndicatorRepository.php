<?php

namespace App\Repository\Eloquent;

use App\Models\Indicator;
use App\Repository\IndicatorRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class IndicatorRepository extends Repository implements IndicatorRepositoryInterface
{
    protected Model $model;

    public function __construct(Indicator $model)
    {
        parent::__construct($model);
    }
}
