<?php

namespace App\Repository\Eloquent;

use App\Models\CartContent;
use App\Repository\CartContentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CartContentRepository extends Repository implements CartContentRepositoryInterface
{
    protected Model $model;

    public function __construct(CartContent $model){
        parent::__construct($model);
    }

}
