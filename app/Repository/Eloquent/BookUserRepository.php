<?php

namespace App\Repository\Eloquent;

use App\Models\BookUser;
use App\Repository\BookUserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BookUserRepository extends Repository implements BookUserRepositoryInterface
{
    protected Model $model;

    public function __construct(BookUser $model)
    {
        parent::__construct($model);
    }
}
