<?php

namespace App\Repository\Eloquent;

use App\Models\PaymentItem;
use App\Repository\PaymentItemRepositoryInterface;
use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PaymentItemRepository extends Repository implements PaymentItemRepositoryInterface
{
    protected Model $model;

    public function __construct(PaymentItem $model)
    {
        parent::__construct($model);
    }

    public function getAll(array $columns = ['*'], array $relations = [], Closure $addition = null, Closure $filters = null, $orderBy = "DESC"): Collection
    {
        return parent::getAll($columns, $relations, $addition, $filters, $orderBy);
    }

    public function get($byColumn, $value, array $columns = ['*'], array $relations = [], $orderBy = 'ASC'): array|Collection
    {
        return parent::get($byColumn, $value, $columns, $relations, 'DESC');
    }

}
